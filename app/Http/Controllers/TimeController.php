<?php

namespace App\Http\Controllers;

use App\Exports\ExportFiles;
use App\Helpers\Helpers;
use App\Models\Time;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Maatwebsite\Excel\Facades\Excel;

class TimeController extends Controller
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
        $times = Time::orderBy('id','desc')->get();
        return view('backend.times.index', compact('times'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.times.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = FacadesValidator::make($request->all(),[
            'name' =>'required',
            'start_time' =>'required',
            'end_time' =>'required',
        ],[
            'name.required' => __('app.label_name').' '.__('app.required'),
            'start_time.required' => __('app.start_time').' '.__('app.required'),
            'end_time.required' => __('app.label_end_time').' '.__('app.required'),
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $time = new Time();
        $time->name = $request->name;
        $time->start_time = $request->start_time;
        $time->end_time = $request->end_time;
        $time->note = $request->note;
        $time->created_by = Auth::user()->id; 
        $time->updated_by = Auth::user()->id; 
        $time->save();

        return redirect('/times')->with('status', 'Time has been updated!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $time = Time::find($id);
        $time->created_by = $time->creator->name;
        $time->updated_by = $time->updator->name;
        $time->createdat = $time->created_at->format('d-m-Y h:i:s A');
        $time->updatedat = $time->updated_at->format('d-m-Y h:i:s A');
        return response()->json($time);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $time = Time::find($id);
        $time->created_by = $time->creator->name;
        $time->updated_by = $time->updator->name;
        $time->createdat = $time->created_at->format('d-m-Y h:i:s A');
        $time->updatedat = $time->updated_at->format('d-m-Y h:i:s A');
        return response()->json($time);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function updateTime(Request $request)
    {
        $time = Time::find($request->id);
        $time->name = $request->name;
        $time->start_time = $request->start_time;
        $time->end_time = $request->end_time;
        $time->note = $request->note;
        $time->updated_by = Auth::user()->id; 
        $time->save();

        return redirect('/times')->with('status', 'Time has been updated!');
    }


    public function timeExport() 
    {
        $file_name = 'time_'.date('d_m_y_H_i_s').'.xlsx';

        $datas = Time::all();

        $time = $datas->map(function ($data) {
            return [
                'id' => $data->id,
                'name' => $data->name,
                'note' => $data->note,
                'created_by' => $data->creator->name,
                'updated_by' => $data->updator->name,
                'created_at' => $data->created_at->format('d-m-Y h:i:s A'),
                'updated_at' => $data->updated_at->format('d-m-Y h:i:s A')
            ];
        });

        $heading = [
            __('app.table_no'),
            __('app.label_name'),
            __('app.label_note'),
            __('app.created_by'),
            __('app.updated_by'),
            __('app.created_at'),
            __('app.updated_at')
        ];

        return Helpers::exportExcel($time,$heading,$file_name);
        
        // return Excel::download(new ExportFiles($time,$heading,$file_name),$file_name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $time = Time::find($id);
        $time->delete();

        return redirect('/times')->with('status', 'Time has been deleted!');
    }
}
