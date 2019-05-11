@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                  <div class="row">
                      <div class="col-md-9">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                      </div>
                     </div> 
               <!-- form -->
               <h3>
                  @if(session()->has('message'))
                  <div class="alert alert-success">
                  {{ session()->get('message') }}
                  </div>
                  @endif
                </h3>
               <div class="office-aatend-head">
                     <h3 style="text-align: center;background-color: #3490dc; color: white;padding: 5px;">Office Check In & Check Out</h3>
               </div>
               <div class="row office-checkin-checkout">
                    <!-- form submit for checkin -->
                    <div class="col-md-6 office-checkin">
                      <div class="form-group">
                        <form method="POST" action="{{ route('home') }}">
                          @csrf       
                          <div class="form-group mb-0" style="margin-right: 50px;">
                              <div class="offset-md-4">
                                <h4>Before Office</h4>
                                  <button type="submit" class="btn btn-primary"  name="action">
                                      {{ __('Check In') }}
                                  </button>
                              </div>
                          </div>
                      </form> 
                    </div>
                  </div>
                  <div class="col-md-6 office-checkout">
                      <!-- form submit for check out -->
                     <div class="form-group">
                      <form method="POST" action="{{ route('office_checkout') }}">
                          @csrf
                        <div class="form-group mb-0">
                                <div class="offset-md-4 active">
                                  <h4>After Office</h4>
                                    <button dusk="login-button" type="submit" class="btn btn-primary"  name="checkout">
                                        {{ __('Check Out') }}
                                    </button>
                                </div>
                         </div>
                      </form> 
                     </div> 
                  </div>
            </div>
            <!-- office checkin and check out part end here -->
            <!-- break check in checkout part start -->
             <div class="take-break">
              <h3 style="text-align: center;background-color: #3490dc; color: white;padding: 5px;">Break Checkin & Checkout </h3>
                        <!-- form -->
                        <h5 style="text-align: center; margin: 20px 0px 20px 0px;">Enter Required Info For Break</h5>
               <div class="new row">
                       <div class="new col-md-6">
                        <form method="POST" action="{{ route('check_inbreak') }}">
                            @csrf
                           <div class="form-group">
                             <!--  <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label> -->
                                  <select id="category" type="text" class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}" name="category" value="{{ old('category') }}" required autofocus>
                                      <option value="0">SELECT Break Category</option>
                                      <option value="1">Break Fast</option>
                                      <option value="2">Lunch</option>
                                      <option value="3">Early Dinner</option>
                                      <option value="4">Dinner</option>
                                      <option value="5">Emergency</option>
                                      <option value="6">Others</option>
                                  </select>
                                  @if ($errors->has('category'))
                                      <span class="invalid-feedback">
                                          <strong>{{ $errors->first('category') }}</strong>
                                      </span>
                                  @endif
                                  <div class="reason">
                                <!-- <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Reason') }}</label> -->
                                 <textarea class="form-control" rows="4", cols="40" id="reason" name="reason" placeholder="Reason For Your Break" style="resize:none; margin-top: 25px;"></textarea>
                               </div>
                        </div>
                        <div class="form-group">
                            <div class="offset-md-4 active"  style="margin-top: 25px;">
                               <!--  check in break -->
                                <button dusk="login-button" type="submit" class="btn btn-primary" >
                                    {{ __('Break Check In ') }}
                                </button>
                            </div>
                        </div>  
                    </form>   
              </div>
              <div class="new col-md-6">
                
                                    <!-- form submit for break check out -->
                    <form method="POST" action="{{ route('employee_breakout') }}">
                        @csrf
                    <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4 active"  style="margin-top: 180px;margin-bottom: 20px;">
                                <button dusk="login-button" type="submit" class="btn btn-primary"  name="checkout">
                                    {{ __('Break Check Out ') }}
                                </button>
                            </div>
                        </div>
                
                    </form>  
              </div>
            </div>
                        
             </div>  
              <div class="apply-for-leave">
                <h3 style="text-align: center;background-color: #3490dc; color: white;padding: 5px;">Apply For Leave </h3>
                <form method="POST" action="{{ route('employee_leave_request') }}">
                    @csrf
                    <h4>Apply For Leave </h4>
                    <div class="discription">
                        <label for="category" class="col-md-4 col-form-label text-md-right" style="margin-top: 40px;">{{ __('Reason') }}</label>

                                <textarea rows="4", cols="40" id="reason" name="reason" style="resize:none; margin-top: 25px;" required></textarea>
                    </div>
                    <button dusk="login-button" type="submit" class="btn btn-primary" style="margin-left: 233px; margin-top: 20px;">
                                    {{ __('Submit Leave') }}
                                </button>
                 </form>
            </div>


            <!-- leave request notification -->
             <!-- Modal for leave response -->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                  <h4 class="modal-title">Status Of Leave Request</h4>
                </div>
                <div class="modal-body">
                   <table class="table" id="table">
                        <thead>
                            <tr>
                               
                                <th class="text-center" style="border:1px solid gray;">Response Of Your Leave</th>
                                <th class="text-center" style="border:1px solid gray;"> Date Of Leave</th>
                               
                                
                            </tr>
                        </thead>
                        <tbody>

                 
                        <?php
                        $eid = auth()->user()->id;
                              $results = DB::select("SELECT employee_id,created_at,status FROM leaves_request where employee_id= $eid");

                         foreach ($results as $row) {
                            // print only date
                            $dateofleave =  $row->created_at;
                            $fulldate =   explode(" ",$dateofleave);

                           $resp =  $row->status;
                            if($resp=='Reject'){
                            $response = '<span style="color:red;">Your Request is Rejected. </span>';
                           }elseif($resp=='Approved')
                           {
                                $response = '<span style="color:blue;">Your Request is Approved. </span>';
                           }else{
                             $response = '<span style="color:green;">Your Request is Pending Now.</span>';
                           }
                          ?>

                        <tr> 
                       <td style="border:1px solid gray;" >  <?php echo $response ?></td>
                         <td style="border:1px solid gray;" ><?php echo  $fulldate[0]; ?></td>
                                   
                               </tr>
                               <?php } ?>
                             
                        </tbody>
                    </table>
                    
                         
                
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
              <!-- notificaton modal for leaves response  end -->
            </div>
          </div>
            <!-- leave request notification end -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
