@extends('layouts.guest')

@section('content')
<div class="col-lg-4 col-10 col-sm-8 m-auto login-form">
    <div class="card-body">
        <div class="row">
            <div class="col-12">                

                <form method="POST" action="{{ route('login') }}" class="login_validator">

                    @csrf

                    <div class="form-group">
                        <label for="email" class="sr-only"> {{ __('Email Address') }}</label>

                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('Email Address') }}">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="sr-only">{{ __('Password') }}</label>

                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group checkbox">
                        <label for="remember">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            &nbsp; {{ __('Remember Me') }}
                        </label>
                    </div>                  

                    <div class="form-group">
                        <input type="submit" value="{{ __('Login') }}" class="btn btn-primary btn-block"/>
                    </div>

                    @if (Route::has('password.request'))
                        <a class="forgot" id="forgot" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif

                    @if (Route::has('register'))
                        <span class="float-right sign-up">New ? 
                            <a href="{{ route('register') }}">{{ __('Register') }}</a>
                        </span>
                    @endif                   
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
