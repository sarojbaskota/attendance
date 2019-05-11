@extends('layouts.authentication.admin')
@section('page-title')
{{ $employee[0]['full_name']}} Details
@endsection
@section('sub_breadcrumb')
 Employee <b>></b>  Employee Details
@endsection
@section('content')

<div class="box">
    <div class="box-header">
		<h5>Quick Information</h5>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
    	<div class="row">
    		<div class="col-md-3">
				<p>
					<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#timesheet" aria-expanded="false" aria-controls="collapseExample">
						Office Time
					</button>
				</p>
				<div class="collapse" id="timesheet">
					<div class="card card-body">
					 12 days present
					</div>
				</div>
    		</div>
    		<div class="col-md-3">
				<p>
					<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#ebreak" aria-expanded="false" aria-controls="collapseExample">
					Employee Break
					</button>
				</p>
				<div class="collapse" id="ebreak">
					<div class="card card-body">
					employee break
					</div>
				</div>
    		</div>
    		<div class="col-md-3">
				<p>
					<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#working_hour" aria-expanded="false" aria-controls="collapseExample">
					Working Hours
					</button>
				</p>
				<div class="collapse" id="working_hour">
					<div class="card card-body">
					Employee working hours
					</div>
				</div>
    		</div>
    		<div class="col-md-3">
				<p>
					<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#leave" aria-expanded="false" aria-controls="collapseExample">
					Leaves
					</button>
				</p>
				<div class="collapse" id="leave">
					<div class="card card-body">
					Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
					</div>
				</div>
    		</div>
    	</div>
    </div>
 </div>
<!-- details info -->
<div class="box">
    <div class="box-header">
		<h5>Expand Information</h5>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
    	<div class="row">
    		<div class="col-md-4">
				<p>
					<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#attendance" aria-expanded="false" aria-controls="collapseExample">
					Timesheet
					</button>
				</p>
				<div class="collapse" id="attendance">
					<div class="card card-body">
					<table id="example2" class="table table-bordered table-hover">
			                <thead>
			                <tr>
			                  <th>SN</th>
			                  <th>Check In</th>
			                  <th>Check Out</th>
			                </tr>
			                </thead>
			                <tbody>
			                    @foreach($timesheets as $timesheet)
			                <tr>
			                  <td>{{$loop->iteration}}</td>
			                  <td>{{$timesheet->office_checkin}}</td>
			                  <td>{{$timesheet->office_checkout}}</td>
			                </tr>
			                @endforeach
			                </tbody>
             		 </table>
					</div>
				</div>
    		</div>
    		<div class="col-md-4">
				<p>
					<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#break" aria-expanded="false" aria-controls="collapseExample">
					 Break
					</button>
				</p>
				<div class="collapse" id="break">
					<div class="card card-body">
						<table id="example2" class="table table-bordered table-hover">
							<thead>
								<tr>
								<th>SN</th>
								<th>Break Checkin</th>
								<th>Break Checkout</th>
								</tr>
							</thead>
							<tbody>
								@foreach($emp_breaks as $breaks)
								<tr>
								<td>{{$loop->iteration}}</td>
								<td>{{$breaks->break_checkin}}</td>
								<td>{{$breaks->break_checkout}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
    		</div>
    		<div class="col-md-4">
				<p>
					<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#leaves" aria-expanded="false" aria-controls="collapseExample">
					Leaves
					</button>
				</p>
				<div class="collapse" id="leaves">
					<div class="card card-body">
					<table id="example2" class="table table-bordered table-hover">
							<thead>
								<tr>
								<th>SN</th>
								<th>Reason for leave</th>
								<th>Status</th>
								<th>Post on</th>
								</tr>
							</thead>
							<tbody>
								@foreach($leaves as $leave)
								<tr>
								<td>{{$loop->iteration}}</td>
								<td>{{$leave->leave_reason}}</td>
								<td>{{$leave->leave_response}}</td>
								<td>{{$leave->created_at}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
    		</div>
    	</div>
    </div>
 </div>
@endsection
@section('scripts')
@endsection