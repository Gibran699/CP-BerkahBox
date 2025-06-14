@extends('layouts.admin')

@section('title', 'Tambah Fasilitas')

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
                        <h5 class="card-title text-center">Tambah Fasilitas</h5>
                        <form action="{{ route('postTambahFasilitas') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Nama Fasilitas</label>
                                <input type="text" class="form-control" name="nama_fasilitas" required value="{{ old('nama_fasilitas') }}">
                            </div>
                            <br>
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" style="height: 150px" required>{{ old('deskripsi') }}</textarea>
                            </div>
                            <br>
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Gambar Fasilitas</label>
                                <input type="file" class="form-control" name="gambar_fasilitas" accept="image/*" required>
                            </div>

                            <button type="submit" class="btn btn-success mt-5">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br><br><br>
    </div>
@endsection
