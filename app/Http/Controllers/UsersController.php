<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Timesheet;
use App\Breaks;
use App\Leaves;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\View;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\lain  $lain
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();

        return view('authentication.users.index',compact('users'));
    }
    /**
     * Display a listing of the admin of this system.
     *
     * @param  \App\lain  $lain
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        $users = User::where('role',1)->get();

        return view('authentication.users.admin',compact('users'));
    }
    /**
     * Display a listing of the admin of this system.
     *
     * @param  \App\lain  $lain
     * @return \Illuminate\Http\Response
     */
    public function employee()
    {
        $users = User::where('role',0)->get();
        return view('authentication.users.admin',compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\lain  $lain
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('authentication.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\lain  $lain
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    { 
        $validator = \Validator::make($request->all(), [
            'full_name' => 'required|max:50',
            'username' => 'required|max:50',
            'role' => 'required',
            'status' => '',
            'email' => 'required|email|unique:users',
            'password'=>'required|same:password_confirmation',
            'password_confirmation' => 'required|same:password',
        ]);
        if ($validator->fails()) { 
            return response()->json(['errors' => $validator->errors()]);
         }
        if( $request->hasFile('profile_avatar'))
        {
            $validator = \Validator::make($request->all(), [
                'profile_avatar' =>'required|mimes:jpeg,jpg,png|max:2048',
                ]);
            if ($validator->fails()) { 
                return response()->json(['errors' => $validator->errors()]);
                }
            $image_name = fileUpload('images/avatar', $request->file('profile_avatar'));
            User::create($request->except('profile_avatar')+['avatar' => $image_name]);
            return response()->json(['status' => 'User created sucessfully!!',]); 
        }
        User::create($request->all());
        return response()->json(['status' => 'User created sucessfully!!',]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\lain  $lain
     * @param  \DummyFullModelClass  $DummyModelVariable
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrfail($id);
        return view('authentication.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\lain  $lain
     * @param  \DummyFullModelClass 
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
         return response()->json($user);
        // return view('authentication.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\lain  $lain
     * @param  \DummyFullModelClass  $DummyModelVariable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'full_name' => 'required|max:50',
            'username' => 'required|max:50',
            'role' => 'required',
            'status' => '',
            'email' => 'required|unique:users,email,'.$id,
            // 'password'=>'required|same:password_confirmation',
            // 'password_confirmation' => 'required|same:password',
        ]);
        if ($validator->fails()) { 
            return response()->json(['errors' => $validator->errors()]);
         }

         $user = User::findOrFail($id);

         if($request->file('profile_avatar')){
            $validator = \Validator::make($request->all(), [
                'profile_avatar' =>'mimes:jpeg,jpg,png|max:2048',]);
            if ($validator->fails()) { 
                return response()->json(['errors' => $validator->errors()]);
                }

             if(is_file(asset('image/avatar/'.$user->avatar))&& $user->avatar){
                removeImage('images/avatar/', $user->avatar);
             }
            $image_name = fileUpload('images/avatar', $request->file('profile_avatar'));
            $user ->update($request->except('profile_avatar')+['avatar' => $image_name]);
            return response()->json([ 'status' => 'User Updated successfully !!']); 
        }
            User::findOrFail($id)
            ->update($request->all());
            return response()->json([ 'status' => 'User Updated successfully !!']); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\lain  $lain
     * @param  \DummyFullModelClass  $DummyModelVariable
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if(is_file(asset('image/avatar/'.$user->avatar)) && $user->avatar){
            removeImage('images/avatar/', $user->avatar);
         }
        $user->delete(); 
        return response()->json([ 'status' => 'User Deleted successfully !!']);  
    }
     /**
     * change status of user active or deactive the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ChangeStatus($id)
    { 
        
        $user = User::findOrFail($id);
        if($user->status == 1)
        {
           User::where('id',$id) ->update([
                     'status'=>0,
                ]);
            return response()->json(['success' => 'User Deactived successfully !!']);  
        } 
        else{
            User::where('id',$id) ->update([
                 'status'=>1,
            ]);
             return response()->json(['success' => 'User Actived successfully !!',]);  
        }
        
    }
}
