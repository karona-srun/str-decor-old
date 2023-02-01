<?php

namespace App\Http\Controllers;

use App\Exports\ExportFiles;
use App\Helpers\Helpers;
use App\Models\Workplace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class WorkplaceController extends Controller
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
        $workplace = Workplace::orderBy('id','desc')->get();
        return view('backend.workplace.index', compact('workplace'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.workplace.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $workplace = new Workplace();
        $workplace->name = $request->name;
        $workplace->note = $request->note;
        $workplace->status = $request->status;
        $workplace->created_by = Auth::user()->id; 
        $workplace->updated_by = Auth::user()->id; 
        $workplace->save();

        return redirect('/workplace')->with('status', 'Work place has been created!');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Workplace  $workplace
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $workplace = Workplace::find($id);
        $workplace->created_by = $workplace->creator->name;
        $workplace->updated_by = $workplace->updator->name;
        $workplace->created_at = $workplace->created_at->format('d-m-Y h:i:s A');
        $workplace->updated_at = $workplace->updated_at->format('d-m-Y h:i:s A');
        return response()->json($workplace);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Workplace  $workplace
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Workplace  $workplace
     * @return \Illuminate\Http\Response
     */
    public function updateWorkplace(Request $request)
    {
        $workplace = Workplace::find($request->id);
        $workplace->name = $request->name;
        $workplace->note = $request->note;
        $workplace->status = $request->status;
        $workplace->updated_by = Auth::user()->id; 
        $workplace->save();

        return redirect('/workplace')->with('status', 'Work place has been updated!');
    }

    public function workplaceExportExcel()
    {
        $file_name = 'workplace_'.date('d_m_y_H_i_s').'.xlsx';

        $datas = Workplace::all();

        $time = $datas->map(function ($data) {
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
        
        return Helpers::exportExcel($time,$heading,$file_name);

        // return Excel::download(new ExportFiles($time,$heading,$file_name),$file_name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Workplace  $workplace
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $workplace = Workplace::find($id);
        $workplace->delete();

        return redirect('/workplace')->with('status', 'Work place has been deleted!');
    }
}
