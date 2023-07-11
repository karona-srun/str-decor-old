<?php

namespace App\Http\Controllers;

use App\Http\Resources\PayrollResource;
use App\Models\Attendance;
use App\Models\Payroll;
use App\Models\StaffInfo;
use Carbon\Carbon;
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
        $payroll = Payroll::orderBy('id','desc')->with('staff')->whereBetween('date', array(Carbon::now()->firstOfMonth()->toDateString(),Carbon::now()->lastOfMonth()->toDateString()))->get();

        return view('backend.payroll.index', compact('payroll'));
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
        $payroll = new Payroll();
        $payroll->staff_id = $request->staff;
        $payroll->payroll_status = $request->payroll_status;;
        $payroll->rate_salary = $request->rate_per_hour;
        $payroll->total_hour = $request->total_hour;
        $payroll->total_salary = $request->total_salary;
        $payroll->start_date = $request->start_date;
        $payroll->end_date = $request->end_date;
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
    public function show($id)
    {
        $payroll = Payroll::find($id);
        $staff = StaffInfo::find($payroll->staff_id);

        $startDate = $payroll->start_date;
        $endDate = $payroll->end_date;

        $data = Attendance::orderBy('date', 'desc')
            ->where('staff_id', $payroll->staff_id)
            ->whereBetween('date', [$startDate, $endDate])
            ->get();

        foreach ($data as $i => $value) {
            $data[$i]['staff_id'] = $value->staff->full_name_kh;
            $data[$i]['check_in'] = $value->check_in ?? '';
            $data[$i]['check_out'] = $value->check_out ?? '';
            $data[$i]['num_hour'] = $value->num_hour ?? '';
            $data[$i]['note'] = $value->note ?? '';
            $data[$i]['total_num_hour'] = (int) $value->sumAttendance($value->staff->id);
            $data[$i]['total_salary'] = bcadd($value->sumAttendance($value->staff->id) * $staff->rate_per_hour,'0',2);
        }

        return view('backend.payroll.show', compact('data','staff','payroll'));
    }

    public function summary($id)
    {
        $payroll = Payroll::find($id);
        $staff = StaffInfo::find($payroll->staff_id);

        $startDate = $payroll->start_date;
        $endDate = $payroll->end_date;

        $data = Attendance::orderBy('date', 'desc')
            ->where('staff_id', $payroll->staff_id)
            ->whereBetween('date', [$startDate, $endDate])
            ->get()
            ->groupBy('status');

        $datas = [
            'presence' => $data['presence']->count().' '. __('app.label_day'),
            'permission' => $data['permission']->count().' '. __('app.label_day'),
            'adsent' => $data['adsent']->count().' '. __('app.label_day'),
        ];

        return view('backend.payroll.summary', compact('data','datas','staff','payroll'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
    public function destroy($id)
    {
        $payroll = Payroll::find($id);
        $payroll->delete();

        return redirect('/payroll')->with('status', 'Payroll has been deleted!');
    }
}
