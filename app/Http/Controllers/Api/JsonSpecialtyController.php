<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Speciality;

class JsonSpecialtyController extends Controller
{
    public function doctors(Speciality $specialty)
    {
        return $specialty->users()->get([
        	'users.id',
        	'users.name'
        ]);
    }
}
