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
                                <th scope="col">Fecha</th>
                                <th scope="col">Hora</th>
                                <th scope="col">Especialidad</th>                                
                                @if(auth()->user()->role == 'doctor' || auth()->user()->role == 'admin')
                                    <th scope="col">Paciente</th>
                                @elseif(auth()->user()->role == 'patient')
                                    <th scope="col">Medico</th>
                                @endif 
                                <th scope="col">Estado</th>                                
                                <th scope="col">Tipo consulta</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($results as $key)
                                <tr>
                                    <th scope="row">{{ $key->id }}</th>
                                    <td>{{ $key->schedule_date }}</td>
                                    <td>{{ $key->schedule_time }}</td>
                                    <td>{{ $key->speciality->name }}</td>
                                    @if(auth()->user()->role == 'doctor' || auth()->user()->role == 'admin')
                                        <th scope="row">{{ $key->patient->name }}</th>
                                    @elseif(auth()->user()->role == 'patient')
                                        <th scope="row">{{ $key->doctor->name }}</th>
                                    @endif  
                                    <td>
                                        @if($key->status === 'Reservada')
                                            <a href="#" class="btn btn-warning btn-xs">
                                                <span class="fa fa-fw ti-alert"></span> {{ $key->status }}
                                            </a> 
                                        @elseif($key->status === 'Confirmada')
                                            <a href="#" class="btn btn-info btn-xs">
                                                <span class="fa fa-fw ti-location-pin"></span> {{ $key->status }}
                                            </a> 
                                        @elseif($key->status === 'Cancelada')
                                            <a href="#" class="btn btn-danger btn-xs">
                                                <span class="fa fa-fw ti-close"></span> {{ $key->status }}
                                            </a> 
                                        @elseif($key->status === 'Atendida')
                                            <a href="#" class="btn btn-success btn-xs">
                                                <span class="fa fa-fw ti-check"></span> {{ $key->status }}
                                            </a> 
                                        @endif                                                                                                 
                                    </td>
                                    <th scope="row">{{ $key->type }}</th>
                                    <td>
                                        {{-- <a href="{{ route('doctors.show', $key->id) }}" class="btn btn-info">Ver detalle</a>
                                        <a href="{{ route('doctors.edit', $key->id) }}" class="btn btn-warning">Editar</a>
                                        <a href="{{ route('doctors.destroy', $key->id) }}" class="btn btn-danger" onclick="event.preventDefault();
                                                     document.getElementById('delete-form-{{$key->id}}').submit();">Eliminar</a>    

                                        <form id="delete-form-{{$key->id}}" action="{{ route('doctors.destroy', $key->id) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>   --}}

                                        @if(auth()->user()->role == 'doctor' || auth()->user()->role == 'admin')
                                            <a href="#" class="btn btn-info btn-xs">
                                                <span class="fa fa-fw ti-location-pin"></span> Ver detalle
                                            </a> 

                                            <button class="btn btn-warning btn-xs" onclick="confirm_appointments()">
                                                <span class="fa fa-fw ti-new-window"></span> Confirmar cita
                                            </button> 
                                        @elseif(auth()->user()->role == 'patient')
                                            <button class="btn btn-danger btn-xs" onclick="enviar_formulario()">
                                                <span class="fa fa-fw ti-new-window"></span> Cancelar cita
                                            </button> 
                                        @endif        
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

@push('scripts')  
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>  
    <script src="{{ asset('js/alerts/alerts.js') }}" type="text/javascript"></script>
@endpush