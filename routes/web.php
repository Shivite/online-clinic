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
    return view('layouts.frontend.index');
});
Route::get('registerpatient', 'Patient\PatientController@index')->name('registerpatient');
Route::post('/registration/register/patient', 'Patient\PatientController@postResiterPatient')->name('patient.registration');
Route::get('/registration/department', 'Patient\PatientController@registerDepartment')->name('patient.department');
Route::post('/registration/patient/department', 'Patient\PatientController@postregisterDepartment')->name('register-department');
Route::post('/registration/patient/reports', 'Patient\PatientController@postRegisterReports')->name('register.reports');
Route::get('/registration/reports', 'Patient\PatientController@registerReports')->name('patient.reports');
Route::get('/registration/appointment', 'Patient\PatientController@registerAppointment')->name('patient.appintment');
Route::post('/registration/patient/appointment', 'Patient\PatientController@postRegisterAppointment')->name('register.appointment');
Route::get('/registration/payment', 'Patient\PatientController@registerPayment')->name('patient.payment');
Route::post('/patient/remove-image', 'Patient\PatientController@removeImage');
Auth::routes(['verify' => true ]);

// Route::resource('admin', 'Admin\AdminController');

Route::get('admin/dashboard', 'Admin\AdminController@index')->name('dashboard')->middleware('verified');
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
  Route::resource('/users', 'UserController');
  Route::put('/user/updatepassword', 'UserController@updatepassword')->name('user.updatepassword');
});
Route::get('doctor/profile', 'Doctor\DoctorController@profile')->name('doctor.profile')->middleware('verified');
Route::namespace('Doctor')->group(function(){
  Route::resource('/doctor', 'DoctorController');

});
