
 
         
<script>
  $(document).ready(function(){
    var base_url ="http://localhost:8000";
      // store data with ajax username
      $('#post_form').on('submit', function(event) {
        event.preventDefault();
        var full_name = $('#full_name').val(); 
        var username = $('#username').val();
        var role = $('#role').val();
        var status = $('#status').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var password_confirmation = $('#password_confirmation').val();

        var formData = new FormData($(this)[0]);
        var file = $('#profile_avatar')[0].files[0];
        formData.append('profile_avatar', file);
        formData.append('full_name', full_name);
        formData.append('username', username);
        formData.append('role', role);
        formData.append('status', status);
        formData.append('email', email);
        formData.append('password', password);
        formData.append('password_confirmation', password_confirmation);
        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: base_url+'/admin_dashboard/usersm mbjbjb',
            method:"POST",
            dataType:'JSON',
            enctype: 'multipart/form-data'
            contentType: false,
            cache: false,
            processData: false,
            
            // data: {full_name:full_name, username:username, email:email,role:role,status:status,password:password,profile_avatar:profile_avatar,password_confirmation:password_confirmation},
          success: function( result ) {
            //console.log(result);
           swal(result.success,"success");
          }
      });
    });

      
  });
</script>