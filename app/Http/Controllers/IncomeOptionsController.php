<?php

namespace App\Http\Controllers;

use App\Exports\ExportFiles;
use App\Helpers\Helpers;
use App\Models\IncomeOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class IncomeOptionsController extends Controller
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
        $incomes = IncomeOptions::orderBy('id','desc')->get();
        return view('backend.income_options.index', compact('incomes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.income_options.create');
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
            'name' =>'required',
        ],[
            'name.required' => __('app.label_name').__('app.required'),
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $incomeOptions = new IncomeOptions();
        $incomeOptions->name = $request->name;
        $incomeOptions->note = $request->note;
        $incomeOptions->created_by = Auth::user()->id; 
        $incomeOptions->updated_by = Auth::user()->id; 
        $incomeOptions->save();

        return redirect('/income-options')->with('success', __('app.income_options') . __('app.label_created_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IncomeOptions  $incomeOptions
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $incomeOptions = IncomeOptions::find($id);
        $incomeOptions->created_by = $incomeOptions->creator->name;
        $incomeOptions->updated_by = $incomeOptions->updator->name;
        $incomeOptions->createdat = $incomeOptions->created_at->format('d-m-Y h:i:s A');
        $incomeOptions->updatedat = $incomeOptions->updated_at->format('d-m-Y h:i:s A');
        return response()->json($incomeOptions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IncomeOptions  $incomeOptions
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $incomeOptions = IncomeOptions::find($id);
        $incomeOptions->created_by = $incomeOptions->creator->name;
        $incomeOptions->updated_by = $incomeOptions->updator->name;
        $incomeOptions->createdat = $incomeOptions->created_at->format('d-m-Y h:i:s A');
        $incomeOptions->updatedat = $incomeOptions->updated_at->format('d-m-Y h:i:s A');
        return response()->json($incomeOptions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IncomeOptions  $incomeOptions
     * @return \Illuminate\Http\Response
     */
    public function updateOptionsIncome(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' =>'required',
        ],[
            'name.required' => __('app.label_name').__('app.required'),
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        
        $incomeOptions = IncomeOptions::find($request->id);
        $incomeOptions->name = $request->name;
        $incomeOptions->note = $request->note;
        $incomeOptions->updated_by = Auth::user()->id; 
        $incomeOptions->save();

        return redirect('/income-options')->with('success', __('app.income_options') . __('app.label_updated_successfully'));
    }

    public function exportExcel()
    {
        $file_name = 'income_options_'.date('j_m_Y_H_i_s').'.xlsx';

        $datas = IncomeOptions::all();

        $incomeOptions = $datas->map(function ($data) {
            return [
                'id' => $data->id,
                'name' => $data->name,
                'note' => $data->note
            ];
        });

        $heading = [
            __('app.table_no'),
            __('app.label_name'),
            __('app.label_note')
        ];

        return Helpers::exportExcel($incomeOptions,$heading,$file_name);
        
        // return Excel::download(new ExportFiles($incomeOptions,$heading,$file_name),$file_name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IncomeOptions  $incomeOptions
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $incomeOptions = IncomeOptions::find($id);
        $incomeOptions->delete();

        return redirect('/income-options')->with('success', __('app.income_options') . __('app.label_updated_successfully'));
    }
}
