@extends('layouts.admin')

@section('title') Episodes @endsection

@section('header') Episodes @endsection

@section('content')

    <div class="section-body">
        <h2 class="section-title">Data episodes</h2>
        <p class="section-lead">
            Kumpulan semua data episodes
        </p>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4><a href="{{ route('episodes.create') }}" class="btn btn-outline-primary">Tambah data</a></h4>
                        <div class="card-header-form">
                            <form action="{{ route('episodes.index') }}">
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
                                        <th>Nama Komik</th>
                                        <th>Episode Terbaru</th>
                                        <th>Preview</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php $no =0; ?>
                                    @foreach($episodes as $data)
                                    <?php $no++ ?>
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>
                                            @foreach ($data->comics as $item)
                                                <a href="{{ url('admin/comics/'.$item->id.'/edit') }}"><img alt="image" src="{{ asset('admin/assets/avatars/'.$item->thumbnail)}}" class="avatar mr-2" width="50" data-toggle="tooltip" title="{{ $item->name }}"></a>
                                            @endforeach
                                        </td>
                                        <td>{{ $data->name }}</td>
                                        <td><a href="{{ route('episodes.preview', ['id'=>$data->id]) }}" id="" class="btn btn-primary" href="#" role="button">Preview file</a></td>
                                        <td>
                                            <a href="{{ route('episodes.edit', $data->id) }}" class="btn btn-primary" ><i class="fas fa-edit"></i></a>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#delete-episode" data-name="{{ $data->name }}" data-id="{{ $data->id }}"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="10">{{$episodes->appends(Request::all())->links()}}</td>
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
