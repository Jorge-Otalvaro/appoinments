<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\DetailsAppointment;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Interfaces\ScheduleServiceInterface;
use Carbon\Carbon;
use Validator;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	if (auth()->user()->role == 'admin') {
    		
    		$result = Appointment::all();

    	}if (auth()->user()->role == 'doctor') {

    		$result = Appointment::where('doctor_id', auth()->id())->get();

    	} else {

    		$result = Appointment::where('patient_id', auth()->id())->get();
    	}	

        return view('master/appointments/index', [            
            'title' => 'Mis citas',
            'subtitle' => 'Mis citas',
            'results' => $result
        ]);
    }

    public function create(ScheduleServiceInterface $scheduleService)
    {
        $specialtyId = old('speciality_id');

        if ($specialtyId) {
            $specialty = Speciality::find($specialtyId);
            $doctors = $specialty->users;
        } else{
            $doctors = collect();
        }

        $date         = old('schedule_date');
        $doctorId     = old('doctor_id');

        if ($date && $doctorId) {
            $intervals = $scheduleService->getAvailableIntervals($date, $doctorId);
        }else{
            $intervals = null;
        }

        return view('master/appointments/create', [            
            'title' => 'Reserva de citas',
            'subtitle' => 'Registrar nueva cita',
            'doctors' => $doctors,
            'specialties' => Speciality::all(),
            'intervals' => $intervals
        ]);
    }

    public function store(Request $request, Appointment $appointment, ScheduleServiceInterface $scheduleService)
    {       
        $rules = [
            'speciality_id'      => 'required|exists:specialities,id',
            'doctor_id'         => 'required|exists:users,id',
            'schedule_date'     => 'required',
            'schedule_time'     => 'required',
            'type'              => 'required',
            'description'       => 'min:6'
        ];

        $validator = Validator::make($request->all(), $rules);
        
        $validator->after(function ($validator) use ($request, $scheduleService) 
        {
            $date           = $request->input('schedule_date');
            $doctorId       = $request->input('doctor_id');
            $schedule_time  = $request->input('schedule_time');

            if ($date && $doctorId && $schedule_time) {
                $start = new Carbon($schedule_time);                
            }else{
                return;
            }

            if (!$scheduleService->isAvailableInterval($date, $doctorId, $start)) 
            {
                $validator->errors()->add('available_time', 'La hora seleccionada ya se encuentra reservada.');
            }
        });

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->only([
            'speciality_id', 
            'doctor_id',              
            'schedule_date', 
            'schedule_time', 
            'type', 
            'description'
        ]);

        $data['patient_id'] = auth()->id();

        $carbonTime = Carbon::createFromFormat('g:i A', $data['schedule_time']);
        $data['schedule_time'] = $carbonTime->format('H:i:s');

        Appointment::create($data);

        toast('Cita reservada','success','top-right');

        return redirect('appointments');
    }

    public function showCancelForm(Appointment $appointment)
    {
    	if ($appointment->patient_id ==  auth()->id()) {

    		if ($appointment->status == 'Confirmada')
	    	{
	    		return view('appointments.cancel', compact('appointment'));
	    	}	
    	}    	

    	toast('Lo siento la cita que intentas acceder, no existe','error','top-right');

    	return redirect('appointments');
    }

    public function cancel(Request $request, Appointment $appointment)
    {
    	if ($request->has('justification')) 
    	{
    		$cancellation = new DetailsAppointment();
    		$cancellation->justification = $request->input('justification');
    		$cancellation->cancelled_by = auth()->id();

    		$appointment->details()->save($cancellation);
    	}

        $appointment->status = 'Cancelada';
        $appointment->save();

        toast('Cita cancelada','success','top-right');

        return redirect('appointments');
    }

    public function confirm(Request $request, Appointment $appointment)
    {
        $appointment->status = 'Confirmada';
        $appointment->save();

        toast('Cita confirmada','success','top-right');

        return redirect('appointments');
    }
}
