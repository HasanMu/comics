@extends('layouts.admin')

@section('title') Comments @endsection

@section('header') Comments @endsection

@section('content')
    <div class="section-body">
            <h2 class="section-title">Halo, </h2>
            <p class="section-lead">
                Buat Komentar Komikmu!
            </p>

            <form action="{{ route('comments.store') }}" method="post">
            @csrf

            <div class="card">
                <div class="card-header">
                    <h4>Buat Komentar</h4>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                              <label for="comics">Pilih komik</label>
                              <select class="selectric" name="comics" id="comics">
                                    @foreach ($comics as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                              </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                              <label for="users">Nama user</label>
                              <select class="selectric" name="users" id="users">
                                    @foreach ($users as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                              </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputAddress">Komentar</label>
                        <textarea rows="4" name="name" class="form-control" id="inputAddress" placeholder="Maks 500 Kata"></textarea>
                    </div>

                    <center>
                            <button class="btn btn-success" type="submit"><i class="fas fa-plus"></i> Buat komentar</button>
                        <a class="btn btn-secondary" href="{{ route('comments.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </center>
                </div>
            </div>

            </form>
    </div>
@endsection
