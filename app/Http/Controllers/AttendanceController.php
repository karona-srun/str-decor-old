<?php

namespace App\Http\Controllers;

use App\Exports\ExportFiles;
use App\Helpers\Helper as HelpersHelper;
use App\Helpers\Helpers as HelpersHelpers;
use App\Http\Resources\StaffResource;
use App\Models\Attendance;
use App\Models\StaffInfo;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Helpers\Helpers;

class AttendanceController extends Controller
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
        $staff = StaffInfo::orderBy('id','desc')->get();
        $query = Attendance::query();

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->staff) {
            $query->where('staff_id', $request->staff);
        }

        if ($request->start_date || $request->end_date) {
            $query->whereBetween('date', array($request->start_date,$request->end_date));
        }else{
            $query->whereDate('date','=', Carbon::today()->toDateString());
        }

        $attendances = $query->get();
        if($request->export == "enabled"){
            return $this->processExcel($attendances);
        }
        // $attendances = $query->whereDate('date','=', Carbon::today()->toDateString())->get();
        // $attendances = Attendance::orderBy('id', 'desc')->whereDate('date','=', Carbon::today()->toDateString())->get();
        return view('backend.attendances.index', compact('attendances', 'staff'));
    }

    public function processExcel($attendances)
    {
        $file_name = 'Attendances_'.date('j_m_Y_H_i_s').'.xlsx';

        $datas = $attendances->map(function ($data) {
            return [
                'id' => $data->id,
                'date' => $data->date,
                'name' => $data->staff->full_name_kh,
                'status' => $data->status,
                'check_in' => $data->check_in,
                'check_out' => $data->check_out,
                'num_hour' => $data->num_hour,
                'note' => $data->note,
                'created_by' => $data->creator->name,
                'updated_by' => $data->updator->name,
                'created_at' => $data->created_at->format('d-m-Y h:i:s A'),
                'updated_at' => $data->updated_at->format('d-m-Y h:i:s A')
            ];
        });

        $heading = [
            __('app.table_no'),
            __('app.table_date'),
            __('app.table_staff_name'),
            __('app.table_status'),
            __('app.table_checkin'),
            __('app.table_checkout'),
            __('app.num_hour'),
            __('app.label_note'),
            __('app.created_by'),
            __('app.updated_by'),
            __('app.created_at'),
            __('app.updated_at')
        ];
        
        return Helpers::exportExcel($datas,$heading,$file_name);
        //Excel::download(new ExportFiles($datas,$heading,$file_name),$file_name);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StaffInfo  $staffInfo
     * @return \Illuminate\Http\Response
     */
    public function listStaff()
    {
        $data = StaffResource::collection(StaffInfo::orderBy('id', 'desc')->get());
        return response()->json($data);
    }

    public function filterAttendances($id)
    {
        $data = Attendance::orderBy('date', 'desc')->where('staff_id',$id)->get();
        $staff = StaffInfo::find($id);
        $staff->position = $staff->positions;

        foreach ($data as $i => $value) {
            $data[$i]['staff_id'] = $value->staff->full_name_kh;
            $data[$i]['check_in'] = $value->check_in ?? '';
            $data[$i]['check_out'] = $value->check_out ?? '';
            $data[$i]['num_hour'] = $value->num_hour ?? '';
            $data[$i]['note'] = $value->note ?? '';
            $data[$i]['total_num_hour'] = (int) $value->sumAttendance($value->staff->id);
            $data[$i]['total_salary'] = bcadd($value->sumAttendance($value->staff->id) * $staff->rate_per_hour,'0',2);
        }

        return response()->json(['data' => $data ,'staff' => $staff]);
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
        $attendance = new Attendance();
        $attendance->staff_id = $request->staff_id;
        $attendance->date = $request->date;
        $attendance->status = $request->status_;
        $attendance->check_in = $request->checkin;
        $attendance->check_out = $request->checkout;
        $attendance->num_hour = $request->num_hour;
        $attendance->note = $request->note;
        $attendance->created_by = Auth::user()->id;
        $attendance->updated_by = Auth::user()->id;
        $attendance->save();

        return redirect('/attendances')->with('status', 'Attendance has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $attendance = Attendance::find($id);
        return response()->json($attendance);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attendance = Attendance::find($id);
        return response()->json($attendance);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function updateAttendances(Request $request)
    {
        $attendance = Attendance::find($request->id);
        $attendance->date = $request->date;
        $attendance->status = $request->status;
        $attendance->check_in = $request->checkin;
        $attendance->check_out = $request->checkout;
        $attendance->num_hour = $request->num_hour;
        $attendance->note = $request->note;
        $attendance->updated_by = Auth::user()->id;
        $attendance->save();

        return redirect('/attendances')->with('status', 'Attendance has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attendance = Attendance::find($id);
        $attendance->delete();

        return redirect('/attendances')->with('status', 'Attendance has been deleted!');
    }
}
