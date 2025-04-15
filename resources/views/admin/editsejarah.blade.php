@extends('layouts.admin')

@section('title', 'Edit Sejarah')

@section('contents')
    <div class="container">
        <a href="{{ route('admin.sejarah') }}">
            <i class="bi-arrow-left h1"></i>
        </a>

        <div class="container mt-3">
            @if (Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> {{ Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (Session::get('failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal!</strong> {{ Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col d-flex justify-content-center">
                <div class="card mt-4" style="width: 800px">
                    <div class="card-body">
                        <h5 class="card-title text-center">Edit Sejarah</h5>
                        <form action="/postEditSejarah/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Sejarah Paragraf 1</label>
                                <textarea class="form-control" name="tekssejarah" style="height: 250px" required>{{ $data->tekssejarah }}</textarea>
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Sejarah Paragraf 2</label>
                                <textarea class="form-control" name="tekssejarah2" style="height: 250px" required>{{ $data->tekssejarah2 }}</textarea>
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Sejarah Paragraf 3</label>
                                <textarea class="form-control" name="tekssejarah3" style="height: 250px" required>{{ $data->tekssejarah3 }}</textarea>
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Sejarah Paragraf 4</label>
                                <textarea class="form-control" name="tekssejarah4" style="height: 250px" required>{{ $data->tekssejarah4 }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-success mt-5">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br><br><br>
    </div>
@endsection
