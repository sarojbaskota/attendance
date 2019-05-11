<!DOCTYPE html>
<html lang="en">
<head>
  <title>Email Example</title>
  <meta charset="utf-8">
 <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>


</head>
<body>

<div class="container">
  <h2>Vertical (basic) form</h2>
  
    <a href="{{url('home')}}" target="_blank">Open in a new tab</a>
<input type="text" name="test">  
  
  <form id="ajax_form">
      @csrf
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="name" class="form-control" id="name" placeholder="Enter Your full name" name="name">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    <div class="form-group">
      <label for="message">Message:</label>
      <input type="message" class="form-control" id="message" placeholder="Enter message" name="message">
    </div>
    <button type="submit" class="btn btn-default" id="ajaxSubmit">Submit</button>
  </form>
</div>
<script>
  var host = 'http://localhost:8000';
  $( document ).ready(function() {
     $('#ajax_form').on('submit', function(event) {
       event.preventDefault();
        var name = $('#name').val();
        var email = $('#email').val();
        var message = $('#message').val();
       $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           type: "POST",
           url: host+'/send-mail/email',
           data: {name:name, message:message, email:email},
           success: function( result ) {
            swal( result.status,result.msg);
           }
       });
   });
});       
</script>
    </body>

</html>
