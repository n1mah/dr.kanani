<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $user = \App\Models\Patient::first();
    foreach ($user->prescriptions->all() as $a)
        echo ($a->appointment_id." ".$a->reason."<br>");

    echo ("<br>");
    echo ("<br>");
    foreach ($user->appointments->all() as $a)
        echo ($a->id." ".$a->type."<br>");

    echo ("<br>");
    echo ("<br>");
    foreach ($user->prescriptions->all() as $c)
    echo ($c->appointment->id ." ".$c->appointment->type."<br>");

    echo ("<br>");
    echo ("<br>");


});

Route::group(['prefix' => 'panel'],function (){
    Route::view("/","admin.home")->name("dashboard");

    Route::get('/patients',[PatientController::class,"index"])->name("patients");
    Route::get('/patients/create',[PatientController::class,"create"])->name("patient.addForm");
    Route::post('/patients',[PatientController::class,"store"])->name("patient.store");
    Route::get('/patients/{patient}',[PatientController::class,"show"])->name("patient.show");
    Route::get('/patients/{patient}/edit',[PatientController::class,"edit"])->name("patient.editForm");
    Route::put('/patients/{patient}',[PatientController::class,"update"])->name("patient.update");
    Route::delete('/patients/{patient}',[PatientController::class,"destroy"])->name("patient.delete");


    Route::get('/insurances',[InsuranceController::class,"index"])->name("insurances");
    Route::get('/insurances/create',[InsuranceController::class,"create"])->name("insurance.addForm");
    Route::post('/insurances',[InsuranceController::class,"store"])->name("insurance.store");
    Route::get('/insurances/{insurance}',[InsuranceController::class,"show"])->name("insurance.show");
    Route::get('/insurances/{insurance}/edit',[InsuranceController::class,"edit"])->name("insurance.editForm");
    Route::put('/insurances/{insurance}',[InsuranceController::class,"update"])->name("insurance.update");
    Route::delete('/insurances/{insurance}',[InsuranceController::class,"destroy"])->name("insurance.delete");

    Route::get('/appointments',[AppointmentController::class,"index"])->name("appointments");
    Route::get('/appointments/create',[AppointmentController::class,"create"])->name("appointment.addForm");
    Route::post('/appointments',[AppointmentController::class,"store"])->name("appointment.store");
    Route::get('/appointments/{appointment}',[AppointmentController::class,"show"])->name("appointment.show");
    Route::get('/appointments/{appointment}/edit',[AppointmentController::class,"edit"])->name("appointment.editForm");
    Route::put('/appointments/{appointment}',[AppointmentController::class,"update"])->name("appointment.update");
    Route::delete('/appointments/{appointment}',[AppointmentController::class,"destroy"])->name("appointment.delete");

});
