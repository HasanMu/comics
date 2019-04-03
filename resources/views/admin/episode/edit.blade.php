@extends('layouts.admin')

@section('title') Episodes @endsection

@section('header') Episodes @endsection

@section('content')
<div class="section-body">
        <h2 class="section-title">Halo, </h2>
        <p class="section-lead">
            Edit Episode ke -!
        </p>

        <form action="{{ route('episodes.update', $episode->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card">
                    <div class="card-header">
                        <h4>Avatar</h4>
                    </div>
                    <div class="card-body">
                        <img id="thumbnail_preview" src="{{ asset('admin/assets/episodes/avatars/'.$episode->avatar)}}" class="dropzone dz-clickable" style="width: 100%; height: 236px; border-image: none;" alt="">
                        <br><br>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="avatar" id="thumbnail" multiple>
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-8">
                    <div class="card">
                    <div class="card-header">
                        <h4>Buat Episode</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Nama Komik</label>
                                <select class="selectric" name="comics" aria-placeholder="Pilih Komik">
                                    @foreach ($comics as $data)
                                        <option value="{{ $data->id }}" {{ (in_array($data->id, $selectComic)) ? 'selected' : '' }}>{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Episode Ke</label>
                                    <input type="text" value="{{ $eps }} Episode" disabled class="form-control" name="eps">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputAddress">Judul Episode</label>
                                <input type="text" name="name" value="{{ $episode->name }}" class="form-control" placeholder="Judul episode" id="name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAddress">File komik</label>
                                    <input type="file" class="form-control" name="file" value="{{ $episode->file }}">
                            </div>
                            <div class="form-group col-md-6" style="text-align: center;">
                                <label for="inputAddress">&nbsp;</label><br>
                                <a href="{{ route('episodes.preview', ['id'=>$episode->id]) }}" id="" class="btn btn-primary" href="#" role="button">Preview file</a>
                            </div>
                            <div class="form-group col-md-3">
                                <p></p>
                            </div>
                            <div class="form-group col-md-4">
                                <button class="btn btn-success" type="submit"><i class="fas fa-plus"></i> Buat episode</button>
                            </div>
                            <div class="form-group col-md-2">
                                    <a class="btn btn-secondary" href="{{ route('episodes.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
