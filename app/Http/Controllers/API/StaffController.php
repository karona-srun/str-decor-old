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
  
        $staff = StaffInfo::orderBy('first_name')
                  ->select('id', 'last_name', 'first_name', 'last_name_kh', 'first_name_kh')
                  ->when($search, function ($query) use ($search) {
                      return $query->where('full_name_kh', 'like', '%' . $search . '%');
                  })
                  ->take(5)
                  ->get();
                  
        $response = $staff->map(function ($st) {
            return [
               'id' => $st->id,
               'text' => $st->full_name_kh,
            ];
         });

        return response()->json($response);
    }

}
