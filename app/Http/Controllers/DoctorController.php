<?php

namespace App\Http\Controllers;

use App\Models\Speciality;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $result = User::doctors()->get();

        return view('master/doctors/index', [            
            'title' => 'Doctores',
            'subtitle' => 'Lista de doctores',
            'results' => $result
        ]);
    }

    public function create()
    {
        return view('master/doctors/create', [            
            'title' => 'Doctores',
            'subtitle' => 'Crear doctor',
            'specialties' => Speciality::all()
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $request->validated();

        $passwordNew = Str::random(10);

        $doctor = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'document' => $request->document,
            'password' => Hash::make($passwordNew),
            'address' => $request->address,
            'phone' => $request->phone,
            'role' => 'doctor'
        ]);

        $doctor->specialties()->attach($request->specialties);

        toast('Registro creado','success','top-right');

        return redirect('doctors');
    }

    public function show($doctor)
    {
        $doctor = User::doctors()->findOrFail($doctor);

        if (!$doctor) {
            return redirect('doctors');
        }

        return view('master/doctors/show', [            
            'title' => 'Ver doctor',
            'subtitle' => $doctor->name,
            'doctor' => $doctor
        ]);
    }

    public function edit($doctor)
    {
        $doctor = User::doctors()->findOrFail($doctor);

        if (!$doctor) {
            return redirect('doctors');
        }

        return view('master/doctors/edit', [            
            'title' => 'Editar doctor',
            'subtitle' => $doctor->name,
            'doctor' => $doctor,
            'specialties' => Speciality::all()
        ]);
    }

    public function update(Request $request, User $doctor)
    {
        // $request->validated();

        $doctor->name = $request->input('name');
        $doctor->email = $request->input('email');
        $doctor->document = $request->input('document');
        $doctor->address = $request->input('address');
        $doctor->phone = $request->input('phone');
        $doctor->save();

        $doctor->specialties()->sync($request->input('specialties'));

        toast('Registro actualizado','success','top-right');

        return redirect('doctors');
    }

    public function destroy($doctor)
    {
        $doctor->delete();
        toast('Registro eliminado','success','top-right');
        return back();
    }
}
