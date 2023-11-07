<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Customer;
use App\Models\SaleOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class SaleOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $saleOrders = SaleOrder::latest()->get();
        $saleOrderDaily = SaleOrder::createdToday()->count();
        $saleOrderMonthly = SaleOrder::createdThisMonth()->count();
        return view('backend.salesorder.index', compact('saleOrders', 'saleOrderDaily', 'saleOrderMonthly'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::orderBy('customer_name','desc')->get();
        return view('backend.salesorder.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'customer_id' =>'required',
            'sale_order' =>'required',
            'reference' =>'required',
            'sale_order_date' =>'required',
            'expected_shipment_date' =>'required',
            'warehouse' =>'required',
            'sale_person' =>'required',
            'delivery_method' =>'required',
        ],[
            'customer_id.required' => __('app.customer_name').' '.__('app.required'),
            'sale_order.required' => __('app.sale_order').' '.__('app.required'),
            'reference.required' => __('app.reference').' '.__('app.required'),
            'sale_order_date.required' => __('app.sale_order_date').' '.__('app.required'),
            'expected_shipment_date.required' => __('app.expected_shipment_date').' '.__('app.required'),
            'warehouse.required' => __('app.warehouse_name').' '.__('app.required'),
            'sale_person.required' => __('app.sale_person').' '.__('app.required'),
            'delivery_method.required' => __('app.delivery_method').' '.__('app.required'),
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $imageName = "";
        if($request->hasFile('reference')){
            $imageName = 'sale_order_'.time().rand(1,99999).'.'.$request->reference->getClientOriginalExtension();
            $imageName = str_replace(' ','_',$imageName);
            $request->reference->move(public_path('sales_order'), $imageName);
        }
        
        $saleOrder = new SaleOrder();
        $saleOrder->customer_id = $request->customer_id;
        $saleOrder->sale_order = $request->sale_order;
        $saleOrder->reference = $imageName;
        $saleOrder->sale_order_date = $request->sale_order_date;
        $saleOrder->expected_shipment_date = $request->expected_shipment_date;
        $saleOrder->warehouse = $request->warehouse;
        $saleOrder->sale_person = $request->sale_person;
        $saleOrder->delivery_method = $request->delivery_method;
        $saleOrder->save();

        return redirect('/sales-order')->with('success', __('app.sale_order').__('app.label_created_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function show(SaleOrder $saleOrder)
    {
        $customers = Customer::orderBy('customer_name','desc')->get();
        return view('backend.salesorder.create', compact('customers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers = Customer::orderBy('customer_name','desc')->get();
        $saleOrder = SaleOrder::find($id);
        return view('backend.salesorder.edit', compact('customers','saleOrder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'customer_id' =>'required',
            'sale_order' =>'required',
            'sale_order_date' =>'required',
            'expected_shipment_date' =>'required',
            'warehouse' =>'required',
            'sale_person' =>'required',
            'delivery_method' =>'required',
        ],[
            'customer_id.required' => __('app.customer_name').' '.__('app.required'),
            'sale_order.required' => __('app.sale_order').' '.__('app.required'),
            'sale_order_date.required' => __('app.sale_order_date').' '.__('app.required'),
            'expected_shipment_date.required' => __('app.expected_shipment_date').' '.__('app.required'),
            'warehouse.required' => __('app.warehouse_name').' '.__('app.required'),
            'sale_person.required' => __('app.sale_person').' '.__('app.required'),
            'delivery_method.required' => __('app.delivery_method').' '.__('app.required'),
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $imageName = "";
        if($request->hasFile('reference')){
            $imageName = 'sale_order_'.time().rand(1,99999).'.'.$request->reference->getClientOriginalExtension();
            $imageName = str_replace(' ','_',$imageName);
            $request->reference->move(public_path('sales_order'), $imageName);
        }
        
        $saleOrder = SaleOrder::find($id);
        $saleOrder->customer_id = $request->customer_id;
        $saleOrder->sale_order = $request->sale_order;
        $saleOrder->reference = $imageName;
        $saleOrder->sale_order_date = $request->sale_order_date;
        $saleOrder->expected_shipment_date = $request->expected_shipment_date;
        $saleOrder->warehouse = $request->warehouse;
        $saleOrder->sale_person = $request->sale_person;
        $saleOrder->delivery_method = $request->delivery_method;
        $saleOrder->save();

        return redirect('/sales-order')->with('success', __('app.sale_order').__('app.label_created_successfully'));
    }

    public function getDownload($id)
    {
        $saleOrder = SaleOrder::find($id);
        $file= 'sales_order/'. $saleOrder->reference;
        $headers = array(
            'Content-Type: application/*',
        );

        return Response::download($file, $saleOrder->reference, $headers);
    }

    public function exportExcel() {
        $file_name = 'SaleOrder_' . date('d_m_y_H_i_s') . '.xlsx';

        $datas = SaleOrder::all();

        $saleOrder = $datas->map(function ($data) {
            return [
                'id' => $data->id,
                'customer_name' => $data->customer->customer_name ?? 'N/A',
                'sale_order' => $data->sale_order,
                'sale_order_date' => $data->sale_order_date,
                'expected_shipment_date' => $data->expected_shipment_date,
                'warehouse' => $data->warehouse,
                'sale_person' => $data->sale_person,
                'delivery_method' => $data->delivery_method,
                'created_at' => $data->created_at,
                'updated_at' => $data->updated_at
            ];
        });

        $heading = [
            __('app.table_no') ,
            __('app.customer_name') ,
            __('app.sale_order') ,
            __('app.sale_order_date') ,
            __('app.expected_shipment_date') ,
            __('app.warehouse_name') ,
            __('app.sale_person') ,
            __('app.delivery_method') ,
            __('app.created_at') ,
            __('app.updated_at') ,
        ];

        return Helpers::exportExcel($saleOrder, $heading, $file_name);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $saleOrder = SaleOrder::find($id);
        $saleOrder->delete();
        return redirect('/sales-order')->with('success', __('app.sale_order').__('app.label_deleted_successfully'));
    }
}
