@extends('layouts.employee')
@section('sub_breadcrumb')
 <i class="glyphicon glyphicon-user"></i> Dashboard
@endsection
@section('content')
<div class="row"> 
  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-calendar"></i></span>
      <div class="info-box-content">
      <small>
        @if($status)
        Checked : {{$status->office_checkin->format('H:i:s')}}
        <div style="margin-top:10px;"></div>
        @else
        <div style="margin-top:10px;"></div>
        @endif
      </small>
        <span class="info-box-number" id="check-button"> <a class="btn btn-danger btn-sm {{($status)?'checkout':'checkin'}}"> <b class="attendance">
         @if(isset($status))
         I AM OUT
         @else
         I AM IN
         @endif
        </b> <i class="glyphicon glyphicon-ok-circle"></i></a> </span>
      <div style="margin-top:10px;"></div>
        <small>Checkin / Checkout</small>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <div class="col-md-8">
    <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Break</h3>
              </div>
              <!-- /.box-header no-padding -->
              <div class="box-body">
                  <!-- break checkin -->
                  <form id="break-checkout">
                    <div class="form-group">
                      <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                      <select type="text" class="form-control" name="break_type" required>
                        <option value="0">Break Type</option>
                        <option value="1">Dinner</option>
                      </select>
                      <div class="error text-red"></div>
                    </div>        
                    <div class="form-group">
                      <label fro="reason" class="col-form-label" >Any Specific Reason</label>
                      <textarea class="form-control" rows="4" cols="40" name="break_reason" placeholder="Reason For Your Break"></textarea>
                    </div>
                    <div class="form-group">
                        @if($breaks)
                        <button dusk="login-button" id="break_button"  class="btn btn-danger" >
                          {{ __('CHECKIN') }}
                          </button>
                          <small>
                            You checkedout At: {{$breaks->break_checkout->format('H:i:s')}}
                          </small>
                        @else
                          <button dusk="login-button" type="submit" class="btn btn-primary" >
                            {{ __('CHECKOUT') }}
                          </button>
                        @endif  
                    </div>  
                  </form> 
                <!-- end break checkin -->
              </div>
              <!-- /.box-body -->
            </div>
  </div>
</div>
@endsection
@section('scripts')
  <!-- script handling  -->
  <script src="{{asset('js/employee_dashboard.js')}}"></script>
@endsection
