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

            @if(session('errors'))
                <div class="alert alert-danger" role="alert">
                    Los cambios se han guardado pero debe tener en cuenta que : 
                    @foreach(session('errors') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
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

                <form action="{{ route('schedules.store') }}" method="POST">
                    @csrf
                    <div class="card-body">                        
                        <table class="table table-striped text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Día</th>
                                    <th scope="col">Activo</th>
                                    <th scope="col">Turno mañana</th>
                                    <th scope="col">Turno tarde</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($results as $key => $workDay)
                                    <tr>
                                        <th scope="row">{{ $days[$key] }}</th>

                                        <th scope="row">                                        
                                            <label class="switch">
                                                <input type="checkbox" name="active[]" 
                                                value="{{ $key }}" @if($workDay->active) checked @endif>
                                                <span class="slider round"></span>
                                            </label>
                                        </th>

                                        <th scope="row">
                                            <div class="row">
                                                <div class="col">
                                                    <select class="form-control" name="morning_start[]">
                                                        @for($i=7; $i<=11; $i++)

                                                            <option value="{{ ($i<10 ? '0' : '') .$i }}:00" @if($i.':00 AM' == $workDay->morning_start) selected @endif>
                                                                {{ $i }}:00 AM
                                                            </option>

                                                            <option value="{{ $i }}:30" @if($i.':30 AM' == $workDay->morning_start) selected @endif>
                                                                {{ $i }}:30 AM
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <select class="form-control" name="morning_end[]">
                                                        @for($i=7; $i<=11; $i++)

                                                            <option value="{{ ($i<10 ? '0' : '') .$i }}:00" @if($i.':00 AM' == $workDay->morning_end) selected @endif>
                                                                {{ $i }}:00 AM
                                                            </option>

                                                            <option value="{{ ($i<10 ? '0' : '') .$i }}:30" @if($i.':30 AM' == $workDay->morning_end) selected @endif>
                                                                {{ $i }}:30 AM
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </th>

                                        <th scope="row">
                                            <div class="row">
                                                <div class="col">
                                                    <select class="form-control" name="afternoon_start[]">
                                                        @for($i=1; $i<=11; $i++)

                                                            <option value="{{ $i+12 }}:00" @if($i.':00 PM' == $workDay->afternoon_start) selected @endif>
                                                                {{ $i }}:00 PM
                                                            </option>

                                                            <option value="{{ $i+12 }}:30" @if($i.':30 PM' == $workDay->afternoon_start) selected @endif>
                                                                {{ $i }}:30 PM
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <select class="form-control" name="afternoon_end[]">
                                                        @for($i=1; $i<=11; $i++)

                                                            <option value="{{ $i+12 }}:00" @if($i.':00 PM' == $workDay->afternoon_end) selected @endif>
                                                                {{ $i }}:00 PM
                                                            </option>

                                                            <option value="{{ $i+12 }}:30" @if($i.':30 PM' == $workDay->afternoon_end) selected @endif>
                                                                {{ $i }}:30 PM
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
