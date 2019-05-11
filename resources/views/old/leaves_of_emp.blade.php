@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Leaves  Of User In Company') }}</div>

                <div class="card-body">
					 <table class="table" id="table">
					    <thead>
					        <tr>
					        	<th class="text-center" style="border:1px solid gray;">Employee Name</th>
					            <th class="text-center" style="border:1px solid gray;">Reason For Leave</th>
					            <th class="text-center" style="border:1px solid gray;">Post Date</th>
					            <th class="text-center" style="border:1px solid gray;">Status Of Leave</th>
					           
					            
					        </tr>
					    </thead>
					    <tbody>
					    	<?php 
					       foreach($user_leave as $array){
                     	
					       	$leave_req_checkout =  $array->created_at;
                           $date = explode(" ",$leave_req_checkout);

                        $full_reason_leave_req = $array->leave_reason;
					    $few_reason_leave_req = substr($full_reason_leave_req,0,40);
                        ?>
                        <tr> 
					             <td style="border:1px solid gray;" > <?php echo  $array->name; ?></td>
					            <td style="border:1px solid gray;" ><?php echo $few_reason_leave_req.'....'; ?></td>
					            <td style="border:1px solid gray;" ><?php echo $date[0]; ?></td>
					            <td style="border:1px solid gray;" ><?php echo $array->status; ?></td>
					            <td>
                        <a href="{{ url('dashboard/leaves_of_emp_approve/'.$array->id) }}" class="btn btn-info btn-lg" style="padding: 0px;background-color: #3490dc;"><i class="fa fa-check-circle"></i>Apporved</a>
                       <!--  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal_accept" style="padding: 0px;background-color: #3490dc;" ><i class="fa fa-check-circle"></i>apporved</button> -->
                      </td>

					               <td>
                      <a href="{{ url('dashboard/leaves_of_emp_reject/'.$array->id) }}" class="btn btn-info btn-lg" style="padding: 0px;background-color: red;"><i class="fa fa-window-close">Reject</i></a>

                          <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" style="padding: 0px;background-color: red;" ><i class="fa fa-window-close">Reject</i></button> -->
                        </td>
					       </tr>
                 <?php  } ?>
					         
					    </tbody>
					</table>
  
<!-- notification modal  for reject leaves-->
                            
          <!-- Trigger the modal with a button -->
          
        


          <!-- Modal  -->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                  <h4 class="modal-title">Why Are you Reject ?</h4>
                </div>
                <div class="modal-body">
                  <form method="post" action="">
                  	@csrf
                      <div class="form-group row">
                 	 
                 	  	  
					                            <label for="reason" class="col-md-4 col-form-label text-md-right">{{ __('Reason For Rejection') }}</label>

					                            <div class="col-md-6">
					                                <textarea id="reason" type="text" class="form-control{{ $errors->has('reason') ? ' is-invalid' : '' }}" name="reason" value="{{ old('reason') }}" required autofocus></textarea> 

					                                @if ($errors->has('reason'))
					                                    <span class="invalid-feedback">
					                                        <strong>{{ $errors->first('reason') }}</strong>
					                                    </span>
					                                @endif
					                            </div>
					   
				    </div>

                         <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" >
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
               </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
          </div>
      </div>
              <!-- notificaton modal  reject leaves end -->

<!-- notification modal  for accept leaves-->
                            
          <!-- Trigger the modal with a button -->
          
        


          <!-- Modal  -->
          <div class="modal fade" id="myModal_accept" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-body">
                  <form method="post" action="">
                  	@csrf
                    
                         <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary"  name="reason">
                                    {{ __('Are you Sure ?') }}
                                </button>
                            </div>
                        </div>
               </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
          </div>
      </div>
              <!-- notificaton modal  accept leaves end -->



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
