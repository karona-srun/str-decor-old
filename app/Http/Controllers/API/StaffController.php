<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ListStaffResource;
use App\Models\StaffInfo;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listStaff(Request $request){

        $search = $request->search;
  
        if($search == ''){
           $staff = StaffInfo::orderby('first_name','asc')->select('id','last_name','first_name','last_name_kh','first_name_kh')->limit(5)->get();
        }else{
           $staff = StaffInfo::orderby('first_name','asc')->select('id','last_name','first_name','last_name_kh','first_name_kh')->where('first_name', 'like', '%' .$search . '%')->limit(5)->get();
        }
  
        $response = array();
        foreach($staff as $st){
           $response[] = array(
                "id"=>$st->id,
                "text"=>$st->full_name_kh
           );
        }
        return response()->json($response);
    }

}
