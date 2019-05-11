@extends('layouts.authentication.admin')
@section('page-title')
Employee Details
@endsection
@section('sub_breadcrumb')
<i class="glyphicon glyphicon-user"></i> Employee
@endsection
@section('content')

  <div class="box">
            <div class="box-header">
              <div class="modal-header">
                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#myModal_add_new">Add New User</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>SN</th>
                  <th>Status</th>
                  <th>Action</th>
                  <th>Full Name</th>
                  <th>User Name</th>
                  <th>Email</th>
                </tr>
                </thead>
                <tbody>
                 @foreach($employees as $employee)
                 {{$employee->user_id}}
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><label class="switch">
                    <input type="checkbox" {{$employee->status == 1 ?'checked' : ''}} >
                    <span class="slider round"></span>
                    </label></td>
                    <td>
                      <div class="row">
                        <form action="{{url('administration/employee/'.$employee->id)}}" method="get">
                            @csrf
                          <select name="year" class="btn">
                            <option value="0">Year</option>
                              <?php 
                                for($i =0; $i <= 10 ;$i++)
                                {
                                $year = date('Y')-$i;
                                echo '<option value='. $year.'>'.$year.'</option>';
                                }
                               ?>
                          </select>
                          <select name="month" class="btn">
                              <option class="dropdown-menu" value="0">Month</option>
                              @foreach(config('custom.month.months') as $key => $value)
                                <option value="{{$key}}"> {{$value}} </option>
                              @endforeach
                          </select>
                          <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-eye-open"></i></button>
                       </form>
                      </div>
                      
                    </td>
                   <!--  <td> <a href=" {{url('administration/employee/'.$employee->id)}} "><i class=" glyphicon glyphicon-new-window btn btn-primary"></i></a> </td> -->
                    <td>{{$employee->full_name}}</td>
                    <td>{{$employee->username}}</td>
                    <td>{{$employee->email}}</td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>

@endsection
@section('scripts')
<!-- script handling -->
<script>
  $(document).ready(function(){
    var base_url ="http://localhost:8000";
     
     });
</script>
@endsection