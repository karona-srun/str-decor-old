<?php

namespace App\Http\Controllers;

use App\Models\Expend;
use App\Models\ExpendOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ExpendController extends Controller
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
        // if ($request->ajax()) {
        //     $expends = Expend::all();
        //     return datatables()->of($expends)
        //         ->addColumn('action', function ($row) {
        //             $html = '<a href="#" class="btn btn-xs btn-secondary btn-edit">Edit</a> ';
        //             $html .= '<button data-rowid="' . $row->id . '" class="btn btn-xs btn-danger btn-delete">Del</button>';
        //             return $html;
        //         })->toJson();
        // }

        // return view('backend.expends.index');

        $expends = Expend::orderBy('id','desc')->get();
        return view('backend.expends.index', compact('expends'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $expend_options = ExpendOptions::orderBy('id','desc')->get();
        return view('backend.expends.create', compact('expend_options'));
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
            'expend_option' =>'required',
            'name' =>'required',
            'date' =>'required',
            'amount' =>'required',
        ],[
            'expend_option.required' => __('app.expend_info').' '.__('app.required'),
            'name.required' => __('app.label_name').' '.__('app.required'),
            'date.required' => __('app.label_payment_date').' '.__('app.required'),
            'amount.required' => __('app.label_amount').' '.__('app.required'),
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $expend = new Expend();
        $expend->expend_option_id = $request->expend_option;
        $expend->name = $request->name;
        $expend->date = $request->date;
        $expend->amount = $request->amount;
        $expend->note = $request->note;
        $expend->created_by = Auth::user()->id;
        $expend->updated_by = Auth::user()->id;
        $expend->save();

        return redirect('/expends')->with('status', 'Expends has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expend  $expend
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expend = Expend::find($id);
        return view('backend.expends.show', compact('expend'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expend  $expend
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expend = Expend::find($id);
        $expend_options = ExpendOptions::orderBy('id','desc')->get();
        return view('backend.expends.edit', compact('expend','expend_options'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expend  $expend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'expend_option' =>'required',
            'name' =>'required',
            'date' =>'required',
            'amount' =>'required',
        ],[
            'expend_option.required' => __('app.expend_info').' '.__('app.required'),
            'name.required' => __('app.label_name').' '.__('app.required'),
            'date.required' => __('app.label_payment_date').' '.__('app.required'),
            'amount.required' => __('app.label_amount').' '.__('app.required'),
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $expend = Expend::find($id);
        $expend->expend_option_id = $request->expend_option;
        $expend->name = $request->name;
        $expend->date = $request->date;
        $expend->amount = $request->amount;
        $expend->note = $request->note;
        $expend->updated_by = Auth::user()->id;
        $expend->save();

        return redirect('/expends')->with('status', 'Expends has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expend  $expend
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expend = Expend::find($id);
        $expend->delete();

        return redirect('/expends')->with('status', 'Expend has been deleted!');
    }
}
