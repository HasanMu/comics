@extends('layouts.auth')

@section('title')
    Forgot Password
@endsection

@section('content')
    <div class="login-brand">
        <img src="{{ asset('assets/img/stisla-fill.svg')}}" alt="logo" width="100" class="shadow-light rounded-circle">
    </div>

    <div class="card card-primary">
        <div class="card-header"><h4>Forgot Password Admin</h4></div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <p class="text-muted">We will send a link to reset your password</p>
            <form method="POST" action="{{ route('admin.password.email') }}">
            @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    Forgot Password
                </button>
                </div>
            </form>
        </div>
    </div>
@endsection
