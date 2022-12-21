<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\User\PaymentController;


Route::get('/clear-cache', function() {
	Artisan::call('cache:clear');
	Artisan::call('optimize:clear');
	echo 'cleared';
});
Route::get('/clear-optimize', function() {
	Artisan::call('optimize:clear');
	echo 'cleared';
});



Route::get('/', function () {
    return redirect('login');
});

//registrationInstructionRoutes
Route::group(['namespace' => 'App\Http\Controllers\Auth'], function () {
	Route::get('/registrationInstructions', 'RegisterController@registrationInstructions')->name('registrationInstructions');
	Route::get('/loginInstructions/{id?}', 'LoginController@loginInstructions')->name('loginInstructions');
});

Route::group(['namespace' => 'App\Http\Controllers\Instructions'], function () {
	Route::get('/instructions-downloadFile/{fileName}', 'InstructionsController@downloadFile')->name('instructions.downloadFile');
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

	Route::resource('qualification', 'QualificationController');
	Route::post('qualification/destroy','QualificationController@massDestroy')->name('qualification.massDestroy');
	Route::post('qualification/checkQualificationExists','QualificationController@checkQualification')->name('qualification.checkQualification');
	
	Route::resource('experience', 'ExperienceController');
	Route::post('experience/destroy','ExperienceController@massDestroy')->name('experience.massDestroy');
	Route::post('experience/checkExperienceExists','ExperienceController@checkExperience')->name('experience.checkExperience');


	Route::resource('postavailable', 'PostAvailableController');
	Route::post('checkEligibility/{id}', 'PostAvailableController@checkJobAvailability')->name('postavailable.checkJob');
	Route::post('applyJob/{id}', 'PostAvailableController@applyJob')->name('postavailable.applyJob');
	Route::post('checkPostAvailable', 'PostAvailableController@checkPostAvailable')->name('postavailable.checkPostAvailable');
	Route::get('applyJob/testfunction', 'PostAvailableController@testFunction')->name('postavailable.test');
	
	Route::resource('preview', 'PreviewController');
	
	Route::resource('declaration', 'DeclarationController');

	
	//
	Route::get('/session', 'SessionController@index')->name('session.index');
	Route::get('/sessionApply/{id}', 'SessionController@sessionApply')->name('session.apply');
	Route::post('/unlockProfile', 'SessionController@unlockProfile')->name('session.unlock');
	//
	Route::resource('payment', 'PaymentController');
	Route::post('/payment/form/{data}', 'PaymentController@form')->name('payment.form');
	Route::post('/payment/totalfees', 'PaymentController@totalFees')->name('payment.totalfees');	
	Route::post('/payment/unlockProfile', 'PaymentController@unlockProfile')->name('payment.unlockProfile');	
	
	//
	Route::get('/document', 'DocumentUploadController@index')->name('document.index');
	Route::post('/documentUpload/{document}', 'DocumentUploadController@upload')->name('document.upload');
	Route::post('/documentUpload/processCompleted', 'DocumentUploadController@processCompleted')->name('document.processCompleted');

	Route::get('/appliedJobPayment', 'AppliedJobPaymentController@index')->name('appliedJobPayment.index');
	Route::get('/paymentReceipt/{payment_id}/{job_id}', 'AppliedJobPaymentController@paymentReceipt')->name('appliedJobPayment.paymentReceipt');
	Route::get('/applicationReport/{payment_id}/{job_id}', 'AppliedJobPaymentController@applicationReport')->name('appliedJobPayment.applicationReport');
});


Route::post('/getLocation', 'App\Http\Controllers\Location\LocationController@index')->name('location.index');
Route::get('/getState', 'App\Http\Controllers\Location\LocationController@getState')->name('location.getState');
Route::get('/getDistrict', 'App\Http\Controllers\Location\LocationController@getDistrict')->name('location.getDistrict');

Route::get('/services/{qualificationtype}', 'App\Http\Controllers\Service\ServiceController@getQualificationName')->name('services.getQualificationName');
Route::get('/university/{id}', 'App\Http\Controllers\Service\ServiceController@getUniversity')->name('services.getUniversityName');
Route::get('/subject/{id}', 'App\Http\Controllers\Service\ServiceController@getSubject')->name('services.getSubject');



Route::get('/contact', function () {
    return view('contact');
});


