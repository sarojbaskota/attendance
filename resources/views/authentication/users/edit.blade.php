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
                        <input type="hidden"  class="user_id" value="{{$user->id}}">
                        <div class="form-group row">
                            <label for="full_name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                            <div class="col-md-6">
                                <input  type="text" class="full_name form-control{{ $errors->has('full_name') ? ' is-invalid' : '' }}" name="full_name" value="{{$user->full_name }}" required autofocus>
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
                                <input  type="text" class="username form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ $user->username }}" required autofocus>

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
                                <select type="text" class="role form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" name="role" value="{{ old('role') }}" required autofocus>
                                        <option value="0">Select Role</option>
                                        <option value="2" {{$user->role == 0 ?'selected' : ''}}>Employee</option>
                                        <option value="1" {{$user->role == 1 ?'selected' : ''}}>Admin</option>
                                 </select>
                               
                            
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input type="email" class="email form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>

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
                       <div class="form-group row">
                          <label class="control-label col-md-4 col-form-label text-md-right">Status</label>
                          <div class="col-md-6">
                           <label class="switch">
                            <input type="checkbox" name="status" class="status" value="1" {{$user->status == 1 ?'checked' : ''}}>
                            <span class="slider round"></span>
                            </label>
                          </div>
                       </div>
                        <div class="form-group row">
                                  <label for="password" class="password col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                  <div class="col-md-6">
                                      <input  type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

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
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button  class="update_form btn btn-primary">
                                    {{ __('Register') }}
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
@section('scripts')
<script>
   $(document).ready(function(){
    var base_url ="http://localhost:8000";
    $('#myupdate .update_form').on('click', function(event) {
        event.preventDefault();
        aletr('hello');
        var id = $('#myupdate .user_id').val(); 
        var full_name = $('#myupdate .full_name').val(); 
        var username = $('#myupdate .username').val();
        var role = $('#myupdate .role').val();
        var status = $('#myupdate .status').val();
        var email = $('#myupdate .email').val();
        var password = $('#myupdate .password').val();
        var password_confirmation = $('#myupdate .password_confirmation').val();
        var formData = new FormData($('#myupdate')[0]);
        var file = $('#myupdate .profile_avatar')[0].files[0];

        formData.append('profile_avatar', file); 
        formData.append('full_name', full_name);
        formData.append('username', username);
        formData.append('role', role);
        formData.append('status', status);
        formData.append('email', email);
        formData.append('password', password);
        formData.append('password_confirmation', password_confirmation);
          for (var pair of formData.entries()) {
          console.log(pair[0]+ ': ' + pair[1]); 
          }
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: base_url+'/administration/users/'+id, 
            method:'PATCH', //PUT| Patch
            dataType:'JSON',
            enctype: 'multipart/form-data',
            contentType: false,
            cache: false,
            processData: false,
            data: formData,
          success: function( result ) {
            console.log(result);
           swal(result.success,"success")
           .then(function(isConfirm) {
              // $('#myModal_edit #post_update_form').trigger("reset");
              $('#myModal_edit').modal('hide');
           });
          },
         
      });
    });
});
</script>
@endsection