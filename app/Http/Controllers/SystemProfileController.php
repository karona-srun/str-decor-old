<?php

namespace App\Http\Controllers;

use App\Models\SystemProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SystemProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = SystemProfile::first();
        return view('backend.system_profile.show', compact('profile'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SystemProfile  $systemProfile
     * @return \Illuminate\Http\Response
     */
    public function show(SystemProfile $systemProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SystemProfile  $systemProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(SystemProfile $systemProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SystemProfile  $systemProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $profile = SystemProfile::find($id);
        if($request->hasFile('photo')){
            File::delete($profile->photo);
            $imageName = time().rand(1,99999).'.'.$request->photo->getClientOriginalExtension();
            $imageName = str_replace(' ','_',$imageName);
            $request->photo->move(public_path(), $imageName);
            $profile->photo = $imageName;
        }
        $profile->name = $request->name;
        $profile->email = $request->email;
        $profile->tel = $request->tel;
        $profile->address = $request->address;
        $profile->descrip_contract = $request->descrip_contract;
        $profile->save();

        return redirect()->route('system-profile.index')->with('success', __('app.settings').__('app.label_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SystemProfile  $systemProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(SystemProfile $systemProfile)
    {
        //
    }
}
