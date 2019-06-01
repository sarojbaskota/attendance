@extends('layouts.employee')
@section('content')
<div class="row">
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
  @endforeach
</div>
<!-- {{ $leaves->links() }} -->
@endsection
@section('scripts')
  <!-- script handling  -->
  <script src="{{asset('js/employee_leave.js')}}"></script>
@endsection
