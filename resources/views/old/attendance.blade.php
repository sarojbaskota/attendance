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
					        	<th class="text-center" style="border:1px solid gray;">Employee Name</th>
					            <th class="text-center" style="border:1px solid gray;">Check In</th>
					            <th class="text-center" style="border:1px solid gray;">Check Out</th>
					        </tr>
					    </thead>
					    <tbody>
					    	<?php 
					    	$results = DB::select('SELECT * FROM timesheets  INNER JOIN users
     ON users.id = timesheets.employee_id');
					    	$i=0;
					       	foreach($results as $row) {
					       			++$i;
					         
					           ?>
					       <tr> 
					      		 <td style="border:1px solid gray;" > <?php echo $i; ?></td>
					             <td style="border:1px solid gray;" ><?php echo $row->name ?></td>
					            <td style="border:1px solid gray;" ><?php echo $row->office_checkin; ?></td>
					            <td style="border:1px solid gray;" ><?php echo $row->office_checkout ?></td>
					            <td> <a href="">Edit</a></td>
					            <td> <a href="">Delete</a></td>

					             
					       </tr>
					       <?php   } ?>
					         
					    </tbody>
					</table>

					<a href="http://localhost:8000/authentication/create">Add New User</a>
					<br />
					<a href="http://localhost:8000/authentication/view">View All Users </a>


				</div>
			</div>
		</div>
	</div>
</div>


@endsection
