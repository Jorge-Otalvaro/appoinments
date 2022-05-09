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
                    <form method="POST" action="{{ route('doctors.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">Nombre completo</label>
                            <input type="text" class="form-control @error('name') is-invalid @else is-valid @enderror" id="name" name="name" value="{{ old('name') }}">

                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Correo electrónico</label>
                            <input type="text" class="form-control @error('email') is-invalid @else is-valid @enderror" id="email" name="email" value="{{ old('email') }}">

                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="document">Numero de documento</label>
                            <input type="text" class="form-control @error('document') is-invalid @else is-valid @enderror" id="document" name="document" value="{{ old('document') }}">

                            @error('document')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address">Dirección</label>
                            <input type="text" class="form-control @error('address') is-invalid @else is-valid @enderror" id="address" name="address" value="{{ old('address') }}">

                            @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">Telefóno</label>
                            <input type="text" class="form-control @error('phone') is-invalid @else is-valid @enderror" id="phone" name="phone" value="{{ old('phone') }}">

                            @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>    

                        <div class="form-group">
                            <label for="specialties" class="control-label">
                                Especialidad
                            </label>    

                            <select id="specialty" name="specialties[]" class="form-control specialty selectpicker @error('specialties') is-invalid @enderror" value="{{ old('specialties') }}" multiple required>
                                @foreach($specialties as $key)
                                    <option value="{{ $key->id }}">{{ $key->name }}</option>
                                @endforeach
                            </select>

                            @error('specialties')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>                   

                        <br>

                        <div>
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="{{ route('doctors.index') }}" class="btn btn-primary">Volver</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
