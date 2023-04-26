<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::group(['prefix' => 'panel'],function (){
    Route::view("/","admin.home")->name("dashboard");

    Route::get('/patients',[PatientController::class,"index"])->name("patients");
    Route::get('/patients/create',[PatientController::class,"create"])->name("patient.addForm");
    Route::post('/patients',[PatientController::class,"store"])->name("patient.store");
    Route::get('/patients/{patient}',[PatientController::class,"show"])->name("patient.show");
    Route::get('/patients/patient/edit',[PatientController::class,"edit"])->name("patient.editForm");
    Route::put('/patients/patient',[PatientController::class,"update"])->name("patient.update");
    Route::delete('/patients/{patient}',[PatientController::class,"destroy"])->name("patient.delete");

});
