@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('All User In System') }}</div>

                <div class="card-body">
					 
					          <table class="table" id="table">
					          	
					    <thead>
					        <tr>
					        	<th class="text-center" style="border:1px solid gray;">SN</th>
					            <th class="text-center" style="border:1px solid gray;">Name</th>
					            <th class="text-center" style="border:1px solid gray;">Role</th>
					            <th class="text-center" style="border:1px solid gray;">E-mail</th>
					        </tr>
					    </thead>
					    <tbody>
					    	<?php 
					    	$results = DB::select('SELECT name,email,role,id FROM users');
					    	$i=0;
					       	foreach($results as $row) {
					         ++$i;
					       $role =  $row->role;
					       if($role == 1){
                                   $users = 'Admin';  
					       }else{
					       	$users = 'Employee';
					       }

					          ?>
					          <tr>
					       <td style="border:1px solid gray;" ><?php echo $i; ?></td> 
					       <td style="border:1px solid gray;" ><?php echo $row->name ; ?></td>
					              <td style="border:1px solid gray;" ><?php echo $users; ?> </td>
					            <td style="border:1px solid gray;" ><?php echo $row->email; ?></td>
					            <td> 
					            	<a href="{{ url('authentication/edit') }}">Edit</a></td>
					            <td> <a href="http://localhost:8000/authentication/edit">Delete</a></td>
					       </tr>
					            <?php   } ?>
					        
					    </tbody>
					</table>

					<a href="{{URL::asset('dashboard/view')}}" class="w3-bar-item w3-button"><b>View All Users</b></a>
                      <a href="{{URL::asset('dashboard/attendance')}}" class="w3-bar-item w3-button"><b>View Timesheet</b></a>
                      <a href="{{URL::asset('dashboard/leaves_of_emp')}}" class="w3-bar-item w3-button"> <b>View Leave Of Employee</b></a>
                      <a href="{{URL::asset('dashboard/emplyoee_records')}}" class="w3-bar-item w3-button"><b>View Individual Record Of Employee</b></a>
				</div>
			</div>
		</div>
	</div>
</div>


 

@endsection