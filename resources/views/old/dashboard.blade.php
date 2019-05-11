@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   
                    <div class="row">
                      <div class="col-md-9">
                         <p>
                        <?php 
                         $eid = auth()->user()->id;
                          $results = DB::select("SELECT name FROM users where id= $eid");
                          foreach ($results as $value) {
                          $user_name =  $value->name;
                          } 
                          echo   'Hello '.'<b>'.$user_name.'</b>';         
                        ?>
                   
                  </p>
                         You are logged in Admin page!
                      </div>
                     
                    </div>


                                    
                            <!-- Sidebar -->
                            <div class="sidebar" style="margin-top: 50px;">
                                <div class="w3-sidebar w3-bar-block w3-border-right" style="display:none" id="mySidebar" >
                      <button onclick="w3_close()" class="w3-bar-item w3-large">Close &times;</button>
                      <a href="{{URL::asset('dashboard/create')}}" class="w3-bar-item w3-button"><b>Create a User</b></a>
                      <a href="{{URL::asset('dashboard/view')}}" class="w3-bar-item w3-button"><b>View All Users</b></a>
                      <a href="{{URL::asset('dashboard/attendance')}}" class="w3-bar-item w3-button"><b>View Timesheet</b></a>
                      <a href="{{URL::asset('dashboard/leaves_of_emp')}}" class="w3-bar-item w3-button"> <b>View Leave Of Employee</b></a>
                      <a href="{{URL::asset('dashboard/emplyoee_records')}}" class="w3-bar-item w3-button"><b>View Individual Record Of Employee</b></a>
                    </div>



                    <!-- Page Content -->
                    <div class="w3-teal">
                      <button class="w3-button w3-teal w3-xlarge" onclick="w3_open()">☰</button>
                      <div class="w3-container">
                        <h1>Admin Page.</h1>
                      </div>
                    </div>

                   
                    <script>
                    function w3_open() {
                        document.getElementById("mySidebar").style.display = "block";
                    }
                    function w3_close() {
                        document.getElementById("mySidebar").style.display = "none";
                    }
                    </script>
                            </div>
                    
                         


                 </div>
            </div>
        </div>
    </div>
</div>

@endsection