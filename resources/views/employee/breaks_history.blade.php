@extends('layouts.employee')
@section('content')
<div class="row">
  @foreach($breaks as $break)
    <div class="col-md-12">
        <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$break->created_at->format('d/m/Y')}}</h3>
                </div>
                <!-- /.box-header no-padding -->
                <div class="box-body">
                    <!-- history of break -->
                    <div class="row">
                      <div class="col-md-4">Break Check Out</div>
                      <div class="col-md-4">Break For</div>
                      <div class="col-md-4">Break Check In</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><b>{{$break->break_checkout->format('H:i:s')}}</b></div>
                        <div class="col-md-4">some</div>
                        <div class="col-md-4"><b>{{$break->break_checkin}}</b></div>
                    </div>
                    <!-- end history of attendance -->
                </div>
                <!-- /.box-body -->
                </div>
    </div>
    {{ $breaks->links() }}
  @endforeach
</div>
@endsection
@section('scripts')
  <!-- script handling  -->
  <script src="{{asset('js/employee_leave.js')}}"></script>
@endsection
