<?php

namespace App\Http\Controllers\Employee;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Breaks;
use Carbon\Carbon;
use Auth;
use Redirect;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function EmployeeBreakCheckin(Request $request)
    {
        $results = Breaks::select('break_checkout')->where('employee_id',Auth::user()->id)->get();
        foreach ($results as  $value) {
           $results = $value->break_checkout;
        }
        if($results==NULL){
        $disabled = true;    
        return view('employee.dashboard',compact('disabled'))->with('break_message_error', 'You checkout first !!');
        }
        else {
            Breaks::create($request->all());
             $disabled = true;   
        return view('employee.dashboard',compact('disabled'))->with('break_checkin_message', 'You checked In');
        }
        
   }
     /**
     * Display the specified resource.
     *
     * @param  update value i check out of employee break
     * @return \Illuminate\Http\Response
     */
    public function EmployeeBreakCheckout(Request $request)
    { 
         $results = Breaks::select('break_checkout')->where('employee_id',Auth::user()->id)->get();
            foreach ($results as  $value) {
                $results = $value->break_checkout;
            }
            if($results ==NULL){
                $disabled = false;
                  Breaks::where('employee_id',Auth::user()->id)->update(['break_checkout'=>Carbon::now()->toDateTimeString()]);
            return view('employee.dashboard',compact('disabled'))->with('break_checkin_message','You Are Checked Out Break!');
        }
        else {
            $disabled = false;
             return view('employee.dashboard',compact('disabled'))->with('break_message_error','Ckeckin Frist !!');
        }
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
