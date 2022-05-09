@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-5 col-8">
            <div class="header-element">
                <h3>
                    {{ $title }}
                </h3>
            </div>
        </div>
    </div>
</section>

<section class="content form_elements">
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header txt_padding">
                    <h3 class="card-title">
                        {{ $subtitle }}
                    </h3>

                    <span class="float-right fnt_size txt_font">
                        <i class="fa fa-fw ti-angle-up clickable"></i>
                        <i class="fa fa-fw ti-close removecard"></i>
                    </span>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Especialidad</th>
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
                                    <td>0</td>
                                    <td>{{ $key->created_at }}</td>
                                    <td>
                                        <a href="{{ route('specialities.show', $key->id) }}" class="btn btn-info">Ver detalle</a>
                                        <a href="{{ route('specialities.edit', $key->id) }}" class="btn btn-warning">Editar</a>
                                        <a href="{{ route('specialities.destroy', $key->id) }}" class="btn btn-danger" onclick="event.preventDefault();
                                                     document.getElementById('delete-form-{{$key->id}}').submit();">Eliminar</a>    

                                        <form id="delete-form-{{$key->id}}" action="{{ route('specialities.destroy', $key->id) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>          
                                    </td>                                     
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
