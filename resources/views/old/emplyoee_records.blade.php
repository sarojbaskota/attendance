@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Attendance Of User In System') }}</div>



             <h5  style="text-align: center;margin-top: 10px;">Please Insert User Details For Record</h5>
					<form method="POST" action="{{ route('/emplyoee_records') }}" enctype="multipart/form-data" id="btnAdd">
                        @csrf
					<div class="form-group row">

	                            <div class="col-md-6" style="margin-top: 10px;">
	                                <select id="employee" type="text" class="form-control{{ $errors->has('employee') ? ' is-invalid' : '' }}" name="employee" value="{{ old('employee') }}" required autofocus>
	                                    <option value="0">Select Emplyoee</option>
	                                   
						                <?php 
						                foreach($employees as $employee) {
						                	?>

						            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
						            <?php
						            }
						            ?> 
	                                    
	                                </select>
	                                @if ($errors->has('employee'))
	                                    <span class="invalid-feedback">
	                                        <strong>{{ $errors->first('employee') }}</strong>
	                                    </span>
	                                @endif
                            </div>
	                               

                       



	                           <div class="col-md-6" style="margin-top: 10px;">
	                                <select id="month" type="text" class="form-control{{ $errors->has('month') ? ' is-invalid' : '' }}" name="month" value="{{ old('month') }}" required autofocus>
	                                    <option value="0">Select Month</option>
	                                    <option value="1">January</option>
	                                    <option value="2">February</option>
	                                    <option value="3">March</option>
	                                    <option value="4">April</option>
	                                    <option value="5">May</option>
	                                    <option value="6">June</option>
	                                    <option value="7">July</option>
	                                    <option value="8">August</option>
	                                    <option value="9">September</option>
	                                    <option value="10">October</option>
	                                    <option value="11">November</option>
	                                    <option value="12">December</option>
	                                                                      
	                                    
	                                </select>
	                                @if ($errors->has('month'))
	                                    <span class="invalid-feedback">
	                                        <strong>{{ $errors->first('month') }}</strong>
	                                    </span>
	                                @endif
                            </div>
	               <div class="col-md-6" style="margin-top: 10px;">
	                                <select id="year" type="text" class="form-control{{ $errors->has('year') ? ' is-invalid' : '' }}" name="year" value="{{ old('year') }}" required autofocus>
	                                    <option >Select Year</option>
	                                    <option >2013</option>
	                                    <option >2014</option>
	                                    <option >2015</option>
	                                    <option >2016</option>
	                                    <option >2017</option>
	                                    <option >2018</option>
	                                    <option >2019</option>
	                                    <option >2020</option>
	                                    <option >2021</option>
	                                                                                                          
	                                    
	                                </select>
	                                @if ($errors->has('year'))
	                                    <span class="invalid-feedback">
	                                        <strong>{{ $errors->first('year') }}</strong>
	                                    </span>
	                                @endif
                            </div>




			         </div>

					              <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4"  >
                                <button type="submit"  class="btn btn-primary"  onClick="MyFunction()" >
                                    {{ __('View Details') }}
                                </button>
                            </div>
                        </div>
                    </form>   
              


        
               


				</div>
				<a href="http://localhost:8000/authentication/create">Add New User</a>
					<br />
					<a href="http://localhost:8000/authentication/view">View All Users </a><br />
					<a href="http://localhost/AttendanceSystem/public/authentication/emplyoee_records">View Individual</a> <br />
					<a href="http://localhost/AttendanceSystem/public/authentication/leaves_of_emp">View Leave Of Employee</a>
			</div>
		</div>
	</div>



@endsection
