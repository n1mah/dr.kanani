<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\ReportController;
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
    Route::get('/patients/{patient}/appointments',[PatientController::class,"show_appointments"])->name("patient.appointments");
    Route::get('/patients/{patient}/prescriptions',[PatientController::class,"show_prescriptions"])->name("patient.prescriptions");


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
    Route::get('/appointments/{appointment}/prescriptions',[AppointmentController::class,"show_prescriptions"])->name("appointment.prescriptions");


    Route::get('/prescriptions',[PrescriptionController::class,"index"])->name("prescriptions");
    Route::get('/prescriptions/create/level1',[PrescriptionController::class,"create"])->name("prescription.addForm1");//select patient
    Route::post('/prescriptions/create/level2',[PrescriptionController::class,"create2"])->name("prescription.addForm2");//get patient//select appointment
    Route::get('/prescriptions/create/level2',[PrescriptionController::class,"create2_error"]);//back to level 1 with error level 2
    Route::post('/prescriptions/create/level3/{patient}',[PrescriptionController::class,"store"])->name("prescription.store");//get Patient model & appointment ->create Prescription
    Route::post('/prescriptions/update/prescription/{prescription}',[PrescriptionController::class,"update"])->name("prescription.update");//get Patient model & appointment
    Route::post('/prescriptions/prescription/{prescription}/edit',[PrescriptionController::class,"edit"])->name("prescription.editForm");//get Patient model & appointment
    Route::get('/prescriptions/{prescription}',[PrescriptionController::class,"show"])->name("prescription.show");
    Route::get('/prescriptions/{prescription}/edit-special',[PrescriptionController::class,"edit_special"])->name("prescription.edit_special");
    Route::get('/prescriptions/{prescription}/edit-special-1',[PrescriptionController::class,"edit_special_1"])->name("prescription.edit_special_1");
    Route::get('/prescriptions/{prescription}/edit-special-2',[PrescriptionController::class,"edit_special_2"])->name("prescription.edit_special_2");
    Route::post('/prescriptions/{prescription}/edit-special-2/{patient_id}',[PrescriptionController::class,"edit_special_2_process"])->name("prescription.update_special_2");//get patient//select appointment
    Route::get('/prescriptions/{prescription}/edit-special-3',[PrescriptionController::class,"edit_special_3"])->name("prescription.edit_special_3");
    Route::post('/prescriptions/{prescription}/edit-special-3',[PrescriptionController::class,"edit_special_3_process"])->name("prescription.update_special_3");
    Route::delete('/prescriptions/{prescription}',[PrescriptionController::class,"destroy"])->name("prescription.delete");

    Route::get('/reports',[ReportController::class,"index"])->name("reports");

});
