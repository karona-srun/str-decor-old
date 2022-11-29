<?php

namespace App\Http\Controllers;

use App\Models\BaseSalary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseSalaryController extends Controller
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
        $basesalary = BaseSalary::orderBy('id','desc')->get();
        return view('backend.basesalary.index', compact('basesalary'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.basesalary.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $baseSalary = new BaseSalary();
        $baseSalary->name = $request->name;
        $baseSalary->amount = $request->amount;
        $baseSalary->note = $request->note;
        $baseSalary->created_by = Auth::user()->id; 
        $baseSalary->updated_by = Auth::user()->id; 
        $baseSalary->save();

        return redirect('/base-salary')->with('status', 'Base Salary has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BaseSalary  $baseSalary
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $baseSalary = BaseSalary::find($id);
        $baseSalary->created_by = $baseSalary->creator->name;
        $baseSalary->updated_by = $baseSalary->updator->name;
        $baseSalary->createdat = $baseSalary->created_at->format('d-m-Y h:i:s A');
        $baseSalary->updatedat = $baseSalary->updated_at->format('d-m-Y h:i:s A');
        return response()->json($baseSalary);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BaseSalary  $baseSalary
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
     * @param  \App\Models\BaseSalary  $baseSalary
     * @return \Illuminate\Http\Response
     */
    public function updateBaseSalary(Request $request)
    {
        $baseSalary = BaseSalary::find($request->id);
        $baseSalary->name = $request->name;
        $baseSalary->amount = $request->amount;
        $baseSalary->note = $request->note;
        $baseSalary->updated_by = Auth::user()->id; 
        $baseSalary->save();

        return redirect('/base-salary')->with('status', 'Base Salary has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BaseSalary  $baseSalary
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $baseSalary = BaseSalary::find($id); 
        $baseSalary->delete();

        return redirect('/base-salary')->with('status', 'Base Salary has been daleted!');
    }
}
