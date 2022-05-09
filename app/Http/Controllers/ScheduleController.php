<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkDay;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$days = [
            'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'
        ];

        $workDays = WorkDay::where('user_id', auth()->id())->get();

        if(count($workDays) > 0){

            $workDays->map(function ($workDay)
            {  
                $workDay->morning_start    = (new Carbon($workDay->morning_start))->format('g:i A');
                $workDay->morning_end      = (new Carbon($workDay->morning_end))->format('g:i A');
                $workDay->afternoon_start  = (new Carbon($workDay->afternoon_start))->format('g:i A');
                $workDay->afternoon_end    = (new Carbon($workDay->afternoon_end))->format('g:i A');

                return $workDay;
            });

        } else{
            $workDays = collect();
            
            for ($i=0; $i<7; ++$i)
                $workDays->push(new WorkDay());
        }    

        return view('master/schedules/index', [            
            'title' => 'Gestión de horario',
            'subtitle' => 'Lista de especialidades',
            'days' => $days,
            'results' => $workDays
        ]);
    }

    public function store(Request $request, WorkDay $workday)
    {
    	$active          = $request->input('active') ?: [];
        $morning_start   = $request->input('morning_start');
        $morning_end     = $request->input('morning_end');
        $afternoon_start = $request->input('afternoon_start');
        $afternoon_end   = $request->input('afternoon_end');


        $errors = [];

        $days = [
            'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'
        ];

        for($i=0; $i<7; ++$i){

            if($morning_start[$i] > $morning_end[$i]){
                $errors [] = "Las horas del turno mañana son inconsistentes para el dia $days[$i].";
            }

            if($afternoon_start[$i] > $afternoon_end[$i]){
                $errors [] = "Las horas del turno tarde son inconsistentes para el dia $days[$i].";
            }

            WorkDay::updateOrCreate(
                [
                    'day'               => $i, 
                    'user_id'           => auth()->id()
                ], [
                    'active'            => in_array($i, $active), 

                    'morning_start'     => $morning_start[$i], 
                    'morning_end'       => $morning_end[$i], 

                    'afternoon_start'   => $afternoon_start[$i], 
                    'afternoon_end'     => $afternoon_end[$i]
                ]
            );
        }

        if(count($errors) > 0)
            return back()->with(compact('errors')); 

        toast('Registro actualizado','success','top-right');

        return redirect('schedules');
    }
}
