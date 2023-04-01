<?php

namespace App\Http\Controllers;

use App\Exports\ExportFiles;
use App\Helpers\Helpers;
use App\Models\ExpendOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ExpendOptionsController extends Controller
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
        $expends = ExpendOptions::orderBy('id','desc')->get();
        return view('backend.expend_options.index', compact('expends'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.expend_options.create');
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

        $expendOptions = new ExpendOptions();
        $expendOptions->name = $request->name;
        $expendOptions->note = $request->note;
        $expendOptions->created_by = Auth::user()->id; 
        $expendOptions->updated_by = Auth::user()->id; 
        $expendOptions->save();

        return redirect('/expend-options')->with('success', __('app.expend_options') . __('app.label_created_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExpendOptions  $expendOptions
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expendOptions = ExpendOptions::find($id);
        $expendOptions->created_by = $expendOptions->creator->name;
        $expendOptions->updated_by = $expendOptions->updator->name;
        $expendOptions->createdat = $expendOptions->created_at->format('d-m-Y h:i:s A');
        $expendOptions->updatedat = $expendOptions->updated_at->format('d-m-Y h:i:s A');
        return response()->json($expendOptions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpendOptions  $expendOptions
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expendOptions = ExpendOptions::find($id);
        $expendOptions->created_by = $expendOptions->creator->name;
        $expendOptions->updated_by = $expendOptions->updator->name;
        $expendOptions->createdat = $expendOptions->created_at->format('d-m-Y h:i:s A');
        $expendOptions->updatedat = $expendOptions->updated_at->format('d-m-Y h:i:s A');
        return response()->json($expendOptions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExpendOptions  $expendOptions
     * @return \Illuminate\Http\Response
     */
    public function updateExpendOptions(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' =>'required',
        ],[
            'name.required' => __('app.label_name').__('app.required'),
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $expendOptions = ExpendOptions::find($request->id);
        $expendOptions->name = $request->name;
        $expendOptions->note = $request->note;
        $expendOptions->updated_by = Auth::user()->id; 
        $expendOptions->save();

        return redirect('/expend-options')->with('success', __('app.expend_options') . __('app.label_updated_successfully'));
    }

    public function exportExcel()
    {
        $file_name = 'expend_options_'.date('j_m_Y_H_i_s').'.xlsx';

        $datas = ExpendOptions::all();

        $expendOptions = $datas->map(function ($data) {
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
        
        return Helpers::exportExcel($expendOptions,$heading,$file_name);

        // return Excel::download(new ExportFiles($expendOptions,$heading,$file_name),$file_name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpendOptions  $expendOptions
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expendOptions = ExpendOptions::find($id);
        $expendOptions->delete();

        return redirect('/expend-options')->with('success', __('app.expend_options') . __('app.label_deleted_successfully'));
    }
}
