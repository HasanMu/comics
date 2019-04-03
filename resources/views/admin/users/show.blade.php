@extends('layouts.admin')

@section('title') Users @endsection

@section('header') Users @endsection

@section('content')
    <div class="section-body">
        <h2 class="section-title">Halo, {{ $user->name }}</h2>
        <p class="section-lead">
            Ubah informasi dirimu disini!
        </p>

        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget">
                    <div class="profile-widget-header">
                        @if(!$user->avatar)
                            <img alt="image" id="avatar_preview"  src="{{ asset('assets/img/avatar/avatar-1.png')}}" class="rounded-circle profile-widget-picture">
                        @else
                            <img alt="image" id="avatar_preview"  src="{{ asset('admin/assets/avatar/'.$user->avatar)}}" class="rounded-circle profile-widget-picture">
                        @endif
                    <div class="profile-widget-items">
                        <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Umur</div>
                        <div class="profile-widget-item-value">{{ $user->age }} Tahun</div>
                        </div>
                        <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Jenis Kelamin</div>
                        <div class="profile-widget-item-value">{{ $user->gender }}</div>
                        </div>
                    </div>
                    </div>
                    <div class="profile-widget-description">
                    <div class="profile-widget-name">{{ ucfirst($user->name) }} <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> {{ $user->email }}</div></div>
                    @if (!$user->bio)
                        Tidak ada bio!
                    @else
                    {{ $user->bio }}
                    @endif
                    </div>
                    <div class="card-footer text-center">
                    <div class="font-weight-bold mb-2">Follow {{ ucfirst($user->name) }} Di</div>
                    <a href="#" class="btn btn-social-icon btn-facebook mr-1">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="btn btn-social-icon btn-twitter mr-1">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="btn btn-social-icon btn-github mr-1">
                        <i class="fab fa-github"></i>
                    </a>
                    <a href="#" class="btn btn-social-icon btn-instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    </div>
                </div>

                {{--  <div class="card">
                    <form method="post" class="needs-validation" novalidate="" action="{{ route('users.update', ['id'=>$user->id]) }}">
                        @csrf
                        @method('PATCH')
                        <div class="card-header">
                            <h4>Keamanan</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-12">
                                <label>Password</label>
                                <input class="form-control" name="password" required>
                                </div>
                                <div class="form-group col-12">
                                <label>Kata sandi baru</label>
                                <input class="form-control" name="new_password" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <div class="form-group col-12">
                                        <div class="text-left">
                                            <button class="btn btn-success" href="{{ route('users.index') }}" role="button">Simpan perubahan</button>

                                            <a class="btn btn-secondary" href="{{ route('users.index') }}" role="button">Kembali</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>  --}}
            </div>
            @include('admin.users.edit')
        </div>
    </div>
@endsection
