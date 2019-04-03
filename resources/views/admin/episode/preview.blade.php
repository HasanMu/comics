@extends('layouts.admin')

@section('title') Episodes @endsection

@section('header') Episodes @endsection

@section('content')
    <div class="section-body">
        <h2 class="section-title">{{ $episode->name }}</h2>
        <p class="section-lead">
            @foreach ($episode->comics as $item)
                Nama komik : <a href="{{ route('comics.edit', $item->id) }}">{{ $item->name }}</a>
            @endforeach
        </p>

        <center>
            <img src="{{ asset('admin/assets/episodes/file/'.$episode->file) }}" style="width: 60%; height: 100%;" alt="">
        </center>
    </div>
@endsection
