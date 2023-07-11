<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\AddCart;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\User;
use App\Notifications\UserNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SaleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $productes = Product::query();

        if (!empty($request->product_category)) {
            $productes = $productes->where("product_category_id", $request->product_category);
        }

        if (!empty($request->product_code)) {
            $productes = $productes->where("product_code", $request->product_code);
        }

        if (!empty($request->product_name)) {
            $productes = $productes->where("product_name", 'like','%'.$request->product_name.'%');
        }

        $productes = $productes->where('store_stock','>',0)->paginate(10);
        $addCart = AddCart::where('created_by', Auth::user()->id)->get();
        $productCategory = ProductCategory::get();
        $customers = Customer::orderBy('customer_name','desc')->get();
        $sales = Sale::where('created_by',Auth::user()->id)->whereDate('created_at', Carbon::today())->get();

        return view('backend.sales.index2', compact('productes', 'productCategory', 'addCart','customers','sales'));
    }

    public function cartList()
    {
        $sales = Sale::where('created_by',Auth::user()->id)->whereDate('created_at', Carbon::today())->get();
        return view('backend.sales.cart_list', compact('sales'));
    }

    public function cartListDetail($id) {
        $sale = Sale::where('created_by',Auth::user()->id)->find($id);
        return view('backend.sales.print_detail', compact('sale'));
    }

    public function Report(Request $request)
    {
        $query = Sale::query();
        $customers = Customer::get(['id','customer_name']);

        if ($request->customer) {
            $query->where('customer_id', $request->customer);
        }

        if ($request->customer_phone) {
            $customer = Customer::where('customer_phone',$request->customer_phone)->first();
            if($customer)
                $query->where('customer_id', $customer->id);
        }
        
        if ($request->start_date || $request->end_date ){
            $query->whereBetween('created_at', array($request->start_date,$request->end_date));
        }else{
            $query->whereDate('created_at','=', Carbon::today()->toDateString());
        }

        $saleDaily = $query->get();
        if($request->export == "enabled"){
            return $this->processExcel($saleDaily);
        }
        
        return view('backend.sales.report', compact('saleDaily','customers'));
    }

    public function processExcel($attendances)
    {
        $file_name = 'Sale_report_'.date('j_m_Y_H_i_s').'.xlsx';

        $datas = $attendances->map(function ($data) {
            return [
                'id' => $data->id,
                'sale_no' => $data->sale_no,
                'customer' => $data->customer->customer_name ?? '',
                'total_qty' => $data->total_qty,
                'total_price' => '$'.$data->total_price
            ];
        });

        $heading = [
            __('app.table_no'),
            __('app.label_invoice_no'),
            __('app.customer'),
            __('app.label_total_qty'),
            __('app.label_total_price')
        ];
        
        return Helpers::exportExcel($datas,$heading,$file_name);
    }

    public function reportDetail($id)
    {
        $sale = Sale::find($id);
        return view('backend.sales.report_detail', compact('sale'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $total_qty = 0;
        $total_price = 0;
        foreach($request->product_id as $index => $add) {
            $total_qty += $request->product_qty[$index];
            $total_price += $request->product_amount[$index];
        }

        // $countDaily = Sale::whereDate('created_at','=', Carbon::today()->toDateString())->count();
        // $sale_no = '#'.$countDaily + 1;

        $sale = new Sale();
        $sale->sale_no = $this->getNextSaleNo();
        $sale->customer_id = $request->customer;
        $sale->total_qty = $total_qty;
        $sale->total_price = $total_price;
        $sale->request_status = 0;
        $sale->submit_by = Auth::user()->id;
        $sale->approve_status = 1;
        $sale->balance = $request->balance;
        $sale->deposit = $request->deposit;
        $sale->approve_by = Auth::user()->id;
        $sale->created_by = Auth::user()->id;
        $sale->updated_by = Auth::user()->id;
        $sale->save(); 

        foreach($request->product_id as $index => $add) {
            $product = Product::find($request->product_id[$index]);
            $update_qty = (int)$product->store_stock - (int)$request->product_qty[$index];
            $product->store_stock = $update_qty;
            $product->save();

            $saleDetail = new SaleDetail();
            $saleDetail->sales_id = $sale->id;
            $saleDetail->product_id = $request->product_id[$index];
            $saleDetail->product_code = $request->product_code[$index];
            $saleDetail->product_name = $request->product_name[$index];
            $saleDetail->photo = $request->product_photo[$index];
            $saleDetail->scale = $request->product_amount[$index];
            $saleDetail->qty = $request->product_qty[$index];
            $saleDetail->unit = $request->product_unit[$index];
            $saleDetail->discount = $request->product_discount[$index];
            $saleDetail->price = $request->product_price[$index];
            $saleDetail->amount = $request->product_amount[$index];
            $saleDetail->note = $request->product_note[$index];
            $saleDetail->save();

            $addCart = AddCart::find($request->add_cart_id[$index]);
            $addCart->delete();
        }
        $this->sendNotification($sale->id);
        return Redirect()->back();
    }

    public function getNextSaleNo()
    {
        // Get the last created order
        $lastOrder = Sale::orderBy('created_at', 'desc')->first();

        if ( ! $lastOrder )
            $number = 0;
        else
            $number = substr($lastOrder->sale_no, 3);

        // If we have ORD000001 in the database then we only want the number
        // So the substr returns this 000001

        // Add the string in front and higher up the number.
        // the %05d part makes sure that there are always 6 numbers in the string.
        // so it adds the missing zero's when needed.

        return '#SA' . sprintf('%06d', intval($number) + 1);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    public function sendNotification($id)
    {
        $users = User::whereHas('roles', function($q){
            $q->where('id', 1);
        })->get();
  
        $details = [
            'greeting' => 'Hi Administrator',
            'body' => 'This is my first notification from Nicesnippests.com',
            'thanks' => 'Thank you for using Nicesnippests.com tuto!',
            'offerText' => 'View sales',
            'offerUrl' => url('sales-cart-list/detail/'.$id),
            'quote_id' => $id,
        ];
  
        foreach ($users as $user) {
            $details['name'] = $user->name;
            $details['email'] = $user->email;

            $user->notify(new UserNotification($details));
        }

        return true;
    }

    public function saleStatus(Request $request)
    {
        $sale = Sale::find($request->sale_id);
        $sale->approve_status = $request->status;
        $sale->approve_by = Auth::user()->id;
        $sale->updated_by = Auth::user()->id;
        $sale->save();
        
        $this->sendNotification($sale->id);
        return redirect('/sale-report')->with('success', __('app.sales').__('app.label_updated_successfully'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
