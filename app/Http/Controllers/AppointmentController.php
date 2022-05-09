<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\DetailsAppointment;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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

    public function create()
    {
        return view('master/appointments/create', [            
            'title' => 'Reserva de citas',
            'subtitle' => 'Registrar nueva cita',
            'doctors' => User::doctors()->get(),
            'specialties' => Speciality::all(),
            'intervals' => []
        ]);
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
