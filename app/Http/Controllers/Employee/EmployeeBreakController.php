<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Breaks;
use App\User;
use Carbon\Carbon;
class EmployeeBreakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Store a newly created resource in storage. when employee enter new entry
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function breakCheckout(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'break_type' => 'required|not_in:0',
            'user_id' => 'required'
        ]);
        
        if ($validator->fails()) { 
            return response()->json(['errors' => $validator->errors()->all(),]);
         }
        $result = Breaks::UserId()->first();
        if($result){
            if($result->break_checkin == NULL){
                // employee not came in office yet
                return response()->json(['status' => 'You Already Checkedout Break!!',]);
            }
        }
        Breaks::create([
            'user_id' => $request->user_id,
            'break_checkout' => Carbon::now()->toDateTimeString(),
            'break_type' => $request->break_type,
            'break_reason' > $request->break_reason, 
        ]);
        return response()->json(['status' => 'You Already Checkedout Break!!',]);
    }
     /**
     * Display the specified resource.
     *
     * @param  update value i check out of employee break
     * @return \Illuminate\Http\Response
     */
    public function breakCheckin(Request $request)
    { 
        $result = Breaks::UserId()->latest()->first();
        if($result){
            if($result->break_checkin == NULL){
                Breaks::UserId()->latest()->take(1)->update(['break_checkin'=>Carbon::now()->toDateTimeString()]);
                return response()->json(['status' => 'You Checkedin Break!!',]);
            }
        }
        // employee not came in office yet
        return response()->json(['status' => 'Checkedout Break First!!',]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        $breaks = Breaks::UserId()->latest()->paginate(7);
        return view('employee.breaks_history',compact('breaks'));
    }
     /**
     * Show the form for information about employee attendance.
     *
     * @param  \App\request  $request
     * @return \Illuminate\Http\Response
     */
    public function adminHistory(Request $request, $id)
    {
        $breaks = Breaks::where('user_id',$id)->latest()->paginate(7);
        return view('authentication.breaks_history',compact('breaks'));
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
