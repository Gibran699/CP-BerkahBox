@extends('layouts.admin')

@section('title', 'Tambah Galeri')

@section('contents')
    <div class="container">
        <a href="{{ route('admin.tambahgaleri') }}">
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
                        <h5 class="card-title text-center">Tambah</h5>
                        <form action="{{ route('postTambahGaleri') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mt-1">
                                <label class="text-secondary">Tanggal</label>
                                <input type="date" class="form-control border border-secondary form-control"
                                    name="tanggal" required value="{{ old('tanggal') }}">

                                <span class="text-danger">
                                    @error('tanggal')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary">Foto</label>
                                <input type="file" class="form-control" name="foto">
                                <div class="form-text">Maksimal ukuran gambar 5Mb</div>
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" style="height: 250px" required value="{{ old('deskripsi') }}"></textarea>
                            </div>

                            <button type="submit" class="btn btn-success mt-1">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
