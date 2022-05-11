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
                    <form method="POST" action="{{ route('appointments.store') }}">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="specialty" class="control-label">
                                    Especialidad
                                </label>   

                                <select id="specialty" name="speciality_id" class="form-control @error('speciality_id') is-invalid @enderror" required>
                                    <option value="">Seleccione una especialidad</option>
                                    @foreach($specialties as $key)
                                        <option value="{{ $key->id }}" @if(old('speciality_id') == $key->id) selected @endif>{{ $key->name }}</option>
                                    @endforeach
                                </select>

                                @error('speciality_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="doctor" class="control-label">
                                    Medico
                                </label>

                                <select id="doctor" name="doctor_id" class="form-control @error('doctor_id') is-invalid @enderror" required> 
                                    <option value="">Seleccione una especialidad</option>
                                    @foreach($doctors as $key)
                                        <option value="{{ $key->id }}" @if(old('doctor_id') == $key->id) selected @endif>{{ $key->name }}</option>
                                    @endforeach                                               
                                </select>

                                @error('doctor_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                                            
                        </div> 

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="date" class="control-label">
                                    Fecha de atención
                                </label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-fw ti-calendar"></i>
                                        </span>
                                    </div>

                                    <input type="date" class="form-control @error('schedule_date') is-invalid @enderror float-right" required 
                                    data-language='es' id="date" name="schedule_date" 
                                    value="{{ old('schedule_date', date('Y-m-d')) }}" 
                                    data-date-format="yyyy-mm-dd"
                                    data-date-start-date="{{ date('Y-m-d') }}" 
                                    data-date-end-date="+30d"
                                    />

                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="hours" class="control-label">
                                    Hora de atención
                                </label>     

                                <div id="hours">
                                    @if($intervals)
                                        @foreach($intervals['morning'] as $interval => $key)
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="intervalMorning{{ $interval }}" name="schedule_time" value="{{ $key['start'] }}" required>
                                                <label class="custom-control-label" for="intervalMorning{{ $interval }}">{{ $key['start'] }} - {{ $key['end'] }}</label>
                                            </div>                                                        
                                        @endforeach 

                                        @foreach($intervals['afternoon'] as $interval => $key)
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="intervalAfternoon{{ $interval }}" name="schedule_time" value="{{ $key['start'] }}" required>
                                                <label class="custom-control-label" for="intervalAfternoon{{ $interval }}">{{ $key['start'] }} - {{ $key['end'] }}</label>
                                            </div> 
                                        @endforeach 
                                    @else
                                        <div class="alert alert-info" role="alert">
                                            <strong>Seleccione un medico y una fecha</strong>
                                        </div>
                                    @endif                                                
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="type" class="control-label">
                                Tipo de consulta
                            </label>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="type1" name="type" value="Consulta" @if(old('type', 'Consulta') == 'Consulta' ) checked @endif>
                                <label class="custom-control-label" for="type1">Consulta</label>
                            </div> 

                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="type2" name="type" value="Examen" @if(old('type') == 'Examen' ) checked @endif>
                                <label class="custom-control-label" for="type2">Examen</label>
                            </div>

                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="type3" name="type" value="Cirugía" @if(old('type') == 'Cirugía' ) checked @endif>
                                <label class="custom-control-label" for="type3">Cirugía</label>
                            </div>                                           
                        </div>


                        <div class="form-group mbn">
                            <label for="description" class="control-label">Descripción</label>

                            <textarea id="description" name="description" rows="3" class="form-control resize_vertical" placeholder="Describe brevemente su consulta" >{{ old('description') }}</textarea>
                        </div>                                                          

                        <br>

                        <div>
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{ route('appointments.index') }}" class="btn btn-primary">Volver</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')    
    <script src="{{ asset('js/appointments/script.js') }}" type="text/javascript"></script>
@endpush
