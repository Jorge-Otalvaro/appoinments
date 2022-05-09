<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Api\JsonScheduleController;
use App\Http\Controllers\Api\JsonSpecialtyController;


Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);
    return ['token' => $token->plainTextToken];
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth', 'doctor'])->group(function () {
	// Gestion de Horarios 
	Route::resource('schedules', ScheduleController::class)->only([
		'index', 'store'
	]);
});

Route::middleware(['auth'])->group(function () {
	// Gestion de citas 
	Route::resource('appointments', AppointmentController::class);
});

Route::middleware('auth')->group(function () {
	//CANCELAR CITA 
	Route::get('appointments/{appointment}/cancel', [AppointmentController::class, 'showCancelForm'])
	->name('appointments.showCancel');
	
	Route::post('appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])
	->name('appointments.cancel');

	// CONFIRMAR CITA
	Route::post('appointments/{appointment}/confirm', [AppointmentController::class, 'confirm'])
	->name('appointments.confirm');

	// JSON
	Route::get('specialties/{specialty}/doctors', [JsonSpecialtyController::class, 'doctors']);

	Route::get('schedules/hours', [JsonScheduleController::class, 'hours']);

	Route::get('appointment/info', [JsonScheduleController::class, 'info']);
});	

require __DIR__.'/admin.php';
