<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\HomeController;

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'admin'])->group(function () {

	Route::resource('specialities', SpecialityController::class);

	Route::resource('doctors', DoctorController::class);

	Route::resource('patients', PatientController::class);
});

