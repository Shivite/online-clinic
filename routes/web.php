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
/* --------------------------genrate storage symlink -----------*/
// Route::get('/storage', function(){
//     \Artisan::call('storage:link');
//     return "Se han vinculado las imágenes";
// });
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
Route::post('/registration/payment/Complete', 'Patient\PatientController@razorPaymentComplete')->name('patient.payment');
Route::get('/registration/complete', 'Patient\PatientController@registerComplete')->name('payment.success');
Route::get('/registration/failure', 'Patient\PatientController@registerFailure')->name('payment.fail');
Route::post('/patient/remove-image', 'Patient\PatientController@removeImage');
Auth::routes(['verify' => true ]);

Route::get('patient/profile', 'Patient\PatientController@profile')->name('patient.profile')->middleware('verified');

Route::get('admin/dashboard', 'Admin\AdminController@index')->name('dashboard')->middleware('verified');
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
  Route::resource('/users', 'UserController');
  Route::put('/user/updatepassword', 'UserController@updatepassword')->name('user.updatepassword');
  Route::resource('/patient', 'PatientController');
  Route::put('/patient/analysis-1/{patient}', 'PatientController@analysisFirst')->name('patient.analysis.first');;
  Route::put('/patient/analysis-2/{patient}', 'PatientController@analysisSecond')->name('patient.analysis.second');;
  Route::put('/patient/analysis-3/{patient}', 'PatientController@analysisThird')->name('patient.analysis.third');;
  Route::put('/patient/analysis-4/{patient}', 'PatientController@analysisFourth')->name('patient.analysis.fourth');;
  Route::put('/patient/analysis-5/{patient}', 'PatientController@analysisFifth')->name('patient.analysis.fifth');;
  Route::put('/patient/analysis-6/{patient}', 'PatientController@analysisSixth')->name('patient.analysis.sixth');;
  Route::put('/patient/analysis-7/{patient}', 'PatientController@analysisSeventh')->name('patient.analysis.seventh');;
  Route::put('/patient/analysis-8/{patient}', 'PatientController@analysisEight')->name('patient.analysis.eight');;

});
Route::get('doctor/profile', 'Doctor\DoctorController@profile')->name('doctor.profile')->middleware('verified');
Route::namespace('Doctor')->group(function(){
  Route::resource('/doctor', 'DoctorController');

});
