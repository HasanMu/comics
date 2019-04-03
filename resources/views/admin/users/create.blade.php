@extends('layouts.admin')

@section('title') Users @endsection

@section('header') Users @endsection

@section('content')
    <div class="section-body">
        <h2 class="section-title">Tambah data users</h2>
        <p class="section-lead">
                Halaman untuk menambah data baru dari users
        </p>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4></h4>
                        <div class="card-header-form">
                            <a href="{{ route('users.index') }}" class="btn btn-icon icon-left btn-outline-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
                        </div>
                    </div>
                    <div class="card-body">
                    <form action="{{ route('users.store') }}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Nama</label>
                                <input type="text" name="name" class="form-control" id="inputEmail4" placeholder="Nama lengkap">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Email</label>
                                <input type="email" name="email" class="form-control" id="inputPassword4" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Umur</label>
                                <input type="number" name="age" class="form-control" id="inputEmail4" placeholder="Umur">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Jenis kelamin</label>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" name="gender" value="Laki - laki" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Laki - Laki</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="gender" value="Perempuan" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio2">Perempuan</label>
                                </div>
                            </div>
                        </div>
                            <div class="form-group">
                                <label for="inputAddress">Alamat</label>
                                <textarea rows="4" class="form-control" name="address" placeholder="Alamat"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Bio (otional)</label>
                                <textarea rows="4" class="form-control" name="bio" placeholder="Bio"></textarea>
                            </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCity">Kata sandi</label>
                                <input type="password" name="password" class="form-control" id="Kata sandi">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Kata sandi">Konfirmasi Kata sandi</label>
                                <input type="password" name="password_confirm" class="form-control" id="Kata sandi">
                            </div>
                        </div>
                        <div class="form-group mb-0">
                                <button type="submit" class="btn btn-icon icon-left btn-success"><i class="fas fa-plus"></i> Tambah data</button>
                                <a href="{{ route('users.index') }}" class="btn btn-icon icon-left btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
