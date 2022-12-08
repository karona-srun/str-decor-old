<?php

namespace App\Http\Controllers;

use App\Http\Resources\StaffResource;
use App\Models\Attendance;
use App\Models\StaffInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function index()
    {
        $attendances = Attendance::orderBy('id', 'desc')->get();
        return view('backend.attendances.index', compact('attendances'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StaffInfo  $staffInfo
     * @return \Illuminate\Http\Response
     */
    public function listStaff()
    {
        $data = StaffResource::collection($staffInfo = StaffInfo::orderBy('id', 'desc')->get());
        return response()->json($data);
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
