<?php

namespace App\Http\Controllers;

use App\Exports\ExportFiles;
use App\Helpers\Helpers;
use App\Models\Expend;
use App\Models\ExpendOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ExpendController extends Controller
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
        $expends = Expend::orderBy('id','desc')->get();
        return view('backend.expends.index', compact('expends'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $expend_options = ExpendOptions::orderBy('id','desc')->get();
        return view('backend.expends.create', compact('expend_options'));
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
            'expend_option' =>'required',
            'name' =>'required',
            'date' =>'required',
            'amount' =>'required',
        ],[
            'expend_option.required' => __('app.expend_info').' '.__('app.required'),
            'name.required' => __('app.label_name').' '.__('app.required'),
            'date.required' => __('app.label_payment_date').' '.__('app.required'),
            'amount.required' => __('app.label_amount').' '.__('app.required'),
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $expend = new Expend();
        $expend->expend_option_id = $request->expend_option;
        $expend->name = $request->name;
        $expend->date = $request->date;
        $expend->amount = $request->amount;
        $expend->note = $request->note;
        $expend->created_by = Auth::user()->id;
        $expend->updated_by = Auth::user()->id;
        $expend->save();

        return redirect('/expends')->with('status', 'Expends has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expend  $expend
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expend = Expend::find($id);
        return view('backend.expends.show', compact('expend'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expend  $expend
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expend = Expend::find($id);
        $expend_options = ExpendOptions::orderBy('id','desc')->get();
        return view('backend.expends.edit', compact('expend','expend_options'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expend  $expend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'expend_option' =>'required',
            'name' =>'required',
            'date' =>'required',
            'amount' =>'required',
        ],[
            'expend_option.required' => __('app.expend_info').' '.__('app.required'),
            'name.required' => __('app.label_name').' '.__('app.required'),
            'date.required' => __('app.label_payment_date').' '.__('app.required'),
            'amount.required' => __('app.label_amount').' '.__('app.required'),
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $expend = Expend::find($id);
        $expend->expend_option_id = $request->expend_option;
        $expend->name = $request->name;
        $expend->date = $request->date;
        $expend->amount = $request->amount;
        $expend->note = $request->note;
        $expend->updated_by = Auth::user()->id;
        $expend->save();

        return redirect('/expends')->with('status', 'Expends has been updated!');
    }

    public function exportExcel()
    {
        $file_name = 'Expends_'.date('j_m_Y_H_i_s').'.xlsx';

        $datas = Expend::all();

        $incomes = $datas->map(function ($data) {
            return [
                'id' => $data->id,
                'type_income' => $data->expendOptions->name,
                'name' => $data->name,
                'amount' => '$'.$data->amount,
                'date' => $data->date,
                'note' => $data->note,
                'created_by' => $data->creator->name,
                'updated_by' => $data->updator->name,
                'created_at' => $data->created_at->format('d-m-Y h:i:s A'),
                'updated_at' => $data->updated_at->format('d-m-Y h:i:s A')
            ];
        });

        $heading = [
            __('app.table_no'),
            __('app.label_type_expend'),
            __('app.label_name'),
            __('app.label_amount'),
            __('app.table_date'),
            __('app.label_note'),
            __('app.created_by'),
            __('app.updated_by'),
            __('app.created_at'),
            __('app.updated_at')
        ];

        return Helpers::exportExcel($incomes,$heading,$file_name);
        
        // return Excel::download(new ExportFiles($incomes,$heading,$file_name),$file_name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expend  $expend
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expend = Expend::find($id);
        $expend->delete();

        return redirect('/expends')->with('status', 'Expend has been deleted!');
    }
}
