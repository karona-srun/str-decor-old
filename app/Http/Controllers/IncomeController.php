<?php

namespace App\Http\Controllers;

use App\Exports\ExportFiles;
use App\Helpers\Helpers;
use App\Models\Income;
use App\Models\IncomeOptions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class IncomeController extends Controller
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
        $income_options = IncomeOptions::orderBy('name','desc')->get();
        
        $query = Income::query();

        if ($request->income_option) {
            $query->where('income_option_id', $request->income_option);
        }

        if ($request->start_date || $request->end_date) {
            $query->whereBetween('date', array($request->start_date,$request->end_date));
        }else{
            $query->whereBetween('date', array(Carbon::now()->firstOfMonth()->toDateString(),Carbon::now()->lastOfMonth()->toDateString()));
        }

        $incomes = $query->get();

        if($request->export == "enabled"){
            return $this->processExcel($incomes);
        }

        return view('backend.incomes.index', compact('income_options','incomes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $income_options = IncomeOptions::orderBy('id','desc')->get();
        return view('backend.incomes.create', compact('income_options'));
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
            'income_option' =>'required',
            'name' =>'required',
            'date' =>'required',
            'photo' =>'required',
            'amount' =>'required',
        ],[
            
            'income_option.required' => __('app.income_info').__('app.required'),
            'name.required' => __('app.label_name').__('app.required'),
            'date.required' => __('app.label_payment_date').__('app.required'),
            'photo.required' => __('app.table_photo').__('app.required'),
            'amount.required' => __('app.label_amount').__('app.required'),
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $imageName = '';
        if ($request->hasFile('photo')) {
            $imageName = 'income_' . time() . rand(1, 99999) . '.' . $request->photo->getClientOriginalExtension();
            $imageName = str_replace(' ', '_', $imageName);
            $request->photo->move(public_path('incomes'), $imageName);
        }

        $income = new Income();
        $income->income_option_id = $request->income_option;
        $income->name = $request->name;
        $income->date = $request->date;
        $income->amount = $request->amount;
        $income->note = $request->note;
        $income->photo = $imageName;
        $income->created_by = Auth::user()->id;
        $income->updated_by = Auth::user()->id;
        $income->save();

        return redirect('/revenue?start_date='.Carbon::now()->firstOfMonth()->toDateString().'&end_date='.Carbon::now()->lastOfMonth()->toDateString())->with('success', __('app.income_info') . __('app.label_created_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $income = Income::find($id);
        return view('backend.incomes.show', compact('income'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $income = Income::find($id);
        $income_options = IncomeOptions::orderBy('id','desc')->get();
        return view('backend.incomes.edit', compact('income','income_options'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'income_option' =>'required',
            'name' =>'required',
            'date' =>'required',
            'amount' =>'required',
        ],[
            
            'income_option.required' => __('app.income_info').__('app.required'),
            'name.required' => __('app.label_name').__('app.required'),
            'date.required' => __('app.label_payment_date').__('app.required'),
            'amount.required' => __('app.label_amount').__('app.required'),
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $income = Income::find($id);

        $imageName = '';
        if ($request->hasFile('photo')) {
            File::delete('incomes/' . $income->photo);
            $imageName = 'income_' . time() . rand(1, 99999) . '.' . $request->photo->getClientOriginalExtension();
            $imageName = str_replace(' ', '_', $imageName);
            $request->photo->move(public_path('incomes'), $imageName);
            $income->photo = $imageName;
        }

        $income->income_option_id = $request->income_option;
        $income->name = $request->name;
        $income->date = $request->date;
        $income->amount = $request->amount;
        $income->note = $request->note;
        $income->photo = $imageName;
        $income->updated_by = Auth::user()->id;
        $income->save();


        return redirect('/revenue?start_date='.Carbon::now()->firstOfMonth()->toDateString().'&end_date='.Carbon::now()->lastOfMonth()->toDateString())->with('success', __('app.income_info') . __('app.label_updated_successfully'));
    }

    public function processExcel($datas)
    {
        $file_name = 'Incomes_'.date('j_m_Y_H_i_s').'.xlsx';

        // $datas = Income::all();

        // $incomes = $datas->map(function ($data) {
        //     return [
        //         'id' => $data->id,
        //         'type_income' => $data->incomeOptions->name,
        //         'name' => $data->name,
        //         'amount' => '$'.$data->amount,
        //         'date' => $data->date,
        //         'note' => $data->note
        //     ];
        // });

        $heading = [
            __('app.table_no'),
            __('app.label_type_income'),
            __('app.label_name'),
            __('app.label_amount'),
            __('app.table_date'),
            __('app.label_note')
        ];
        // return Helpers::exportExcel($datas,$heading,$file_name);

        $option = 'income';
        
        return Excel::download(new ExportFiles($option,$datas,$heading,$file_name),$file_name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $income = Income::find($id);
        $income->delete();

        return redirect('/revenue?start_date='.Carbon::now()->firstOfMonth()->toDateString().'&end_date='.Carbon::now()->lastOfMonth()->toDateString())->with('success', __('app.income_info') . __('app.label_deleted_successfully'));
    }
}
