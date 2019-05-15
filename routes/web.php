<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
	/* 
	---------------------------------------------------
	------------Routes For Auth------------------
	---------------------------------------------------
	*/
	Route::get('/', function () {
		return view('auth.login');
	});
	Auth::routes([
		'register' => false,
	]);
	/* 
	---------------------------------------------------
	------------employee dashboard routes------------------
	---------------------------------------------------
	*/
	Route::group(['prefix' => 'employee_dashboard','middleware' => 'employee'], function(){
		Route::get('/', 'Employee\EmployeeController@index')->name('employee_dashboard');
		Route::post('/checkin', 'Employee\EmployeeController@checkin');
		Route::post('/checkout', 'Employee\EmployeeController@checkout');
		Route::post('/break-checkout', 'Employee\EmployeeBreakController@breakCheckout');
		Route::post('/break-checkin', 'Employee\EmployeeBreakController@breakCheckin');
		// Route::post('/leaves', 'Employee\EmployeeBreakController@breakCheckin');
	});

	/* 
	---------------------------------------------------
	------------Authentication dashboard routes------------------
	---------------------------------------------------
	*/
	Route::group(['prefix' => 'administration','middleware' => ['auth', 'admin']], function(){
	Route::get('/dashboard', function () {
	return view('authentication.dashboard');
	});
	Route::resource('/users', 'UsersController'); 
	Route::post('/users/{id}', 'UsersController@update'); 
	
	Route::get('status_change/{id}', 'UsersController@ChangeStatus')->name('status_change');
	/* 
	---------------------------------------------------
	------------Employee manage------------------
	---------------------------------------------------
	*/
	Route::get('/employee', 'Authentication\EmployeeController@index');
	Route::get('/employee/{id}', 'Authentication\EmployeeController@employeeDetails');
	});
	
 
	Route::get('/home', 'HomeController@index')->name('home');
	// manage mail with mailtrap
	Route::get('send-mail','HomeController@manageMail');
	Route::post('send-mail/email', 'HomeController@send');
