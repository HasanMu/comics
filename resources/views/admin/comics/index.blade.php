@extends('layouts.admin')

@section('title') Comics @endsection

@section('header') Comics @endsection

@section('content')
    <div class="section-body">
        <h2 class="section-title">Data comics</h2>
        <p class="section-lead">
            Kumpulan semua data comics
        </p>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4><a class="btn btn-outline-primary" href="{{ route('comics.create') }}" role="button">Tambah data</a></h4>
                        <div class="card-header-form">
                            <form action="{{ route('comics.index') }}">
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
                                        <th>Author</th>
                                        <th>Avatar</th>
                                        <th>Genre</th>
                                        <th>Episode</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php $no = 0; ?>
                                    @foreach($comics as $data)
                                    <?php $no++ ?>
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>
                                            @foreach ($data->users as $item)
                                                <a href="{{ url('admin/users/'.$item->id) }}"><img alt="image" src="{{ asset('admin/assets/avatar/'.$item->avatar)}}" class="avatar mr-2" width="50" data-toggle="tooltip" title="{{ $item->name }}"></a>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if (!$data->thumbnail)
                                                <div class="gallery gallery-md">
                                                    <div class="gallery-item"  data-image="{{ asset('assets/img/avatar/avatar-1.png')}}" data-title="Image 1"></div>
                                                </div>
                                            @else
                                                <div class="gallery gallery-md">
                                                    <div class="gallery-item"  data-image="{{ asset('admin/assets/avatars/'.$data->thumbnail)}}" data-title="Image 1"></div>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @foreach ($data->genres as $item)
                                                {{ $item->name }},
                                            @endforeach
                                        </td>
                                        <td>
                                            @if (!$data->episodes == "")
                                                @foreach($data->episodes as $item)
                                                    @if ($item->name>"")
                                                        @switch($item->name)
                                                            @case(null)
                                                            Belum Memiliki Episode. <br><p> </p>
                                                            <a href="{{ route('episodes.create') }}">Buat Episode</a>
                                                                @break
                                                            @default
                                                            {{ $item->name }}
                                                        @endswitch
                                                    @endif
                                                @endforeach
                                            @else
                                                Belum Memiliki Episode. <br><p> </p>
                                                <a href="{{ route('episodes.create') }}">Buat Episode</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($data->status == 'ACTIVE')
                                                <span class="badge badge-primary">ACTIVE</span>
                                            @elseif ($data->status == 'INACTIVE')
                                                <span class="badge badge-danger">INACTIVE</span>
                                            @elseif ($data->status == 'END')
                                                <span class="badge badge-light">ENDED</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('comics.edit', ['id'=>$data->id]) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#delete-comic" data-name="{{ $data->name }}" data-id="{{ $data->id }}"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="10">{{$comics->appends(Request::all())->links()}}</td>
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
