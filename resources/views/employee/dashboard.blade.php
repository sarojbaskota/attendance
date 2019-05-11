@extends('layouts.employee')
@section('content')

<div class="row">

       <div class="col-md-6">
              <!-- Employee Check In Check Out -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3>
                    <!-- office checkin and checkout message -->
                    @if(!empty($sucess)) 
                    <div class="alert alert-success"> {{ $sucess }}</div>
                  @endif
                  @if(!empty($message_error))
                    <div class="alert alert-danger"> {{ $message_error }}</div>
                  @endif
                  </h3>
                  <h3 class="box-title">Office Checkin & Checkout</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="row">
                    <div class="col-md-6 office-checkin">
                      <div class="form-group">
                        <form method="POST" action="{{ url('employee_dashboard/checkin') }}">
                          @csrf       
                          <div class="form-group mb-0" style="margin-right: 50px;">
                              <div class="offset-md-4">
                            
                                  <button type="submit" class="btn btn-primary"  name="action">
                                      {{ __('Check In') }}
                                  </button>
                              </div>
                          </div>
                      </form> 
                    </div>
                    </div>
                    <div class="col-md-6 office-checkout">
                      <div class="form-group">
                      <form method="POST" action="{{ url('employee_dashboard') }}">
                          @csrf
                        <div class="form-group mb-0">
                                <div class="offset-md-4 active">
                                 
                                    <button dusk="login-button" type="submit" class="btn btn-primary"  name="checkout">
                                        {{ __('Check Out') }}
                                    </button>
                                </div>
                         </div>
                      </form> 
                     </div> 
                    </div>
                  </div>
                </div>
                
              </div>
              <!--/.box -->
       </div>
       <div class="col-md-6">
              <!-- Employee break Check In Check Out -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3>
                    <!-- break checkin & checkout message -->
                    @if(!empty($break_checkin_message))
                    <div class="alert alert-success"> {{ $break_checkin_message }}</div>
                  @endif
                  @if(!empty($break_message_error))
                    <div class="alert alert-danger"> {{ $break_message_error }}</div>
                  @endif
                  <!-- @if(!empty($sucess))
                    <div class="alert alert-success"> {{ $sucess }}</div>
                  @endif
                  @if(!empty($checkout_sucess))
                    <div class="alert alert-success"> {{ $checkout_sucess }}</div>
                  @endif -->
                  </h3>
                  <h3 class="box-title">Break Checkin & Checkout</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="row">
                    <div class="col-md-6 office-checkin">
                      <div class="form-group">
                        <form method="POST" action="{{ url('employee_dashboard/break_checkin') }}">
                            @csrf
                           <div class="form-group">
                            <!-- get employee id from here -->
                                  <input type="hidden" name="employee_id" value="{{Auth::user()->id}}">
                                  <select id="break_type" type="text" class="form-control{{ $errors->has('break_type') ? ' is-invalid' : '' }}" name="break_type" value="{{ old('break_type') }}" required autofocus>
                                      <option value="0">Break Type</option>
                                      @foreach (config('custom.break_category.break_categories') as $key => $value)
                                        ?>
                                      <option value="{{$key}}"> {{$value}} </option>
                                      @endforeach
                                  </select>
                                  @if ($errors->has('break_type'))
                                      <span class="invalid-feedback">
                                          <strong>{{ $errors->first('break_type') }}</strong>
                                      </span>
                                  @endif
                                  <div class="form-group break_reason">
                                <!-- <label for="break_type" class="col-md-4 col-form-label text-md-right">{{ __('break_reason') }}</label> -->
                                 <textarea class="form-control" rows="4" cols="40" id="break_reason" name="break_reason" placeholder="Reason For Your Break" style="resize:none; margin-top: 25px;">
                                 </textarea>
                               </div>
                        </div>
                        <div class="form-group">
                            <div class="offset-md-4 active"  style="margin-top: 25px;">
                               <!--  check in break -->
                                <button {{ $disabled ? "disabled" : "" }} dusk="login-button" type="submit" class="btn btn-primary" >
                                    {{ __('Break Check In ') }}
                                </button>
                            </div>
                        </div>  
                    </form> 
                    </div>
                    </div>
                    <div class="col-md-6 office-checkout">
                      <div class="form-group">
                      <form method="POST" action="{{ url('employee_dashboard/break_checkout') }}">
                          @csrf
                        <div class="form-group mb-0">
                                <div class="offset-md-4 active">
                                 
                                    <button dusk="login-button" type="submit" class="btn btn-primary"  name="checkout">
                                        {{ __('Break Checkout') }}
                                    </button>
                                </div>
                         </div>
                      </form> 
                     </div> 
                    </div>
                  </div>
                </div>
                
              </div>
              <!--/.box -->
       </div>
     </div>
@endsection
@section('script')

<!-- script handling -->
<script>
  $(document).ready(function(){
    var base_url = 'http://localhost:8000';
    // view quick details of user 
    $(".show-details").click(function(){
      var id = $(this).data('id');
      event.preventDefault();
       $.ajax({
        type: 'GET',
        url: base_url+'/admin_dashboard/admin/'+id,
        success:function(data){
          console.log(data);
          $("#show-modal").html(data);
          $('#myModal_show').modal('show');
        }
       });
    });
    // create username
    $("#create_user").click(function(){
      event.preventDefault();
       $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          },
        type: 'GET',
        url: base_url+'/admin_dashboard/admin/create/',
        success:function(data){
          console.log(data);
          $("#show-modal").html(data);
          $('#myModal_create').modal('show');
        }
       });
    });
  });
  @endsection
