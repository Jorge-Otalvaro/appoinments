@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Ver especialidad') }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif                   

                    <form>
                        <div class="form-group">
                            <label for="name">Especialidad</label>
                            <input type="text" class="form-control" value="{{ $speciality->name }}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea class="form-control" rows="3" disabled> 
                                {{ $speciality->description }}                               
                            </textarea>
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

                        <a href="{{ route('specialities.index') }}" class="btn btn-primary">Volver</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
