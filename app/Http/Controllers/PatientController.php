<?php

namespace App\Http\Controllers;

use App\Models\Speciality;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index()
    {
        $result = User::patients()->get();

        return view('master/patients/index', [            
            'title' => 'Pacientes',
            'subtitle' => 'Lista de pacientes',
            'results' => $result
        ]);
    }

    public function create()
    {
        return view('master/patients/create', [            
            'title' => 'Pacientes',
            'subtitle' => 'Crear paciente'
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $request->validated();

        $passwordNew = Str::random(10);

        $patient = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'document' => $request->document,
            'password' => Hash::make($passwordNew),
            'address' => $request->address,
            'phone' => $request->phone,
            'role' => 'patient'
        ]);

        toast('Registro creado','success','top-right');

        return redirect('patients');
    }

    public function show($patient)
    {
        $patient = User::patients()->findOrFail($patient);

        if (!$patient) {
            return redirect('patients');
        }

        return view('master/patients/show', [            
            'title' => 'Ver especialidad',
            'subtitle' => $patient->name,
            'patient' => $patient
        ]);
    }

    public function edit($patient)
    {
        $patient = User::patients()->findOrFail($patient);

        if (!$patient) {
            return redirect('patients');
        }

        return view('master/patients/edit', [            
            'title' => 'Editar paciente',
            'subtitle' => $patient->name,
            'patient' => $patient
        ]);
    }

    public function update(Request $request, User $patient)
    {
        // $request->validated();

        $patient->name = $request->input('name');
        $patient->email = $request->input('email');
        $patient->document = $request->input('document');
        $patient->address = $request->input('address');
        $patient->phone = $request->input('phone');
        $patient->save();

        toast('Registro actualizado','success','top-right');

        return redirect('patients');
    }

    public function destroy($patient)
    {
        $patient->delete();
        toast('Registro eliminado','success','top-right');
        return back();
    }
}
