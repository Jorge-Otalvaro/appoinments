<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\SpecialityController;

Route::resource('specialities', SpecialityController::class);