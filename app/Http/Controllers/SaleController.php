<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\AddCart;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Sale;
use App\Models\SaleDetail;
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
                'total_price' => '$'.$data->total_price,
                'created_by' => $data->creator->name,
                'updated_by' => $data->updator->name,
                'created_at' => $data->created_at->format('d-m-Y h:i:s A'),
                'updated_at' => $data->updated_at->format('d-m-Y h:i:s A')
            ];
        });

        $heading = [
            __('app.table_no'),
            __('app.label_invoice_no'),
            __('app.customer'),
            __('app.label_total_qty'),
            __('app.label_total_price'),
            __('app.created_by'),
            __('app.updated_by'),
            __('app.created_at'),
            __('app.updated_at')
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
            $total_qty += $request->qty[$index];
            $total_price += $request->price[$index];
        }

        $countDaily = Sale::whereDate('created_at','=', Carbon::today()->toDateString())->count();
        $sale_no = '#'.$countDaily + 1;

        $sale = new Sale();
        $sale->sale_no = $sale_no;
        $sale->customer_id = $request->customer;
        $sale->total_qty = $total_qty;
        $sale->total_price = $total_price;
        $sale->created_by = Auth::user()->id;
        $sale->updated_by = Auth::user()->id;
        $sale->save(); 

        foreach($request->product_id as $index => $add) {
            // $product = Product::find($request->product_id[$index]);
            // $update_qty = (int)$product->store_stock - (int)$request->qty[$index];
            // $product->store_stock = $update_qty;
            // $product->save();

            $saleDetail = new SaleDetail();
            $saleDetail->sales_id = $sale->id;
            $saleDetail->product_id = $request->product_id[$index];
            $saleDetail->product_code = $request->product_code[$index];
            $saleDetail->product_name = $request->product_name[$index];
            $saleDetail->scale = $request->scale[$index];
            $saleDetail->qty = $request->qty[$index];
            $saleDetail->price = $request->price[$index];
            $saleDetail->note = $request->note[$index];
            $saleDetail->save();

            $addCart = AddCart::find($request->add_cart_id[$index]);
            $addCart->delete();
        }
        return Redirect()->back();
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
