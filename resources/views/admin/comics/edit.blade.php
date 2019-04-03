@extends('layouts.admin')

@section('title') Comics @endsection

@section('header') Comics @endsection

@section('content')
    <div class="section-body">
        <h2 class="section-title">{{ $comic->name }}</h2>
        <p class="section-lead">
            Author :
            @foreach($author as $data)
                <a href="{{ url('admin/users/'.$data->id) }}">{{ (in_array($data->id, $selectAuthor)) ? "$data->name |" : '' }}</a>
            @endforeach
        </p>
        <form action="{{ route('comics.update', $comic->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card">
                    <div class="card-body">
                        <img id="thumbnail_preview" src="{{ asset('admin/assets/avatars/'.$comic->thumbnail) }}" class="dropzone dz-clickable" style="width: 100%; height: 236px; border-image: none;" alt="">
                        <input type="hidden" name="thmb" value="{{ $comic->thumbnail }}">
                    </div>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="thumbnail" id="thumbnail" multiple>
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-8">
                    <div class="card">
                    <div class="card-body">
                        <img id="cover_preview" src="{{ asset('admin/assets/avatars/'.$comic->cover) }}" class="dropzone dz-clickable" style="width: 100%; height: 236px; border-image: none;" alt="">
                        <input type="hidden" name="cvr" value="{{ $comic->cover }}">
                    </div>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="cover" id="cover" multiple>
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
            </div>

            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Genre</label>
                                        <select class="form-control select2" multiple="" name="genres[]" aria-placeholder="Pilih jenis genre">
                                            @foreach ($genres as $data)
                                                <option value="{{ $data->id }}"{{ (in_array($data->id, $selectGenre)) ? 'selected' : '' }}>{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Kategori</label>
                                        <select class="selectric" name="category" aria-placeholder="Pilih jenis kategori">
                                            @foreach ($category as $data)
                                                <option value="{{ $data->id }}" {{ ($data->id == $comic->category_id) ? 'selected' : '' }}>{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">Judul komik</label>
                                        <input type="text" name="name" class="form-control" placeholder="Judul komikmu" id="name" value="{{ $comic->name }}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">Status</label>
                                        <select class="selectric" name="status" aria-placeholder="">
                                        @if ($comic->status == 'ACTIVE')
                                            <option value="ACTIVE" selected>ACTIVE</option>
                                            <option value="END">END</option>
                                            <option value="INACTIVE">INACTIVE</option>
                                        @elseif ($comic->status == 'END')
                                            <option value="ACTIVE">ACTIVE</option>
                                            <option value="END" selected>END</option>
                                            <option value="INACTIVE">INACTIVE</option>
                                        @elseif ($comic->status == 'INACTIVE')
                                            <option value="ACTIVE">ACTIVE</option>
                                            <option value="END">END</option>
                                            <option value="INACTIVE" selected>INACTIVE</option>
                                        @endif
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="inputAddress">Deskripsi / Sinopsis</label>
                                        <textarea rows="9" class="form-control" name="description" placeholder="Sinopsis">{{ $comic->description }}</textarea>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="inputAuthor">Author</label>
                                        <select class="form-control select2" multiple="" name="users[]" aria-placeholder="Pilih nama author">
                                            @foreach ($author as $data)
                                                <option value="{{ $data->id }}" {{ (in_array($data->id, $selectAuthor)) ? 'selected' : '' }}>{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="inputAuthor">Update Komik</label>
                                        <select class="form-control select2" multiple="" name="days[]" aria-placeholder="Pilih nama author">
                                            @foreach ($days as $data)
                                                <option value="{{ $data->id }}"{{ (in_array($data->id, $selectDay)) ? 'selected' : '' }}>{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="inputAuthor">Jam Update
                                        <input type="text" class="form-control timepicker" name="hours" value="{{ $comic->hours }}">
                                        <small class="text-muted">* PM : antara jam 12 - 24  &amp AM : antara jam 1 - 12</small>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <p></p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <button class="btn btn-success" type="submit"><i class="fas fa-plus"></i> Edit Data</button>
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
