@extends('layouts.admin')

@section('title') Comics @endsection

@section('header') Comics @endsection

@section('content')
<div class="section-body">
        <h2 class="section-title">Halo, </h2>
        <p class="section-lead">
            Terbitkan karyamu disini!
        </p>

        <form action="{{ route('comics.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card">
                    <div class="card-header">
                        <h4>Avatar</h4>
                    </div>
                    <div class="card-body">
                        <div class="custom-file">
                        <input type="file" class="custom-file-input" name="thumbnail" id="thumbnail" multiple>
                        <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <br>
                        <br>
                        <img id="thumbnail_preview" src="{{ asset('assets/img/news/img10.jpg') }}" class="dropzone dz-clickable" style="width: 100%; height: 236px; border-image: none;" alt="">


                    </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-8">
                    <div class="card">
                    <div class="card-header">
                        <h4>Sampul Komik</h4>
                    </div>
                    <div class="card-body">
                        <div class="custom-file">
                        <input type="file" class="custom-file-input" name="cover" id="cover" multiple>
                        <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <br>
                        <br>
                        <img id="cover_preview" src="{{ asset('assets/img/news/img10.jpg') }}" class="dropzone dz-clickable" style="width: 100%; height: 236px; border-image: none;" alt="">

                    </div>
                    </div>
                </div>
            </div>

            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Pengaturan Komik</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Genre</label>
                                        <select class="form-control select2" multiple="" name="genres[]" aria-placeholder="Pilih jenis genre">
                                            @foreach ($genres as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Kategori</label>
                                        <select class="selectric" name="category" aria-placeholder="Pilih jenis kategori">
                                            @foreach ($category as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="inputAddress">Judul komik</label>
                                        <input type="text" name="name" class="form-control" placeholder="Judul komikmu" id="name">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="inputAddress">Deskripsi / Sinopsis</label>
                                        <textarea rows="9" class="form-control" name="description" placeholder="Sinopsis"></textarea>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="inputAuthor">Author</label>
                                        <select class="form-control select2" multiple="" name="users[]" aria-placeholder="Pilih nama author">
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="inputAuthor">Update Komik</label>
                                        <select class="form-control select2" multiple="" name="days[]" aria-placeholder="Pilih nama author">
                                            @foreach ($days as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="inputAuthor">Jam Update
                                        <input type="text" class="form-control timepicker" name="hours">
                                        <small class="text-muted">* PM : antara jam 12 - 24  &amp AM : antara jam 1 - 12</small>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <p></p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <button class="btn btn-success" type="submit"><i class="fas fa-plus"></i> Tambah Data</button>
                                        <a class="btn btn-secondary" href="{{ route('comics.index') }}"><i class="fas fa-arrow-left"></i> Kembali ke halaman sebelumnya</a>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <p></p>
                                    </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
