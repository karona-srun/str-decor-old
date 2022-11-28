<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PositionController extends Controller
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
        $positions = Position::orderBy('id','desc')->get();
        return view('backend.positions.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.positions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $position = new Position();
        $position->name = $request->name;
        $position->note = $request->note;
        $position->created_by = Auth::user()->id; 
        $position->updated_by = Auth::user()->id; 
        $position->save();

        return redirect('/positions')->with('status', 'Position has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $position = Position::find($id);
        $position->created_by = $position->creator->name;
        $position->updated_by = $position->updator->name;
        $position->created_at = $position->created_at->format('d-m-Y h:i:s A');
        $position->updated_at = $position->updated_at->format('d-m-Y h:i:s A');
        return response()->json($position);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $position = Position::find($id);
        $position->created_by = $position->creator->name;
        $position->updated_by = $position->updator->name;
        $position->createdat = $position->created_at->format('d-m-Y h:i:s A');
        $position->updatedat = $position->updated_at->format('d-m-Y h:i:s A');
        return response()->json($position);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function updatePosition(Request $request)
    {
        $position = Position::find($request->id);
        $position->name = $request->name;
        $position->note = $request->note;
        $position->updated_by = Auth::user()->id; 
        $position->save();

        return redirect('positions')->with('status', 'Position has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $position = Position::find($id);
        $position->delete();

        return redirect('/positions')->with('status', 'Position has been deleted!');
    }
}
