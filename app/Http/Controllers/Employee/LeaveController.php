<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Leaves;
use App\Timesheet;
use App\Http\Controllers\Controller;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee.leave');
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
        $validator = \Validator::make($request->all(), [
            'leave_reason' => 'required',
            'user_id' => 'required'
        ]);
        if ($validator->fails()) { 
            return response()->json(['errors' => $validator->errors()->all()]);
         }
        Leaves::create($request->all());
        return response()->json(['status' => 'Your Request Successfully Sent!!',]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        $leaves = Leaves::UserId()->latest()->paginate(7);
        return view('employee.leave_history',compact('leaves'));
    }
    /**
     * Show the form for information about employee attendance.
     *
     * @param  \App\request  $request
     * @return \Illuminate\Http\Response
     */
    public function adminHistory(Request $request, $id)
    {
        $leaves = Leaves::where('user_id',$id)->latest()->paginate(7);
        return view('authentication.leave_history',compact('leaves'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
