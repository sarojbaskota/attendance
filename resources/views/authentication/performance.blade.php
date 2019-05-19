@extends('layouts.admin')
@section('page-title')
Users Details
@endsection
@section('sub_breadcrumb')
<li><a href="{{url('administration/employee')}}"><i class="glyphicon glyphicon-user"></i> Employee > </a></li>
<li><a href="#"><i class="glyphicon glyphicon-book"></i> leave History </a></li>
@endsection
@section('content')
<div class="box">
            <div class="box-header">
              <div class="modal-header">
                <a href="" class="btn btn-primary" id="create_user">Add New</a>
              </div>
            </div>
            <!-- /.box-header -->
              <div class="box-body">
             <table id="attendance-table" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>SN</th>
                  <th>Office Hours</th>
                  <th>Break Hours</th>
                  <th>Working Hours</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($datas as $data)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>
                            <?php
                                $office_checkin = new DateTime($data->office_checkin);
                                $office_checkout = new DateTime($data->office_checkout);
                                $office_hour = $office_checkin->diff($office_checkout);
                                echo $office_hour->format('%h:%i');
                            ?>
                        </td>
                      <td>
                             <?php
                                $break_checkout = new DateTime($data->break_checkout);
                                $break_checkin = new DateTime($data->break_checkin);
                                $break_hour = $break_checkout->diff($break_checkin);
                                echo $break_hour->format('%h:%i');
                            ?>
                      </td>
                      <td>
                      <?php
                          $office_hour = new DateTime($office_hour->format('%h:%i'));
                          $break_hour = new DateTime($break_hour->format('%h:%i'));
                          $working_hour = $office_hour->diff($break_hour);
                          
                          echo $working_hour->format('%h:%i');
                            ?>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
@endsection