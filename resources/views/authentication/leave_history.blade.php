@extends('layouts.admin')
@section('page-title')
Users Details
@endsection
@section('sub_breadcrumb')
<li><a href="{{url('administration/employee')}}"><i class="glyphicon glyphicon-user"></i> Employee > </a></li>
<li><a href="#"><i class="glyphicon glyphicon-book"></i> leave History </a></li>
@endsection
@section('content')
@foreach($leaves as $leave)
    <div class="col-md-12">
        <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$leave->created_at->format('d/m/Y')}}</h3>
                </div>
                <!-- /.box-header no-padding -->
                <div class="box-body">
                    <!-- history of leave -->
                    <div class="row">
                        <div class="col-md-6">Reason</div>
                        <div class="col-md-6">Response</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"><b>{{$leave->leave_reason}}</b></div>
                        <div class="col-md-6"><b>{{$leave->leave_response}}</b></div>
                    </div>
                    <!-- end history of leave -->
                </div>
                <!-- /.box-body -->
                </div>
    </div>
    {{ $leaves->links() }}
  @endforeach
@endsection