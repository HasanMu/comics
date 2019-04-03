@extends('layouts.admin')

@section('title') Users @endsection

@section('header') Users @endsection

@section('content')
    <div class="section-body">
        <h2 class="section-title">Data users</h2>
        <p class="section-lead">
            Kumpulan semua data users
        </p>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4><a class="btn btn-outline-primary" href="{{ route('users.create') }}" role="button">Tambah data</a></h4>
                        <div class="card-header-form">
                            <form action="{{ route('users.index') }}">
                                <div class="input-group">
                                <input type="text" class="form-control" name="q" placeholder="Cari berdasarkan nama">
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
                                            <th>Alamat</th>
                                            <th>Email</th>
                                            <th>Jenis kelamin</th>
                                            <th>Action</th>
                                        </tr>
                                        <?php $no = 0; ?>
                                        @foreach($users as $data)
                                        <?php $no++ ?>
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->address }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td>{{ $data->gender }}</td>
                                            <td>
                                                <a href="{{ route('users.show', ['id'=>$data->id]) }}" class="btn btn-primary"><i class="fas fa-edit"></i></i></a>
                                                <button class="btn btn-danger" data-toggle="modal" data-target="#delete-user" data-name="{{ $data->name }}" data-id="{{ $data->id }}"><i class="fas fa-trash-alt"></i></button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="10">{{$users->appends(Request::all())->links()}}</td>
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
