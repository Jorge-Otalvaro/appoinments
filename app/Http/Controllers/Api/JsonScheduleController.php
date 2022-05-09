<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class JsonScheduleController extends Controller
{
    public function hours(StoreRequest $request, ScheduleServiceInterface $scheduleservice)
    {
    	$date = $request->input('date');
    	$doctorId = $request->input('doctor_id');

        return $scheduleservice->getAvailableIntervals($date, $doctorId);
    }

    public function info(Request $request)
    {
    	if ($request->ajax()) {
    		$appointment = Appointment::findOrFail($request->appointment_id);

    		return response()->json([
    			'appointment' => $appointment
    		]);
    	}
    }
}
