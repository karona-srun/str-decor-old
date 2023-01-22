<?php

namespace App\Http\Controllers;

use App\Exports\CustomerExport;
use App\Exports\ExportFiles;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
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
    public function index()
    {
        $customers = Customer::orderBy('id','desc')->get();
        return view('backend.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'customer_address' => 'required',
        ],[
            
            'customer_name.required' => __('app.customer').__('app.required'),
            'customer_phone.required' => __('app.phone').__('app.required'),
            'customer_address.required' => __('app.current_place').__('app.required'),
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $customer = new Customer();
        $customer->customer_name = $request->customer_name;
        $customer->customer_phone = $request->customer_phone;
        $customer->customer_address = $request->customer_address;
        $customer->note = $request->note;
        $customer->created_by = Auth::user()->id;
        $customer->updated_by = Auth::user()->id;
        $customer->save();

        return redirect('/customers')->with('status', 'Customer has been created!');
    }

    public function newCustomer(Request $request)
    {
        $customer = new Customer();
        $customer->customer_name = $request->customer_name;
        $customer->customer_phone = $request->customer_phone;
        $customer->customer_address = $request->customer_address;
        $customer->note = $request->note;
        $customer->created_by = Auth::user()->id;
        $customer->updated_by = Auth::user()->id;
        $customer->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        return view('backend.customer.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('backend.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->customer_name = $request->customer_name;
        $customer->customer_phone = $request->customer_phone;
        $customer->customer_address = $request->customer_address;
        $customer->note = $request->note;
        $customer->updated_by = Auth::user()->id;
        $customer->save();
        return redirect('/customers')->with('status', 'Customer has been updated!');
    }

    public function customerExport() 
    {
        $file_name = 'customers_'.date('d_m_y_H_i_s').'.xlsx';

        $datas = Customer::all();

        $customers = $datas->map(function ($data) {
            return [
                'id' => $data->id,
                'name' => $data->customer_name,
                'phone' => $data->customer_phone,
                'address' => $data->customer_address,
                'note' => $data->note,
                'created_by' => $data->creator->name,
                'updated_by' => $data->updator->name,
                'created_at' => $data->created_at->format('d-m-Y h:i:s A'),
                'updated_at' => $data->updated_at->format('d-m-Y h:i:s A')
            ];
        });

        $heading = [
            __('app.table_no'),
            __('app.label_name').__('app.customer'),
            __('app.phone'),
            __('app.current_place'),
            __('app.label_note'),
            __('app.created_by'),
            __('app.updated_by'),
            __('app.created_at'),
            __('app.updated_at')
        ];
        
        return Excel::download(new ExportFiles($customers,$heading,$file_name),$file_name);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect('/customers')->with('status', 'Customer has been deleted!');
    }
}
