@extends('layouts.admin')
@section('page-title')
Admin Details
@endsection
@section('sub_breadcrumb')
<i class="glyphicon glyphicon-user"></i> Users Details
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
              @if (session('status'))
              <div class="alert alert-success">
              {{ session('status') }}
              </div>
              @endif
             <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>SN</th>
                  <th>Status</th>
                  <th>Action</th>
                  <th>Full Name</th>
                  <th>Username</th>
                  <th>Email</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($users as $user)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>
                      <label class="switch">
                      <input type="checkbox" class="status_change" data-id="{{$user->id}}" {{$user->status == 1 ?'checked' : ''}} >
                      <span class="slider round"></span>
                      </label>
                      </td>
                      <td>
                      <a  class="btn btn-primary show-details" data-id="{{$user->id}}" ><i class="glyphicon glyphicon-eye-open"></i></a>
                      <a  class="btn btn-primary edit-user" data-id="{{$user->id}}"><i class="glyphicon glyphicon-edit"></i></a>
                      <a class="btn btn-danger delete-user" data-id="{{$user->id}}"><i class="glyphicon glyphicon-trash"></i></a>
                      </td>
                      <td>{{$user->full_name}}</td>
                      <td>{{$user->username}}</td>
                      <td>{{$user->email}}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
 
 <!-- show modal here by replacing different layout with the help of js -->
   <div id="show_modal"></div>
       <!--===================================================
       =========== Modal create new user===================
       =====================================================-->
      <div class="modal fade" id="myModal_create" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Create New User</h4>
            </div>
            <div class="modal-body">
                 <!-- create new user -->
                 <form id="post_create_form">
                     <!-- enctype="multipart/form-data" -->
                              <div class="form-group row">
                                  <label for="full_name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                                  <div class="col-md-6">
                                      <input id="full_name" type="text" class="form-control{{ $errors->has('full_name') ? ' is-invalid' : '' }}" name="full_name" value="{{ old('full_name') }}" required autofocus>
                                      @if ($errors->has('full_name'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('full_name') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                  <div class="col-md-6">
                                      <input  type="text" class="username form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('name') }}" required >

                                      @if ($errors->has('username'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('username') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('User Role') }}</label>

                                  <div class="col-md-6">
                                      <select  type="text" class="role form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" name="role" value="{{ old('role') }}" required >
                                              <option value="0">Select Role</option>
                                              <option value="2">Employee</option>
                                              <option value="1">Admin</option>
                                       </select>
                                     
                                  
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                  <div class="col-md-6">
                                      <input  type="email" class="email form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                      @if ($errors->has('email'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('email') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                  <div class="col-md-6">
                                      <input  type="password" class="password form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                      @if ($errors->has('password'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('password') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                  <div class="col-md-6">
                                      <input  type="password" class="password_confirmation form-control" name="password_confirmation" required>
                                  </div>
                              </div>
                              <div class="form-group row">
                                <label class="control-label col-md-4 col-form-label text-md-right">User Avatar</label><br> 
                                <div class="col-md-6">
                                  <input class="profile_avatar form-control" type="file"  required>
                                </div>
                             </div>
                              <div class="form-group row">
                                <label class="control-label col-md-4 col-form-label text-md-right">Status</label>
                                <div class="col-md-6">
                                 <label class="switch">
                                  <input type="checkbox" name="status" class="status" value="1" id="status" >
                                  <span class="slider round"></span>
                                  </label>
                                </div>
                             </div>
                             <div id="validation-errors"></div>
                              <div class="form-group row mb-0">
                                  <div class="col-md-6 offset-md-4">
                                      <button  class="post_form btn btn-primary">
                                          {{ __('Register') }}
                                      </button>
                                  </div>
                              </div>
                 </form>
               <!-- form end create user -->
              <div class="modal-footer">
              </div>
           </div>
          
        </div>
      </div>
     </div>
      <!-- Modal edit user -->
  <div class="modal fade" id="myModal_edit" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Details</h4>
        </div>
        <div class="modal-body">
         <!-- edit user -->
         <form id="myupdate">                        
          <input type="hidden"  class="user_id" value="">
                        <div class="form-group row">
                            <label for="full_name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                            <div class="col-md-6">
                                <input  type="text" class="full_name form-control{{ $errors->has('full_name') ? ' is-invalid' : '' }}" name="full_name" value="" required >
                                @if ($errors->has('full_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('full_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input  type="text" class="username form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="" required >

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('User Role') }}</label>

                            <div class="col-md-6">
                                <select type="text" class="role form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" name="role" value="" required >
                                        <option value="null">Select Role</option>
                                        <option value="0" {{$user->role == 0 ?'selected' : ''}}>Employee</option>
                                        <option value="1" {{$user->role == 1 ?'selected' : ''}}>Admin</option>
                                 </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input type="email" class="email form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group row">
                          <label class="control-label col-md-4 col-form-label text-md-right">User Avatar</label><br> 
                          <div class="col-md-6">
                            <input type="file" class="profile_avatar form-control"  name="profile_avatar">
                          </div>
                       </div>
                        <div id="validation-errors"></div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button  class="update_form btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
         <!-- form end edit user -->
        </div>
      </div>
      
    </div>
  </div>
        <!-- end modal -->
 @endsection
@section('scripts')
<script src="{{asset('js/users.js')}}" ></script>
@endsection