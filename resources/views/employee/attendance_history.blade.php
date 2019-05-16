@extends('layouts.employee')
@section('content')
<div class="row">
  @foreach($attendances as $attendance)
    <div class="col-md-12">
        <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$attendance->created_at->format('d/m/Y')}}</h3>
                </div>
                <!-- /.box-header no-padding -->
                <div class="box-body">
                    <!-- history of attendance -->
                    <div class="row">
                        <div class="col-md-6">Check In</div>
                        <div class="col-md-6">Check Out</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"><b>{{$attendance->office_checkin->format('H:i:s')}}</b></div>
                        <div class="col-md-6"><b>{{$attendance->office_checkout}}</b></div>
                    </div>
                    <!-- end history of attendance -->
                </div>
                <!-- /.box-body -->
                </div>
    </div>
    {{ $attendances->links() }}
  @endforeach
</div>
@endsection
@section('scripts')
  <!-- script handling  -->
  <script src="{{asset('js/employee_leave.js')}}"></script>
@endsection
