@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (Auth::guard('web')->check())
                        <p class="text-success">
                            Kamu Login sebagai <strong>User</strong>
                        </p>
                        @else
                        <p class="text-danger">
                            Kamu Logout sebagai <strong>User</strong>
                        </p>
                    @endif

                    @if (Auth::guard('admin')->check())
                        <p class="text-success">
                            Kamu Login sebagai <strong>Admin</strong>
                        </p>
                        @else
                        <p class="text-danger">
                            Kamu Logout sebagai <strong>Admin</strong>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
