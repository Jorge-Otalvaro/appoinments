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
                            <label for="name">Especialidad</label>
                            <input type="text" class="form-control" value="{{ $speciality->name }}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea class="form-control" rows="6" disabled>{{ $speciality->description }}</textarea>
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
                            <a href="{{ route('specialities.index') }}" class="btn btn-primary">Volver</a>
                            <a href="{{ route('specialities.edit', $speciality->id) }}" class="btn btn-warning">Editar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
