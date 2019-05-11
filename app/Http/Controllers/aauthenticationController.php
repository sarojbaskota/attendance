<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class authenticationController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()

{

    return view('/dashboard');
}

/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
    return view('create');
}

/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{
    $users = new User;
    $users->name =  $request->name;
    $users->role = $request->role;
    $users->email =$request->email;
    $users->password = Hash::make($request->password);
    $users->save();
    return view('view');
}

/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function show()
{
    return view('view');
}

public function attendance(){
    return view('attendance');
}

/**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/

public function viewbreaks(){
    return view('viewbreaks');
}

/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function viewrecord(Request $request)
{
    $id_employee = $request->employee;
    $year = $request->year;
    $month =$request->month;

    $timesheets = DB::select("SELECT timesheets.office_checkin FROM timesheets WHERE timesheets.employee_id = $id_employee AND YEAR(office_checkin) = $year AND MONTH(office_checkin) = $month");

    foreach($timesheets as $timesheet){
        $date=$timesheet->office_checkin;
        $datetime = explode(" ",$date);
        $datetime = explode("-",$datetime[0]);
        $day = $datetime[2];                    

        $Records    = DB::select("SELECT users.name,timesheets.office_checkin,timesheets.office_checkout FROM timesheets 
            LEFT JOIN users on users.id = timesheets.employee_id                
            WHERE timesheets.employee_id = $id_employee
            and YEAR(timesheets.office_checkin) = $year 
            and MONTH(timesheets.office_checkin) = $month
            AND DAY(timesheets.office_checkin) = $day");
    }

    $breaks   = DB::select(" SELECT TIMEDIFF(breaks.break_checkout , breaks.break_checkin) AS break_time FROM breaks               
        WHERE breaks.employee_id = 1
        and YEAR(breaks.break_checkin) = 2018 
        and MONTH(breaks.break_checkin) = 12
        AND DAY(breaks.break_checkin) = 13");

    $sum = 0;
    foreach($breaks as $break){
        $break =  (array)$break;
        $sum +=(int)$break['break_time'];
    }


//             SELECT users.name,timesheets.office_checkin,timesheets.office_checkout,breaks.break_checkin,breaks.break_checkout FROM breaks 
// LEFT JOIN timesheets on timesheets.employee_id = breaks.employee_id
// LEFT JOIN users on users.id = timesheets.employee_id                
// WHERE breaks.employee_id = 1
// and YEAR(breaks.break_checkin) = 2018 
// and MONTH(breaks.break_checkin) = 12
// AND DAY(breaks.break_checkin) = 13
// and YEAR(timesheets.office_checkin) = 2018 
// and MONTH(timesheets.office_checkin) = 12
// AND DAY(timesheets.office_checkin) = 13



//     $user_checkin_in_db = DB::select("SELECT checkin FROM employee where eid = (select id from users where name = '$ename')");
//              foreach($user_checkin_in_db as $array){

//       $Records = DB::select("SELECT checkin,checkout,bcheckin,bcheckout,bcategories,name FROM employee  
//  INNER JOIN users
//    ON users.id = employee.eid

//        where  employee.eid = (select id from users where name = '$ename') and  ((SELECT YEAR('$array->checkin')) = $year) and ((SELECT MONTH('$array->checkin')) = $month)") ;

// } 


// dd($checkin);
// return $Records;
//return view('/view')->with('emplyoee_records', $checkin);

    return view('viewindividual', compact('Records','breaks','sum'));
}

/**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/

public function viewrecord_page(){

    $employees = DB::select('SELECT id,name FROM users');

    return view('/emplyoee_records' , compact('employees'));
}

/**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/

public function leaveOfemployee()
{

// $user_leave = DB::select("SELECT eid,reason,checkout,response FROM leaves");
// return $user_leave;
    $user_leave =DB::select("SELECT leaves_request.id,leaves_request.employee_id,leaves_request.leave_reason,leaves_request.created_at,leaves_request.status,leaves_request.leave_response,users.name FROM leaves_request INNER JOIN users ON leaves_request.employee_id = users.id");
// return $user_leave;       
    return view('leaves_of_emp')->with ('user_leave',$user_leave);
}

/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/


public function edit()
{
    return view('/edit');
}

/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function update(Request $request)
{



    $newname = $request->name;
    $id = 3;
    DB::table('users')->where('id',$id)->update(['name'=> $newname]);

    return redirect('/dashboard/view');
}

/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function response_of_leaves_Approved(Request $request)
{

    $employeeID = $request->leave_id;

    DB::table('leaves_request')->where('id',$employeeID)->update(['status'=> 'Approved','leave_response'=>'Approved']);

    return redirect('/dashboard/leaves_of_emp');
}


/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function response_of_leaves_Reject(Request $request)
{

    $employeeID = $request->leave_id;

    DB::table('leaves_request')->where('id',$employeeID)->update(['status'=> 'Reject','leave_response'=>'Reject']);

    return redirect('/dashboard/leaves_of_emp');
}


public function destroy($id)
{


    return redirect('/dashboard/view');
}
}
