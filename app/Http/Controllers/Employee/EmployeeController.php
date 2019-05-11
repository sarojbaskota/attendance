<?php

namespace App\Http\Controllers\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Timesheet;
use App\Breaks;
use App\Leaves;
use Carbon\Carbon;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // to  disabled  checkin button
        $results = Timesheet::select('office_checkout')-> where('employee_id',Auth::user()->id);
        $off_chk_data='nothing_select';
        foreach($results as $row){
            $off_chk_data = $row->office_checkout;
        }
        if($off_chk_data==NULL){
            $disabled = true;
            return view('employee.dashboard',compact('disabled'));
        }
            elseif($off_chk_data == "nothing_select"){
            $disabled = false;
            return view('employee.dashboard',compact('disabled'));
        }
            else{
            $disabled = false;
            return view('employee.dashboard',compact('disabled'));
        }
    }
    public function EmployeeCheckinStore(Request $request)
    {
        // to sure double checkin condition
        $disabled = false;
        $eid= auth()->user()->id;
        //print_r($eid);
        $results = DB::select("SELECT `office_checkout` FROM `timesheets` where `employee_id` = $eid");
        $off_chk_data='nothing_select';
        foreach($results as $row){
        $off_chk_data = $row->office_checkout;
        }
        if($off_chk_data==NULL){ 
            $disabled = false;
        return view('employee.dashboard',compact('disabled'))->with('message_error', 'You Already Checked In!');
        }
        elseif($off_chk_data=='nothing_select')
        {
        $disabled = false;
        $timesheet = new Timesheet;
        $timesheet->employee_id = auth()->user()->id;
        $timesheet ->office_checkin = Carbon::now()->toDateTimeString();
        $timesheet->save();
        return view('employee.dashboard',compact('disabled'))->with('sucess','You Are Checked In');
        }
        else
        {
        $disabled = false;
        $timesheet = new Timesheet;
        $timesheet->employee_id = auth()->user()->id;
        $timesheet ->office_checkin = Carbon::now()->toDateTimeString();
        $timesheet->save();
        return view('employee.dashboard', compact('disabled'))->with('sucess','You Are Checked In');
        }

    }
    public function EmployeeOfficeCheckout(Request $request) {

        $disabled = false;
        // offcie check check null or not
        $eid = auth()->user()->id;
        $date = Carbon::now()->toDateTimeString();
        $currentdate = explode(" ",$date);
        $checkouts = DB::table('timesheets')->where('employee_id',$eid) ->whereNotNull('office_checkout')->get();
        // declear officecheckoutdate date = nothing_select for clear about checkout if noting select from databse then  ser default value this one
        $officecheckoutdate =  'nothing_select';
        foreach ($checkouts as $checkout ){
        $echeckout =  $checkout->office_checkout;
        $officecheckoutdate = explode(" ",$echeckout);
        }
        if($currentdate[0] === $officecheckoutdate[0]){
            $disabled = false;
            return view('employee.dashboard',compact('disabled'))->with('message_error','Checkin First !');
        }elseif($officecheckoutdate == 'nothing_select'){
            $disabled = false;
        $eid = auth()->user()->id;
        DB::table('timesheets')->where('employee_id',$eid)
        ->where('office_checkout', NULL)
        ->update(['office_checkout'=>Carbon::now()->toDateTimeString()]);
        return view('employee.dashboard',compact('disabled'))->with('sucess','You Are Checked Out');
        }else{
            $disabled = false;
        $eid = auth()->user()->id;
        DB::table('timesheets')->where('employee_id',$eid)
        ->where('office_checkout', NULL)
        ->update(['office_checkout'=>Carbon::now()->toDateTimeString()]);
        return view('employee.dashboard',compact('disabled'))->with('sucess','You Are Checked Out');
        }

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
