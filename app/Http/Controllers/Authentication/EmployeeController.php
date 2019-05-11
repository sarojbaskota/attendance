<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Timesheet;
use App\Breaks;
use App\Leaves;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\View;
use App\leave_user;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = User::where('role',0)->get();
        //$employees = User::with('leaves')->whereId(23)->get();
        return view('authentication.view-employee.index',compact('employees'));
    }

    /**
     * Show the form for information about employee a new resource.
     *
     * @param  \App\request  $request
     * @return \Illuminate\Http\Response
     */
    public function employeeDetails(Request $request, $id)
    {
         // $employee = User::select('full_name','created_at')->where('id',$id)->whereDay('created_at',20)->get();
        // return $employee;
        $employee = User::select('full_name')->where('id',$id)->get();
        $timesheets = Timesheet::select('office_checkin','office_checkout')->where('user_id',$id)->whereYear('office_checkin',$request->year)->whereMonth('office_checkin',$request->month)->get();
        $emp_breaks = Breaks::select('break_checkin','break_checkout')->where('user_id',$id)->whereYear('break_checkin',$request->year)->whereMonth('break_checkin',$request->month)->get();
        $leaves = Leaves::select('leave_reason','leave_response','created_at')->where('user_id',$id)->whereMonth('created_at',$request->month)->get();
        return view('authentication.view-employee.details',compact('timesheets','employee','emp_breaks','leaves'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\request  $request
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
     * @param  \App\request  $request
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
     * @param  \App\request  $request
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
     * @param  \App\request  $request
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
     * @param  \App\request  $request
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
