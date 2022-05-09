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
                    <form>
                        <div class="form-group">
                            <label for="name">Nombre completo</label>
                            <input type="text" class="form-control @error('name') is-invalid @else is-valid @enderror" id="name" name="name" value="{{ old('name', $doctor->name) }}" disabled>

                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Correo electrónico</label>
                            <input type="text" class="form-control @error('email') is-invalid @else is-valid @enderror" id="email" name="email" value="{{ old('email', $doctor->email) }}" disabled>

                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div> 
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="document">Numero de documento</label>
                            <input type="text" class="form-control @error('document') is-invalid @else is-valid @enderror" id="document" name="document" value="{{ old('document', $doctor->document) }}" disabled>

                            @error('document')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address">Dirección</label>
                            <input type="text" class="form-control @error('address') is-invalid @else is-valid @enderror" id="address" name="address" value="{{ old('address', $doctor->address) }}" disabled>

                            @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">Telefóno</label>
                            <input type="text" class="form-control @error('phone') is-invalid @else is-valid @enderror" id="phone" name="phone" value="{{ old('phone', $doctor->phone) }}" disabled>

                            @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>  

                        <br>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Medico</th>
                                    <th scope="col">Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--  -->
                            </tbody>
                        </table>

                        <div>
                            <a href="{{ route('doctors.index') }}" class="btn btn-primary">Volver</a>
                            <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-warning">Editar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
