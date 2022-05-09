<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ScheduleController;

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
	Route::resource('schedules', ScheduleController::class);
});

Route::middleware(['auth', 'patient'])->group(function () {
	// Gestion de citas 
	Route::resource('appointments', AppointmentController::class);
});





require __DIR__.'/admin.php';
