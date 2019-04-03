@extends('layouts.admin')

@section('title') Profile @endsection

@section('header') My Profile @endsection

@section('content')

<div class="section-body">
    <h2 class="section-title">{{ Auth::user()->name }}</h2>
    <p class="section-lead">
        Halo, {{ Auth::user()->name }}
    </p>

    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-5">
            <div class="card">
                <div class="card-header">
                  <h4>Avatar</h4>
                  <div class="card-header-action">
                    <a data-collapse="#mycard-collapse" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                  </div>
                </div>
                <div class="collapse show" id="mycard-collapse">
                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data" action="{{ route('admin.profile.submit', Auth::user()->id) }}">
                        @csrf
                        @method('PATCH')
                    <div class="card-body">
                        @if(Auth::user()->avatar)
                        <div class="mb-2 text-muted">Click the picture below to see the magic!</div>
                            <div class="chocolat-parent">
                            <a href="{{ asset('admin/profile/'.Auth::user()->avatar)}}" class="chocolat-image" title="Just an example">
                                <div data-crop-image="285">
                                <img alt="image" src="{{ asset('admin/profile/'.Auth::user()->avatar)}}" class="img-fluid">
                                </div>
                            </a>
                            </div>
                        </div>
                        @else
                        <div class="mb-2 text-muted">Click the picture below to see the magic!</div>
                            <div class="chocolat-parent">
                            <a href="{{ asset('assets/img/example-image.jpg')}}" class="chocolat-image" title="Just an example">
                                <div data-crop-image="285">
                                <img alt="image" src="{{ asset('assets/img/example-image.jpg')}}" class="img-fluid">
                                </div>
                            </a>
                            </div>
                        </div>
                        @endif
                        <center>
                            <div class="form-group" style="width: 80%;">
                                <input name="avatar" type="file" class="form-control">
                            </div>
                        </center>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
              </div>

              @include('admin.profile.edit')
        </div>
    </div>
</div>

@endsection
