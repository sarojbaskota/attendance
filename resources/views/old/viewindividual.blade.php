@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Attendance Of User In System') }}</div>

                <div class="card-body">

          
					
					 <table class="table" id="table">
					    <thead>
					        <tr>
					        	<th class="text-center" style="border:1px solid gray;">SN</th>
					        	<th class="text-center" style="border:1px solid gray;">Name</th>
					        	<th class="text-center" style="border:1px solid gray;">Day</th>
					            <th class="text-center" style="border:1px solid gray;">Office Check In</th>
					            <th class="text-center" style="border:1px solid gray;">Office Check Out</th>
					            <th class="text-center" style="border:1px solid gray;"> Spend Time</th>
					            
					            <th class="text-center" style="border:1px solid gray;"> Break Hours</th>
					            <th class="text-center" style="border:1px solid gray;"> Working Hours</th>
					            
					        </tr>
					    </thead>
					    <tbody>
					    	<?php
					    	$i=0;
					       	foreach($Records as $row) {

					       		$i++;
 								$name = $row->name;
					       		//emplyoee checkin
					       	 $ckin_time =   $row->office_checkin;
						     $ckout_time =   $row->office_checkout;
					       	

					       	 $date=$row->office_checkin;
						        $datetime = explode(" ",$date);
						        $datetime = explode("-",$datetime[0]);
						        $day = $datetime[2];

						        
// 					       	//employee checkin for break
						     
// 						     $brk_ckin =   $row->bcheckin;
// 						     $brk_ckout =   $row->bcheckout; 

// 						     $brk_type = $row->bcategories;   
						           
// 						     $brk_ckin_time =  explode(" ",$brk_ckin);
// 						     $brk_ckout_time =  explode(" ",$brk_ckout);

// 						     $check_in_time = $brk_ckin_time[1];
// 						    $check_out_time = $brk_ckout_time[1]; 
                                    
// 				                 $a = new DateTime($check_in_time);
// 				$b = new DateTime($check_out_time);
// 				$interval = $a->diff($b);

// 				echo $interval->format("%H");

// 						     list($bhours, $bminutes,$bsecond) = explode(':', $brk_ckin_time[1]);
// 	                         $startTimestamp = mktime($bhours, $bminutes,$bsecond);

	
// 	                     list($bhours, $bminutes,$bsecond) = explode(':', $brk_ckout_time[1]);
// 	                       $endTimestamp = mktime($bhours, $bminutes,$bsecond);
	
//                  $bseconds = abs($startTimestamp - $endTimestamp);
// var_dump($bseconds);
// 	            $bminutes = ($bseconds / 60) % 60;
// 	             $break_hours = round($bseconds / (60 * 60));
	    	    
// 	               $bsum = $bseconds +$bsum;

// 				//for working hours
// 						$ckin_time =  explode(" ",$ckin);
// 						$ckout_time =  explode(" ",$ckout);
// 						//$total = $brk_ckout_time[1]->diff($brk_ckin_time[1]);
// 						// $total = bcsub($brk_ckout_time[1],$brk_ckin_time[1],4); 
// 						list($chours, $cminutes) = explode(':', $ckin_time[1]);
// 						$startTimestamp = mktime($chours, $cminutes);

// 						list($cohours, $cominutes) = explode(':', $ckout_time[1]);
// 						$endTimestamp = mktime($cohours, $cominutes);

// 						$ofseconds = abs($startTimestamp - $endTimestamp);
// 						$ofminutes = ($ofseconds / 60) % 60;
// 						$ofhours = round($ofseconds / (60 * 60));
                        
//                         $osum =   $osum +$ofseconds;
                       
						

// 	               // total working hours
// 						$wseconds = abs($ofseconds - $bseconds);
// 						$wminutes = ($wseconds / 60) % 60;
// 						$whours = round($wseconds / (60 * 60));
// 					// every date wise details 
//                        $raw_date =   explode(" ",$ckin);
//                        list($year, $month, $day) = explode('-', $raw_date[0]);
						
// 					     $day;
  
                    
//                     // total break hour of emplyoee
//                     	$Bminutes = ($bsum / 60) % 60;
// 						$Bhours = round($bsum / (60 * 60));
                      

//                       $workingHours = $osum - $bsum;
//                        $wminutes = ($workingHours / 60) % 60;
// 						$whours = round($workingHours / (60 * 60));
						
// 						// spend time in office 
// 						$spendminutes = ($osum / 60) % 60;
// 						$spendhours = round($osum / (60 * 60));
                    ?>

                        <tr> 
					             <td style="border:1px solid gray;"> <?php echo $i; ?> </td>
					             <td style="border:1px solid gray;"> <?php echo $name;?> </td>
					             <td style="border:1px solid gray;"> <?php echo $day; ?>  </td>
					            <td style="border:1px solid gray;"><?php echo $ckin_time; ?></td>
					            <td style="border:1px solid gray;"><?php echo $ckout_time; ?></td>
					            <td style="border:1px solid gray;"><?php echo 'Spend time'; ?></td>
					            <td style="border:1px solid gray;"><?php echo 'break time'; ?></td>
					            <td style="border:1px solid gray;"><?php echo 'working time'; ?></td>
					           
					            <td> <a href="">Edit</a></td>
					            <td> <a href="">Delete</a></td>

					             
					       </tr> 
					        <?php } ?> 
					    </tbody>
					</table>

					<a href="http://localhost:8000/authentication/create">Add New User</a>
					<br />
					<a href="http://localhost:8000/authentication/view">View All Users </a><br />
					<a href="http://localhost/AttendanceSystem/public/authentication/emplyoee_records">View Individual</a> <br />
					<a href="http://localhost/AttendanceSystem/public/authentication/leaves_of_emp">View Leave Of Employee</a>


				</div>
			</div>
		</div>
	</div>
</div>


@endsection
