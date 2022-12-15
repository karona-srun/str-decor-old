<?php

namespace App\Http\Controllers;

use App\Http\Resources\PayrollResource;
use App\Models\Attendance;
use App\Models\Payroll;
use App\Models\StaffInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PayrollController extends Controller
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
        $staffs = StaffInfo::with('attendances')->get();

        // dd($staffs);

        return view('backend.payroll.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $staffs = StaffInfo::with('attendances')->get();

        $staffs = StaffInfo::get();

        return view('backend.payroll.create', compact('staffs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $payroll = new Payroll();
        $payroll->staff_id = $request->staff;
        $payroll->payroll_status = $request->payroll_status;;
        $payroll->rate_salary = $request->rate_per_hour;
        $payroll->total_hour = $request->total_hour;
        $payroll->total_salary = $request->total_salary;
        $payroll->date = $request->date;
        $payroll->note = $request->note;
        $payroll->created_by = Auth::user()->id;
        $payroll->updated_by = Auth::user()->id;

        $payroll->save();
        return redirect('/payroll')->with('status', 'Payroll has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function show(Payroll $payroll)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function edit(Payroll $payroll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payroll $payroll)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payroll $payroll)
    {
        //
    }
}
