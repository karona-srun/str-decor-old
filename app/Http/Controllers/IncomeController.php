<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\IncomeOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

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
    public function index()
    {
        $incomes = Income::orderBy('id','desc')->get();
        return view('backend.incomes.index', compact('incomes'));
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
            'amount' =>'required',
        ],[
            
            'income_option.required' => __('app.income_info').' '.__('app.required'),
            'name.required' => __('app.label_name').' '.__('app.required'),
            'date.required' => __('app.label_payment_date').' '.__('app.required'),
            'amount.required' => __('app.label_amount').' '.__('app.required'),
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $income = new Income();
        $income->income_option_id = $request->income_option;
        $income->name = $request->name;
        $income->date = $request->date;
        $income->amount = $request->amount;
        $income->note = $request->note;
        $income->created_by = Auth::user()->id;
        $income->updated_by = Auth::user()->id;
        $income->save();


        return redirect('/incomes')->with('status', 'Income has been created!');
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
            
            'income_option.required' => __('app.income_info').' '.__('app.required'),
            'name.required' => __('app.label_name').' '.__('app.required'),
            'date.required' => __('app.label_payment_date').' '.__('app.required'),
            'amount.required' => __('app.label_amount').' '.__('app.required'),
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $income = Income::find($id);
        $income->income_option_id = $request->income_option;
        $income->name = $request->name;
        $income->date = $request->date;
        $income->amount = $request->amount;
        $income->note = $request->note;
        $income->updated_by = Auth::user()->id;
        $income->save();


        return redirect('/incomes')->with('status', 'Income has been updated!');
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

        return redirect('/incomes')->with('status', 'Income has been deleted!');
    }
}
