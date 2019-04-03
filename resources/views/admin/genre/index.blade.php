@extends('layouts.admin')

@section('title') Genres @endsection

@section('header') Genres @endsection

@section('content')

    <div class="section-body">
        <h2 class="section-title">Data genres</h2>
        <p class="section-lead">
            Kumpulan semua data genre
        </p>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4><button class="btn btn-outline-primary" data-toggle="modal" data-target="#create">Tambah data</button></h4>
                        <div class="card-header-form">
                            <form action="{{ route('genres.index') }}">
                                <div class="input-group">
                                <input type="text" name="q" class="form-control" placeholder="Cari berdasarkan nama">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-md">
                                <tbody>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php $no = 0; ?>
                                    @foreach($genres as $data)
                                    @php $no++ @endphp
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#edit-genre" data-name="{{ $data->name }}" data-id="{{ $data->id }}"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#delete-genre" data-name="{{ $data->name }}" data-id="{{ $data->id }}"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="10">{{$genres->appends(Request::all())->links()}}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
