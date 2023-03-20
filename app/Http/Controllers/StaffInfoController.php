<?php

namespace App\Http\Controllers;

use App\Exports\ExportFiles;
use App\Helpers\Helpers;
use App\Models\Attachment;
use App\Models\BaseSalary;
use App\Models\Position;
use App\Models\StaffInfo;
use App\Models\Time;
use App\Models\Workplace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class StaffInfoController extends Controller
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
        $staffInfo = StaffInfo::orderBy('id','desc')->get();
        return view('backend.staffinfo.index', compact('staffInfo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $position = Position::orderBy('name','desc')->get();
        $workPlace = Workplace::orderBy('name','desc')->get();
        $baseSalary = BaseSalary::orderBy('name','desc')->get();
        $times = Time::orderBy('name','desc')->get();
        return view('backend.staffinfo.create', compact('times','position','workPlace','baseSalary'));
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
            'first_name' =>'required',
            'last_name' =>'required',
            'first_name_kh' =>'required',
            'last_name_kh' =>'required',
            'gender' =>'required',
            'phone' =>'required',
            'email' =>'required',
            'birth_of_date' =>'required',
            'birth_of_place' =>'required',
            'current_place' =>'required',
            'position' =>'required',
            'work_place' =>'required',
            'base_salary' =>'required',
            'rate_per_hour' => 'required',
            'work_time' =>'required',
            'start_work' =>'required',
        ],[
            'first_name.required' => __('app.first_name').' '.__('app.required'),
            'last_name.required' => __('app.last_name').' '.__('app.required'),
            'first_name_kh.required' => __('app.first_name_kh').' '.__('app.required'),
            'last_name_kh.required' => __('app.last_name_kh').' '.__('app.required'),
            'gender.required' => __('app.gender').' '.__('app.required'),
            'phone.required' => __('app.phone').' '.__('app.required'),
            'email.required' => __('app.email').' '.__('app.required'),
            'birth_of_date.required' => __('app.birth_of_date').' '.__('app.required'),
            'birth_of_place.required' => __('app.birth_of_place').' '.__('app.required'),
            'current_place.required' => __('app.current_place').' '.__('app.required'),
            'position.required' => __('app.position').' '.__('app.required'),
            'work_place.required' => __('app.work_place').' '.__('app.required'),
            'base_salary.required' => __('app.base_salary').' '.__('app.required'),
            'rate_per_hour.required' => __('app.rate_per_hour').' '.__('app.required'),
            'work_time.required' => __('app.work_time').' '.__('app.required'),
            'start_work.required' => __('app.start_work').' '.__('app.required'),
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $imageName= 'avatar.png';
        if($request->hasFile('photo')){
            $imageName = 'staff_info_'.time().rand(1,99999).'.'.$request->photo->getClientOriginalExtension();
            $imageName = str_replace(' ','_',$imageName);
            $request->photo->move(public_path('photos'), $imageName);
        }

        $staffInfo = new StaffInfo();
        $staffInfo->first_name = $request->first_name;
        $staffInfo->last_name = $request->last_name;
        $staffInfo->first_name_kh = $request->first_name_kh;
        $staffInfo->last_name_kh = $request->last_name_kh;
        $staffInfo->gender = $request->gender;
        $staffInfo->email = $request->email;
        $staffInfo->phone = $request->phone;
        $staffInfo->photo = $imageName;
        $staffInfo->birth_of_date = $request->birth_of_date;
        $staffInfo->birth_of_place = $request->birth_of_place;
        $staffInfo->current_place = $request->current_place;
        $staffInfo->position = $request->position;
        $staffInfo->work_place = $request->work_place;
        $staffInfo->rate_per_hour = $request->rate_per_hour;
        $staffInfo->base_salary = $request->base_salary;
        $staffInfo->work_time = $request->work_time;
        $staffInfo->start_work = $request->start_work;
        $staffInfo->stop_work = $request->stop_work;
        $staffInfo->note = $request->note;
        $staffInfo->created_by = Auth::user()->id; 
        $staffInfo->updated_by = Auth::user()->id;
        $staffInfo->save();

        $images = [];
        if ($request->filenames){
            foreach($request->filenames as $key => $image)
            {
                $imageName = 'staff_info_'.time().rand(1,99999).'.'.$image->getClientOriginalExtension();  
                $imageName = str_replace(' ','_',$imageName);
                $image->move(public_path('attachments'), $imageName);
                $attachment = new Attachment();
                $attachment->name = $imageName;
                $attachment->path = $image;
                $attachment->type_id = $staffInfo->id;
                $attachment->type = 'staff_info';
                $attachment->save();
            }
        }

        return redirect('/staff-info')->with('status', 'Staff Info has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StaffInfo  $staffInfo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $staffInfo = StaffInfo::find($id);
        $position = Position::orderBy('name','desc')->get();
        $workPlace = Workplace::orderBy('name','desc')->get();
        $baseSalary = BaseSalary::orderBy('name','desc')->get();
        $times = Time::orderBy('name','desc')->get();
        $attachments = Attachment::where([['type_id',$id],['type','staff_info']])->get(); 
        return view('backend.staffinfo.show', compact('attachments','times','staffInfo','position','workPlace','baseSalary'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StaffInfo  $staffInfo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staffInfo = StaffInfo::find($id);
        $position = Position::orderBy('name','desc')->get();
        $workPlace = Workplace::orderBy('name','desc')->get();
        $baseSalary = BaseSalary::orderBy('name','desc')->get();
        $times = Time::orderBy('name','desc')->get();
        $attachments = Attachment::where(['type_id'=>$id,'type'=>'staff_info'])->get();
        return view('backend.staffinfo.show', compact('attachments','times','staffInfo','position','workPlace','baseSalary'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StaffInfo  $staffInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {       
        $validator = Validator::make($request->all(),[
            'first_name' =>'required',
            'last_name' =>'required',
            'first_name_kh' =>'required',
            'last_name_kh' =>'required',
            'gender' =>'required',
            'phone' =>'required',
            'email' =>'required',
            'birth_of_date' =>'required',
            'birth_of_place' =>'required',
            'current_place' =>'required',
            'position' =>'required',
            'work_place' =>'required',
            'base_salary' =>'required',
            'rate_per_hour' => 'required',
            'start_work' =>'required',
            'work_time' =>'required',
        ],[
            'first_name.required' => __('app.first_name').' '.__('app.required'),
            'last_name.required' => __('app.last_name').' '.__('app.required'),
            'first_name_kh.required' => __('app.first_name_kh').' '.__('app.required'),
            'last_name_kh.required' => __('app.last_name_kh').' '.__('app.required'),
            'gender.required' => __('app.gender').' '.__('app.required'),
            'phone.required' => __('app.phone').' '.__('app.required'),
            'email.required' => __('app.email').' '.__('app.required'),
            'birth_of_date.required' => __('app.birth_of_date').' '.__('app.required'),
            'birth_of_place.required' => __('app.birth_of_place').' '.__('app.required'),
            'current_place.required' => __('app.current_place').' '.__('app.required'),
            'position.required' => __('app.position').' '.__('app.required'),
            'work_place.required' => __('app.work_place').' '.__('app.required'),
            'base_salary.required' => __('app.base_salary').' '.__('app.required'),
            'rate_per_hour.required' => __('app.rate_per_hour').' '.__('app.required'),
            'start_work.required' => __('app.start_time').' '.__('app.required'),
            'work_time.required' => __('app.work_time').' '.__('app.required'),
        ]);

        

        if($validator->fails()) {
            
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $staffInfo = StaffInfo::find($id);

        if($request->hasFile('photo')){
            File::delete('photos/'.$staffInfo->photo);
            $imageName = 'staff_info_'.time().rand(1,99999).'.'.$request->photo->getClientOriginalExtension();
            $imageName = str_replace(' ','_',$imageName);
            $request->photo->move(public_path('photos'), $imageName);
            $staffInfo->photo = $imageName;
        }

        $staffInfo->first_name = $request->first_name;
        $staffInfo->last_name = $request->last_name;
        $staffInfo->first_name_kh = $request->first_name_kh;
        $staffInfo->last_name_kh = $request->last_name_kh;
        $staffInfo->gender = $request->gender;
        $staffInfo->email = $request->email;
        $staffInfo->phone = $request->phone;
        $staffInfo->birth_of_date = $request->birth_of_date;
        $staffInfo->birth_of_place = $request->birth_of_place;
        $staffInfo->current_place = $request->current_place;
        $staffInfo->position = $request->position;
        $staffInfo->work_place = $request->work_place;
        $staffInfo->rate_per_hour = $request->rate_per_hour;
        $staffInfo->base_salary = $request->base_salary;
        $staffInfo->work_time = $request->work_time;
        $staffInfo->start_work = $request->start_work;
        $staffInfo->stop_work = $request->stop_work;
        $staffInfo->note = $request->note;
        $staffInfo->updated_by = Auth::user()->id;
        $staffInfo->save();

        $images = [];
        if ($request->filenames){
            foreach($request->filenames as $key => $image)
            {
                File::delete('attachments/'.$staffInfo->photo);
                $imageName = 'staff_info_'.time().rand(1,99999).'.'.$image->getClientOriginalExtension();  
                $imageName = str_replace(' ','_',$imageName);
                $image->move(public_path('attachments'), $imageName);

                $attachment = new Attachment();
                $attachment->name = $imageName;
                $attachment->path = $image;
                $attachment->type_id = $staffInfo->id;
                $attachment->type = 'staff_info';
                $attachment->save();
            }
        }

        return redirect('/staff-info')->with('status', 'Staff Info has been updated!');
    }

    public function staffExport() 
    {
        $file_name = 'staff_'.date('d_m_y_H_i_s').'.xlsx';

        $datas = StaffInfo::all();

        $staff = $datas->map(function ($data) {
            return [
                'id' => $data->id,
                'code' => $data->code,
                'first_name' => $data->first_name,
                'last_name' => $data->last_name,
                'first_name_kh' => $data->first_name_kh,
                'last_name_kh' => $data->last_name_kh,
                'gender' => $data->gender == 'male' ? 'ប្រុស' : 'ស្រី',
                'phone' => $data->phone,
                'email' => $data->email,
                'birth_of_date' => $data->birth_of_date,
                'birth_of_place' => $data->birth_of_place,
                'current_place' => $data->current_place,
                'position' => $data->positions->name,
                'work_place' => $data->workplaces->name,
                'rate_per_hour' => '$'.$data->rate_per_hour,
                'base_salary' => '$'.$data->base_salary,
                'worktime' => $data->worktime->name,
                'start_work' => $data->start_work,
                'stop_work' => $data->stop_work,
                'note' => $data->note
            ];
        });

        $heading = [
            __('app.table_no'),
            __('app.code'),
            __('app.first_name'),
            __('app.last_name'),
            __('app.first_name_kh'),
            __('app.last_name_kh'),
            __('app.gender'),
            __('app.phone'),
            __('app.email'),
            __('app.birth_of_date'),
            __('app.birth_of_place'),
            __('app.current_place'),
            __('app.position'),
            __('app.work_place'),
            __('app.rate_per_hour'),
            __('app.base_salary'),
            __('app.work_time'),
            __('app.start_work'),
            __('app.stop_work'),
            __('app.label_note')
        ];

        return Helpers::exportExcel($staff,$heading,$file_name);
        
        // return Excel::download(new ExportFiles($staff,$heading,$file_name),$file_name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StaffInfo  $staffInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staffInfo = StaffInfo::find($id);
        if($staffInfo->photo) {
            File::delete('photos/'.$staffInfo->photo);
            $staffInfo->delete();

            $attachments = Attachment::where(['type_id'=>$id,'type'=>'staff_info'])->get();
            foreach($attachments as $att){
                File::delete('attachments/'.$att->name);
                $attachments->delete();
            }
            
            return redirect('/staff-info')->with('status', 'Staff Info has been deleted!');
        }
    }

}
