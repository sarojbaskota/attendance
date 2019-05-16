@extends('layouts.employee')
@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Leave Form</h3>
              </div>
              <!-- /.box-header no-padding -->
              <div class="box-body">
                  <!-- break checkin -->
                  <form id="leave-request">
                    <div class="form-group">
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    </div>        
                    <div class="form-group">
                      <label for="leave_reason" class="col-form-label" >Any Specific Reason</label>
                      <textarea class="form-control" rows="4" cols="40" name="leave_reason" required></textarea>
                      <div class="error text-red"></div>
                      <small>Mention how many days you want leave and clearly mention the acceptable reason</small>
                    </div>
                    <div class="form-group">
                          <button dusk="login-button" type="submit" class="btn btn-primary" >
                            {{ __('Request') }}
                          </button>
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
  <script src="{{asset('js/employee_leave.js')}}"></script>
@endsection
