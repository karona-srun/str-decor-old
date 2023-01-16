<?php

namespace App\Http\Controllers;

use App\Models\StaffInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:User List|User Create|User Edit|User Delete', ['only' => ['index','show']]);
        $this->middleware('permission:User Create', ['only' => ['create','store']]);
        $this->middleware('permission:User Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:User Delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('backend.users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staffInfo = StaffInfo::get();
        $roles = Role::get();
        return view('backend.users.create', compact('staffInfo', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        $input['staff_id'] = $request->staff_id;
        $input['created_by'] = Auth::user()->id;
        $input['updated_by'] = Auth::user()->id;
    
        $user = User::create($input);
        $user->assignRole($request->roles);
    
        return redirect()->route('users.index')
                        ->with('success',__('app.user_info').__('app.label_created_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('backend.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staffInfo = StaffInfo::get();
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('backend.users.edit',compact('staffInfo','user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'email' => [
                'required','email',
                Rule::unique('users')->ignore($id),
            ],
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->updated_by = Auth::user()->id;
        $user->staff_id = $request->staff_id;
        $user->save();
        
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success', __('app.user_info').__('app.label_updated_successfully'));
    }

    public function resetPassword($id)
    {
        $user = User::find($id);
        return view('backend.users.resetpassword', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed'
        ],[
            'password.required' => __('app.label_password').__('app.required'),
            'password.confirmed' => __('app.label_password').' និង'.__('app.label_confirm_password').__('app.label_not_match'),
        ]);

        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($request->password);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($request->id);
        $user->password = $input['password'];
        $user->save();

        return redirect()->route('users.index')
                        ->with('success',__('app.label_password').__('app.label_updated_successfully'));
    }

    /**
     * Toggle Block the specified resource from storage.
     *
     * @param  int  $id
     * @param boolean $blocked
     * @return \Illuminate\Http\Response
     */
    public function toggleBlocked($id, $blocked)
    {
        $user = User::find($id);
        $user->blocked = $blocked ? false : true;
        $user->save();

        $label = '';
        if($blocked){
            $label = $user->name.__('app.label_blocked_successfully');
        }else{
            $label = $user->name.__('app.label_unblocked_successfully');
        }
        return redirect()->route('users.index')
                        ->with('danger', $label);
    }

    public function profile($id)
    {
        $user = User::find($id);
        return view('backend.users.profile', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
