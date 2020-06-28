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
Route::post('/registration/create-step1', 'Patient\PatientController@postCreateStep1');
Route::get('/registration/create-step2', 'Patient\PatientController@createStep2');
Route::post('/registration/create-step2', 'Patient\PatientController@postCreateStep2');
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
