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
		Route::get('/leaves', 'Employee\LeaveController@index');
		Route::post('/leaves', 'Employee\LeaveController@store');
		Route::get('/attendance-history', 'Employee\EmployeeController@history');
		Route::get('/leave-history', 'Employee\LeaveController@history');
		Route::get('/breaks-history', 'Employee\EmployeeBreakController@history');
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
	Route::get('/admin', 'UsersController@admin'); 
	Route::get('/employee', 'UsersController@employee'); 
	Route::get('status_change/{id}', 'UsersController@ChangeStatus')->name('status_change');
	Route::get('/attendance-history/{id}', 'Employee\EmployeeController@adminHistory');
	Route::get('/leave-history/{id}', 'Employee\LeaveController@adminHistory');
	Route::get('/breaks-history/{id}', 'Employee\EmployeeBreakController@adminHistory');
	Route::get('/performance/{id}', 'PerformanceController@index');
	/* 
	---------------------------------------------------
	------------Employee manage------------------
	---------------------------------------------------
	*/
	});
	
 
	Route::get('/home', 'HomeController@index')->name('home');
	// manage mail with mailtrap
	Route::get('send-mail','HomeController@manageMail');
	Route::post('send-mail/email', 'HomeController@send');
