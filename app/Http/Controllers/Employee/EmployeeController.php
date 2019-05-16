<?php

namespace App\Http\Controllers\Employee;
use Illuminate\Http\Request;
use App\Timesheet;
use App\Breaks;
use App\Leaves;
use Carbon\Carbon;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = Timesheet::OfficeCheckout()->UserId()->latest()->first();
        $breaks = Breaks::UserId()->BreakCheckout()->first();
        return view('employee.dashboard',compact('status','breaks'));
    }

    /**
     * creating a new resource for checkin of employee.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkin(Request $request)
    {
         // check data table for sure
         $check = Timesheet::UserId()->first();
         if( $check ){
            if($check->office_checkout == NULL){
                return response()->json(['status' => 'You Already Checkedin!!',]);
            }
         }
         // set checkin and checkout record
         Timesheet::create(['user_id' => Auth::user()->id,'office_checkin' => Carbon::now()->toDateTimeString()]);
         return response()->json(['status' => 'Checkedin!!',]);

    }
    public function checkout(Request $request)
    {
         // check data table for sure
         $check = Timesheet::UserId()->latest()->first();
         if( $check ){
            if($check->office_checkout == NULL){
                // set checkout record
                Timesheet::UserId()->update(['office_checkout' => Carbon::now()->toDateTimeString()]);
                return response()->json(['status' => 'Checkedout!!',]);
            }
         }
         return response()->json(['status' => 'Checkin Frist!!',]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        $attendances = Timesheet::UserId()->latest()->paginate(7);
        return view('employee.attendance_history',compact('attendances'));
    }
}
