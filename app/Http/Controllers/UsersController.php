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
        $this->validate($request, [
            'profile_avatar' =>'required|mimes:jpeg,jpg,png|max:2048',
            'full_name' => 'required|max:50',
            'username' => 'required|max:50',
            'role' => '',
            'status' => '',
            'email' => 'required|email|unique:users',
            'password'=>'required',
            'password_confirmation' => 'required',
        ]);
        if( $request->password === $request->password_confirmation)
        {
            $image_name = fileUpload('backend/images/avatar', $request->file('profile_avatar'));
            User::create($request->except('profile_avatar')+['avatar' => $image_name]);
            $message = [
                'success' => 'User created successfully !!',
                ]; 
             return response()->json($message);  
        }
        else
        {
            $message = [
                'success' => 'Password not matched !!',
                ]; 
                return response()->json($message); 
        }
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
         if($request->file('profile_avatar')){
            $validateData = $request->validate([
                'profile_avatar' =>'mimes:jpeg,jpg,png|max:2048',
                'full_name' => 'required|max:50',
                'username' => 'required|max:50',
                'role' => '',
                'status' => '',
                'email' => 'required|unique:users,email,'.$id,
            ]);
              $image_name = fileUpload('backend/images/avatar', $request->file('profile_avatar'));
                User::where('id',$id)
                ->update($request->except('profile_avatar','password_confirmation')+['avatar' => $image_name]);
                $message = [
                    'success' => 'User Updated successfully !!',
                ]; 
                return response()->json($message); 
            }else{
                $validateData = $request->validate([
                'full_name' => 'required|max:50',
                'username' => 'required|max:50',
                'role' => '',
                'status' => '',
                'email' => 'required|unique:users,email,'.$id,
            ]);
            User::where('id',$id)
                ->update($request->except('password_confirmation','profile_avatar'));
                $message = [
                'success' => 'User Updated successfully imagenot !!',
            ]; 
             return response()->json($message); 
            }
            
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
        return ('hello');
        User::findOrfail($id)->delete();
        $message = [
            'success' => 'User Deleted successfully !!',
            ]; 
        return response()->json($message);  
    }
     /**
     * change status of user active or deactive the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ChangeStatus($id)
    { 
        
        $user = User::select('status')->where('id', $id)->first();
        if($user->status == 1)
        {
           User::where('id',$id) ->update([
                     'status'=>0,
                ]);
            $message = [
            'success' => 'User Deactived successfully !!',
            ]; 
            return response()->json($message);  
        } 
        else{
            User::where('id',$id) ->update([
                 'status'=>1,
            ]);
           $message = [
                'success' => 'User Actived successfully !!',
                ]; 
             return response()->json($message);  
        }
        
    }
}
