@extends('layouts.auth')

@section('title') Login @endsection

@section('content')
    <div class="login-brand">
        <img src="{{ asset('assets/img/stisla-fill.svg')}}" alt="logo" width="100" class="shadow-light rounded-circle">
    </div>

    <div class="card card-primary">
        <div class="card-header"><h4>Login Admin</h4></div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.login.submit') }}" class="needs-validation" novalidate="">
            @csrf
                <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" tabindex="1" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <div class="d-block">
                    <label for="password" class="control-label">Password</label>
                <div class="float-right">
                    @if (Route::has('admin.password.request'))
                        <a href="{{ route('admin.password.request') }}" class="text-small">
                        Forgot Password?
                        </a>
                    @endif
                </div>
                </div>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" tabindex="2" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <div class="custom-control custom-checkbox">
                <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me" {{ old('remember') ? 'checked' : '' }}>
                <label class="custom-control-label" for="remember-me">Remember Me</label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                Login
                </button>
            </div>
            </form>

            {{--  <div class="text-center mt-4 mb-3">
            <div class="text-job text-muted">Login With Social</div>
            </div>
            <div class="row sm-gutters">
            <div class="col-6">
                <a class="btn btn-block btn-social btn-facebook">
                <span class="fab fa-facebook"></span> Facebook
                </a>
            </div>
            <div class="col-6">
                <a class="btn btn-block btn-social btn-twitter">
                <span class="fab fa-twitter"></span> Twitter
                </a>
            </div>
            </div>  --}}

        </div>
    </div>
@endsection
