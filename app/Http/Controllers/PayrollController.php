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
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sum;

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
    public function index(Request $request)
    {

        $query = Payroll::query();
        // ->whereBetween('date', array($request->start_date, $request->end_date))->get();
        // $query = Attendance::query();

        if ($request->staff) {
            $query->where('staff_id', $request->staff);
        }

        if ($request->start_date || $request->end_date) {
            $query->whereBetween('date', array($request->start_date,$request->end_date));
        }else{
            $query->whereBetween('date', array(Carbon::now()->firstOfMonth()->toDateString(), Carbon::now()->lastOfMonth()->toDateString()));
        }

        $payroll = $query->orderBy('id', 'desc')->with('staff')->get();
        $staffs = StaffInfo::get();
     
        return view('backend.payroll.index', compact('payroll','staffs'));
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
        $validator = Validator::make($request->all(), [
            'staff'          => 'required',
            'payroll_status' => 'required',
            'start_date'     => 'required',
            'end_date'       => 'required',
            'rate_per_hour'  => 'required',
            'date'           => 'required'
        ], [
            'staff.required'                => __('app.staff') . __('app.required'),
            'payroll_status.required'       => __('app.payroll_status') . __('app.required'),
            'start_date.required'           => __('app.start_date') . __('app.required'),
            'end_date.required'             => __('app.end_date') . __('app.required'),
            'rate_per_hour.required'        => __('app.rate_per_hour') . __('app.required'),
            'date.required'                 => __('app.date') . __('app.required')
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $payroll = new Payroll();
        $payroll->staff_id       = $request->staff;
        $payroll->payroll_status = $request->payroll_status;;
        $payroll->rate_salary    = $request->rate_per_hour;
        $payroll->total_hour     = $request->total_hour;
        $payroll->total_salary   = $request->total_salary;
        $payroll->start_date     = $request->start_date;
        $payroll->end_date       = $request->end_date;
        $payroll->date           = $request->date;
        $payroll->note           = $request->note;
        $payroll->created_by     = Auth::user()->id;
        $payroll->updated_by     = Auth::user()->id;

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
            $data[$i]['total_salary'] = bcadd($value->sumAttendance($value->staff->id) * $staff->rate_per_hour, '0', 2);
        }

        return view('backend.payroll.show', compact('data', 'staff', 'payroll'));
    }

    public function summary($id)
    {
        $payroll = Payroll::find($id);
        $staff = StaffInfo::find($payroll->staff_id);

        $startDate = $payroll->start_date;
        $endDate = $payroll->end_date;

        // $data = Attendance::orderBy('date', 'desc')
        //     ->where('staff_id', $payroll->staff_id)
        //     ->whereBetween('date', [$startDate, $endDate])
        //     ->get()
        //     ->countBy('status');

        // $presence = Attendance::orderBy('date', 'desc')
        //     ->where('staff_id', $payroll->staff_id)
        //     ->where('status', 'presence')
        //     ->whereBetween('date', [$startDate, $endDate])
        //     ->get();
        // $permission = Attendance::orderBy('date', 'desc')
        //     ->where('staff_id', $payroll->staff_id)
        //     ->where('status', 'permission')
        //     ->whereBetween('date', [$startDate, $endDate])
        //     ->count();
        // $adsent = Attendance::orderBy('date', 'desc')
        //     ->where('staff_id', $payroll->staff_id)
        //     ->where('status', 'adsent')
        //     ->whereBetween('date', [$startDate, $endDate])
        //     ->count();


        // $data['persence'] = $payroll->total_hour.' '. __('app.num_hour') ?? 0;
        // $data['permission'] = $permission.' '.__('app.label_day');
        // $data['adsent'] = $adsent.' '.__('app.label_day');

        // Assuming $payroll is an instance of Payroll model and $startDate, $endDate are defined

        $attendances = Attendance::where('staff_id', $payroll->staff_id)
        ->whereBetween('date', [$startDate, $endDate])
        ->get();

        $presence = $attendances->where('status', 'presence');
        $permissionCount = $attendances->where('status', 'permission')->count();
        $absentCount = $attendances->where('status', 'adsent')->count();

        $data['presence'] = $payroll->total_hour . ' ' . __('app.num_hour') ?? 0;
        $data['permission'] = $permissionCount . ' ' . __('app.label_day');
        $data['absent'] = $absentCount . ' ' . __('app.label_day');

        return view('backend.payroll.summary', compact('data', 'staff', 'payroll'));
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
