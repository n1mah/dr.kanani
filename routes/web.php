<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FinancialTransactionController;
use App\Http\Controllers\ImageController;
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
    Route::get('/',[DashboardController::class,"index"])->name("dashboard");

    Route::get('/patients',[PatientController::class,"index"])->name("patients");
    Route::get('/patients/inactive',[PatientController::class,"index_inactive"])->name("patients.inactive");
    Route::get('/patients/create',[PatientController::class,"create"])->name("patient.addForm");
    Route::post('/patients',[PatientController::class,"store"])->name("patient.store");
    Route::get('/patients/{patient}',[PatientController::class,"show"])->name("patient.show");
    Route::get('/patients/{patient}/edit',[PatientController::class,"edit"])->name("patient.editForm");
    Route::put('/patients/{patient}',[PatientController::class,"update"])->name("patient.update");
    Route::delete('/patients/{patient}',[PatientController::class,"destroy"])->name("patient.delete");
    Route::post('/patients/{patient}/active',[PatientController::class,"active"])->name("patient.active");
    Route::get('/patients/{patient}/appointments',[PatientController::class,"show_appointments"])->name("patient.appointments");
    Route::get('/patients/{patient}/prescriptions',[PatientController::class,"show_prescriptions"])->name("patient.prescriptions");
    Route::get('/patients/{patient}/reports',[PatientController::class,"show_reports"])->name("patient.reports");
    Route::post('/patients/search',[PatientController::class,"search"])->name("patients.search");


    Route::get('/insurances',[InsuranceController::class,"index"])->name("insurances");
    Route::get('/insurances/inactive',[InsuranceController::class,"index_inactive"])->name("insurances.inactive");
    Route::get('/insurances/create',[InsuranceController::class,"create"])->name("insurance.addForm");
    Route::post('/insurances',[InsuranceController::class,"store"])->name("insurance.store");
    Route::get('/insurances/{insurance}',[InsuranceController::class,"show"])->name("insurance.show");
    Route::get('/insurances/{insurance}/edit',[InsuranceController::class,"edit"])->name("insurance.editForm");
    Route::put('/insurances/{insurance}',[InsuranceController::class,"update"])->name("insurance.update");
    Route::delete('/insurances/{insurance}',[InsuranceController::class,"destroy"])->name("insurance.delete");
    Route::post('/insurances/search',[InsuranceController::class,"search"])->name("insurances.search");

    Route::get('/appointments',[AppointmentController::class,"index"])->name("appointments");
    Route::get('/appointments/create',[AppointmentController::class,"create"])->name("appointment.addForm");
    Route::post('/appointments',[AppointmentController::class,"store"])->name("appointment.store");
    Route::get('/appointments/{appointment}',[AppointmentController::class,"show"])->name("appointment.show");
    Route::get('/appointments/{appointment}/edit',[AppointmentController::class,"edit"])->name("appointment.editForm");
    Route::put('/appointments/{appointment}',[AppointmentController::class,"update"])->name("appointment.update");
    Route::delete('/appointments/{appointment}',[AppointmentController::class,"destroy"])->name("appointment.delete");
    Route::get('/appointments/{appointment}/prescriptions',[AppointmentController::class,"show_prescriptions"])->name("appointment.prescriptions");
    Route::get('/appointments/{appointment}/success',[AppointmentController::class,"success"])->name("appointment.success");
    Route::put('/appointments/{appointment}/success',[AppointmentController::class,"success_save"])->name("appointment.success.save");
    Route::put('/appointments/{appointment}/cancel',[AppointmentController::class,"cancel"])->name("appointment.cancel");
    Route::get('/appointment/today_list',[AppointmentController::class,"today"])->name("appointments.today");
    Route::get('/appointment/tomorrow_list',[AppointmentController::class,"tomorrow"])->name("appointments.tomorrow");
    Route::get('/appointment/week_list',[AppointmentController::class,"week"])->name("appointments.week");
    Route::get('/appointment/month_list',[AppointmentController::class,"month"])->name("appointments.month");
    Route::get('/appointment/period_30_list',[AppointmentController::class,"period30"])->name("appointments.period30");
    Route::get('/appointment/before_30day_list',[AppointmentController::class,"before30Day"])->name("appointments.before30Day");
    Route::get('/appointments/canceled/list',[AppointmentController::class,"canceled"])->name("appointments.canceled");
    Route::get('/appointments/succeed/list',[AppointmentController::class,"succeed"])->name("appointments.succeed");
    Route::get('/appointments/initial_status/list',[AppointmentController::class,"initial_status"])->name("appointments.initial_status");


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
    Route::get('/prescriptions/{prescription}/reports',[PrescriptionController::class,"show_reports"])->name("prescription.reports");
    Route::get('/prescriptions/{prescription}/edit-image',[PrescriptionController::class,"edit_image"])->name("prescription.image");
    Route::delete('/prescriptions/{prescription}/image/{image}',[PrescriptionController::class,"delete_image"])->name("prescription.image.delete");


    Route::get('/reports',[ReportController::class,"index"])->name("reports");
    Route::get('/reports/{report}',[ReportController::class,"show"])->name("report.show");
    Route::get('/report/create',[ReportController::class,"create"])->name("report.addForm");
    Route::post('/reports',[ReportController::class,"store"])->name("report.store");
    Route::get('/reports/create/{patient}/{report}',[ReportController::class,"create2"])->name("report.addForm2");
    Route::post('/reports/{report}/prescription',[ReportController::class,"update_prescription"])->name("report.store_prescription");
    Route::get('/reports/{report}/edit-special',[ReportController::class,"edit_special"])->name("report.edit_special");
    Route::get('/reports/{report}/edit',[ReportController::class,"edit"])->name("report.editForm");
    Route::put('/reports/{report}',[ReportController::class,"update"])->name("report.update");
    Route::delete('/reports/{report}',[ReportController::class,"destroy"])->name("report.delete");
    Route::get('/reports/{report}/edit-image',[ReportController::class,"edit_image"])->name("report.image");
    Route::delete('/reports/image/{reportImage}',[ReportController::class,"delete_image"])->name("report.image.delete");
    Route::post('/reports/{report}/image',[ReportController::class,"store_image"])->name("report.image.store");


    Route::get('/financial_transactions',[FinancialTransactionController::class,"index"])->name("financials");
    Route::get('/financial_transactions/inactive',[FinancialTransactionController::class,"index_inactive"])->name("financials.inactive");
    Route::get('/financial_transactions/all',[FinancialTransactionController::class,"index_all"])->name("financials.all");
    Route::post('/financial_transactions/search',[FinancialTransactionController::class,"search"])->name("financials.search");
    Route::get('/financial_transactions/create',[FinancialTransactionController::class,"create"])->name("financial.addForm");
    Route::post('/financial_transactions',[FinancialTransactionController::class,"store"])->name("financial.store");
    Route::get('/financial_transactions/{financial_transaction}',[FinancialTransactionController::class,"show"])->name("financial.show");
    Route::get('/financial_transactions/{financial_transaction}/edit',[FinancialTransactionController::class,"edit"])->name("financial.editForm");
    Route::put('/financial_transactions/{financial_transaction}',[FinancialTransactionController::class,"update"])->name("financial.update");
    Route::delete('/financial_transactions/{financial_transaction}',[FinancialTransactionController::class,"destroy"])->name("financial.delete");
    Route::get('/financial_transactions/{patient}/patient',[FinancialTransactionController::class,"index_patient"])->name("financials.patient");
    Route::get('/financial_transactions/today/list',[FinancialTransactionController::class,"today"])->name("financials.today");
    Route::get('/financial_transactions/Last_7_Days/list',[FinancialTransactionController::class,"last_7day"])->name("financials.last_7day");
    Route::get('/financial_transactions/ordered/list',[FinancialTransactionController::class,"index_ordered_time"])->name("financials.ordered");
    Route::get('/financial_transactions/Last_30_Days/list',[FinancialTransactionController::class,"last_30day"])->name("financials.last_30day");
    Route::get('/financial_transactions/{appointment}/appointment',[FinancialTransactionController::class,"index_appointment"])->name("financials.appointment");

});
