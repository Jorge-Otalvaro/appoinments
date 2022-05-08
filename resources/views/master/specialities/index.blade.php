@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Dashboard') }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="col text-right">
                        <a href="{{ route('specialities.create') }}" class="btn btn-primary">
                            Crear nueva especialidad
                        </a>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Especialidad</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Medicos</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($results as $key)
                                <tr>
                                    <th scope="row">{{ $key->id }}</th>
                                    <td>{{ $key->name }}</td>
                                    <td>{{ Str::limit($key->description, 50) }}</td>
                                    <td></td>
                                    <td>{{ $key->created_at }}</td>
                                    <td>
                                        <a href="{{ route('specialities.show', $key->id) }}" class="btn btn-info">Ver detalle</a>
                                        <a href="{{ route('specialities.edit', $key->id) }}" class="btn btn-warning">Editar</a>
                                        <a href="/" class="btn btn-danger">Eliminar</a>                          
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
