<?php

namespace App\Http\Controllers;

use App\Models\Speciality;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SpecialityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$results = Speciality::all();

        return view('master/specialities/index', compact('results'));
    }

    public function create()
    {
        return view('master/specialities/create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3'
        ];

        $this->validate($request, $rules);

        $speciality = new Speciality();

        $speciality->name        = $request->input('name');
        $speciality->description = $request->input('description');
        $speciality->save();

        toast('Registro creado','success','top-right');

        return redirect('specialities');
    }

    public function show($speciality)
    {
    	$speciality = Speciality::find($speciality);

        return view('master/specialities/show', compact('speciality'));
    }

    public function edit($speciality)
    {
    	$speciality = Speciality::find($speciality);

        return view('master/specialities/edit', compact('speciality'));
    }

    public function update(Request $request, Speciality $speciality)
    {
        $rules = [
            'name' => 'required|min:3'
        ];

        $this->validate($request, $rules);

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
