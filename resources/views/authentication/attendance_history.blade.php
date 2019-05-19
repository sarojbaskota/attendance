@extends('layouts.admin')
@section('page-title')
Users Details
@endsection
@section('sub_breadcrumb')
<li><a href="{{url('administration/employee')}}"><i class="glyphicon glyphicon-user"></i> Employee > </a></li>
<li><a href="#"><i class="glyphicon glyphicon-book"></i> Attendance History </a></li>
@endsection
@section('content')
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
@endsection