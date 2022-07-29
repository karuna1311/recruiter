<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

Route::get('/', function () {
    return redirect('login');
});

//registrationInstructionRoutes
Route::group(['namespace' => 'App\Http\Controllers\Auth'], function () {
	Route::get('/registrationInstructions', 'RegisterController@registrationInstructions')->name('registrationInstructions');
	Route::get('/loginInstructions/{id?}', 'LoginController@loginInstructions')->name('loginInstructions');
});

//otp-routes
Route::group(['namespace' => 'App\Http\Controllers\Otp'], function () {
	Route::post('/sendOtp', 'OtpController@sendOtp')->name('otp.send');
	Route::post('/verifyOtp', 'OtpController@verifyOtp')->name('otp.verify');
});

Auth::routes();

//userdashboard-routes
Route::group(['namespace' => 'App\Http\Controllers\User','middleware' => ['auth','auth.gates']], function () {
	Route::get('/home', 'ApplicationStatusController@index')->name('applicationstatus.index');
	Route::resource('personalInfo', 'PersonalInformationController');
	Route::resource('reservation', 'ReservationController');
	Route::resource('inserviceQuota', 'InserviceQuotaController');
	Route::resource('collegeInfo', 'CollegeInformationController');
	Route::resource('medicalCouncil', 'MedicalCouncilController');

	Route::get('/securityDeposite', 'SecurityDepositeController@index')->name('securityDeposite.index');
	Route::post('/securityDeposite/{securityDeposite}', 'SecurityDepositeController@update')->name('securityDeposite.update');
	Route::post('/getSecurityDeposite', 'SecurityDepositeController@getSecurityDeposite')->name('securityDeposite.amount');

	Route::resource('preview', 'PreviewController');
	Route::resource('declaration', 'DeclarationController');
	//
	Route::get('/session', 'SessionController@index')->name('session.index');
	Route::get('/sessionApply/{id}', 'SessionController@sessionApply')->name('session.apply');
	Route::post('/unlockProfile', 'SessionController@unlockProfile')->name('session.unlock');
	//
	Route::get('/payment', 'PaymentController@index')->name('payment.index');
	Route::get('/paymentStore/{sessionId}', 'PaymentController@store')->name('payment.store');
	//
	Route::get('/document', 'DocumentUploadController@index')->name('document.index');
	Route::post('/documentUpload/{document}', 'DocumentUploadController@upload')->name('document.upload');

	Route::get('/appliedSessions', 'AppliedSessionController@index')->name('appliedSessions.index');
	Route::get('/paymentReceipt/{session}', 'AppliedSessionController@paymentReceipt')->name('appliedSessions.paymentReceipt');
	Route::get('/applicationReport/{sessionId}', 'AppliedSessionController@applicationReport')->name('appliedSessions.applicationReport');
});

Route::post('/paymentUpdate/{transaction}', 'App\Http\Controllers\User\PaymentController@update')->name('payment.update');
Route::post('/updatePushResponse', 'App\Http\Controllers\User\PaymentController@updatePushResponse')->name('payment.updatePushResponse');

Route::post('/getLocation', 'App\Http\Controllers\Location\LocationController@index')->name('location.index');
Route::get('/getCollegeList/{collegeType}', 'App\Http\Controllers\User\CollegeListController@index')->name('collegeList.index');


Route::get('/contact', function () {
    return view('contact');
});


