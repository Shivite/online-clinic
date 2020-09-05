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
Route::get('/email', function () {
    return view('layouts.email.prescriptionEmailTemplate');
});
Route::get('registerpatient', 'Patient\PatientController@index')->name('registerpatient');
Route::post('/registration/register/patient', 'Patient\PatientController@postResiterPatient')->name('patient.registration');
Route::get('/registration/department', 'Patient\PatientController@registerDepartment')->name('patient.department');
Route::post('/registration/patient/department', 'Patient\PatientController@postregisterDepartment')->name('register-department');
Route::post('/registration/patient/reports', 'Patient\PatientController@postRegisterReports')->name('register.reports');
Route::get('/registration/reports', 'Patient\PatientController@registerReports')->name('patient.reports');
Route::get('/registration/appointment', 'Patient\PatientController@registerAppointment')->name('patient.appintment');
/* tesing route appointment */

// Route::get('/registration/appointment/test', function(){
//         return view('layouts.patient.registerappintmentTest');;
// });

Route::post('/registration/patient/timeslots', 'Patient\PatientController@postRegisterGetAppointmentTimeSlots')->name('register.appointment.timeslots');

/* tesitn route appintment end */
Route::post('/registration/patient/appointment', 'Patient\PatientController@postRegisterAppointment')->name('post.register.appointment');
Route::post('/registration/payment/Complete', 'Patient\PatientController@razorPaymentComplete')->name('patient.payment');
Route::get('/registration/complete', 'Patient\PatientController@registerComplete')->name('payment.success');
Route::get('/registration/failure', 'Patient\PatientController@registerFailure')->name('payment.fail');
Route::post('/patient/remove-image', 'Patient\PatientController@removeImage');
Auth::routes(['verify' => true ]);

Route::get('patient/profile', 'Patient\PatientController@profile')->name('patient.profile')->middleware('verified');
Route::get('patient/new/appointment', 'Patient\PatientController@getPatientNewAppointment')->name('get.patient.new.appointment')->middleware('verified');

Route::get('admin/dashboard', 'Admin\AdminController@index')->name('dashboard')->middleware('verified');
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('verified')->group(function(){
  Route::resource('/users', 'UserController');
  Route::get('/patient/payments', 'PatientController@patientPayments')->name('patient.payments');;
  Route::get('/department/fee', 'AdminController@departmentFee')->name('department.fee');;
  Route::post('/department/fee', 'AdminController@departmentFeeUpdate')->name('fee.update');;
  Route::put('/user/updatepassword', 'UserController@updatepassword')->name('user.updatepassword');
  Route::resource('/patient', 'PatientController');
  Route::put('/patient/analysis-1/{patient}', 'PatientController@analysisFirst')->name('patient.analysis.first');;
  Route::put('/patient/analysis-2/{patient}', 'PatientController@analysisSecond')->name('patient.analysis.second');;
  Route::put('/pat  ient/analysis-3/{patient}', 'PatientController@analysisThird')->name('patient.analysis.third');;
  Route::put('/patient/analysis-4/{patient}', 'PatientController@analysisFourth')->name('patient.analysis.fourth');;
  Route::put('/patient/analysis-5/{patient}', 'PatientController@analysisFifth')->name('patient.analysis.fifth');;
  Route::put('/patient/analysis-6/{patient}', 'PatientController@analysisSixth')->name('patient.analysis.sixth');;
  Route::put('/patient/analysis-7/{patient}', 'PatientController@analysisSeventh')->name('patient.analysis.seventh');;
  Route::put('/patient/analysis-8/{patient}', 'PatientController@analysisEight')->name('patient.analysis.eight');;
  Route::post('/patient/newsymptoms', 'PatientController@newSymptoms')->name('patient.new.symptoms');
  Route::get('/appointments', 'AdminController@appointments')->name('appointments');
  Route::get('/admin/reappointment/{appointment}', 'AdminController@reappointment')->name('reappointment');
  Route::post('/admin/get/timeslots/', 'AdminController@getTimeSlot')->name('get.timeslot');
 
  Route::get('/patient/oncology/patients', 'AdminController@oncologyPatient')->name('patient.oncologyPatients');;
  Route::post('/admin/reschedule/', 'AdminController@reScheduleAppointment')->name('reschedule.appointment');
  Route::get('/admin/requested/transfered', 'AdminController@requestedTransfer')->name('patient.transferrequest');
  Route::get('/admin/appoint/alopathy/doctor/{patient}', 'AdminController@getAppointAlopathyDoctor')->name('patient.appoint.alopathy.doctor');
  Route::post('/admin/approve/deparment/{patient}', 'AdminController@postApproveDepartment')->name('approve.deptchange');
});
Route::get('doctor/profile', 'Doctor\DoctorController@profile')->name('doctor.profile')->middleware('verified');

Route::namespace('Doctor')->middleware('verified')->group(function(){
  Route::resource('/doctor', 'DoctorController');
  Route::get('/doctor/patients/list', 'DoctorController@patientList')->name('doctor.patientslist');
  Route::get('/doctor/analysis/desk', 'DoctorController@analysisDesk')->name('doctor.analysisDesk');
  Route::get('/doctor/appointment', 'DoctorController@')->name('doctor.appointment');
  Route::get('/doctor/patient/profile/{patientId}', 'DoctorController@patientProfile')->name('doctor.patient.profile');
  Route::get('/doctor/visit/report', 'DoctorController@visitReport')->name('doctor.visitReport');
  Route::put('doctor/appointment/reschedule/{appointment}','DoctorController@rescheduleAppointment')->name('doctor.appointment.reschedule');
  Route::post('/doctor/patient/newprescription','DoctorController@patientNewPrescriptionStore')->name('doctor.patient.prescription');
  Route::put('doctor/appointment/complete/{appointment}','DoctorController@appointmentComplete')->name('doctor.appointment.complete');
  Route::post('doctor/patient/searchId','DoctorController@searchWithId')->name('doctor.patientsearchid');
  Route::post('doctor/patient/changedepartment/{patient}','DoctorController@changeDepartment')->name('doctor.change.department');
  
  Route::get('/video', function () {
    return view('layouts.admin.doctor.video');
});
});