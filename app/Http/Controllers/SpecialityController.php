<?php

namespace App\Http\Controllers;

use App\Models\Speciality;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreSpecialityRequest;

class SpecialityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$result = Speciality::all();

        return view('master/specialities/index', [            
            'title' => 'Especialidades',
            'subtitle' => 'Lista de especialidades',
            'results' => $result
        ]);
    }

    public function create()
    {
        return view('master/specialities/create', [            
            'title' => 'Especialidades',
            'subtitle' => 'Crear especialidad'
        ]);
    }

    public function store(StoreSpecialityRequest $request)
    {
        $request->validated();

        $speciality = Speciality::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        toast('Registro creado','success','top-right');

        return redirect('specialities');
    }

    public function show($speciality)
    {
    	$speciality = Speciality::findOrFail($speciality);

        return view('master/specialities/show', [            
            'title' => 'Ver especialidad',
            'subtitle' => $speciality->name,
            'speciality' => $speciality
        ]);
    }

    public function edit($speciality)
    {
    	$speciality = Speciality::findOrFail($speciality);

        return view('master/specialities/edit', [            
            'title' => 'Editar especialidad',
            'subtitle' => $speciality->name,
            'speciality' => $speciality
        ]);
    }

    public function update(Request $request, Speciality $speciality)
    {
        // $request->validated();

        $speciality->name        = $request->input('name');
        $speciality->description = $request->input('description');
        $speciality->save();

        toast('Registro actualizado','success','top-right');

        return redirect('specialities');
    }

    public function destroy(Speciality $speciality)
    {
        $speciality->delete();
        toast('Registro eliminado','success','top-right');
        return back();
    }
}
