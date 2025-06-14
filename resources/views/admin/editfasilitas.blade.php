@extends('layouts.admin')

@section('title', 'Edit Fasilitas')

@section('contents')
    <div class="container">
        <a href="{{ route('admin.fasilitas') }}">
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
                    <strong>Gagal!</strong> {{ Session::get('failed') }}
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
                        <h5 class="card-title text-center">Edit Fasilitas</h5>
                        <form action="{{ route('postEditFasilitas', $data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Nama Fasilitas</label>
                                <input type="text" class="form-control" name="nama_fasilitas" required value="{{ $data->nama_fasilitas }}">
                            </div>
                            <br>
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" style="height: 150px" required>{{ $data->deskripsi }}</textarea>
                            </div>
                            <br>
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Gambar Fasilitas (Opsional)</label>
                                <input type="file" class="form-control" name="gambar_fasilitas" accept="image/*">
                                @if ($data->gambar_fasilitas)
                                    <small class="text-muted">Gambar saat ini:</small><br>
                                    <img src="{{ asset('fasilitas/' . $data->gambar_fasilitas) }}" alt="Current Image" width="150" class="mt-2">
                                @endif
                            </div>

                            <button type="submit" class="btn btn-success mt-5">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br><br><br>
    </div>
@endsection
