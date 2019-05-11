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
	Route::get('/', function () {
	return view('auth.login');
	});
/*
added by saroj
*/
	/* 
	---------------------------------------------------
	------------Authentication Routes------------------
	---------------------------------------------------
	*/
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('login', 'Auth\LoginController@login');
	Route::post('logout', 'Auth\LoginController@logout')->name('logout');
	/* 
	---------------------------------------------------
	------------Password Reset Routes------------------
	---------------------------------------------------
	*/
	Route::get('reset_password', 'ForgotPasswordController@index')->name('reset_password');
	Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
	Route::post('password/reset', 'Auth\ResetPasswordController@reset');
	
	/* 
	---------------------------------------------------
	------------employee dashboard routes------------------
	---------------------------------------------------
	*/
	Route::group(['prefix' => 'employee_dashboard','middleware' => 'employee'], function(){
	Route::get('/', function () {
	return view('employee.dashboard');
	});
	Route::get('/', 'Employee\EmployeeController@index')->name('employee_dashboard');
	Route::post('/checkin', 'Employee\EmployeeController@EmployeeCheckinStore')->name('checkin');
	Route::post('/', 'Employee\EmployeeController@EmployeeOfficeCheckout');
	Route::post('/break_checkin', 'Employee\EmployeeBreakController@EmployeeBreakCheckin');
	Route::post('/break_checkout', 'Employee\EmployeeBreakController@EmployeeBreakCheckout');

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
