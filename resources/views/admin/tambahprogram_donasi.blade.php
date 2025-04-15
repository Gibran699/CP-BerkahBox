@extends('layouts.admin')

@section('title', 'Tambah Program Donasi')

@section('contents')
    <div class="container">
        <a href="{{ route('admin.tambahprogram_donasi') }}">
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
                        <h5 class="card-title text-center">Tambah Program</h5>
                        <form action="{{ route('postTambahProgram') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Nama Program</label>
                                <input type="text" class="form-control border border-secondary form-control"
                                    name="nama_program" required value="{{ old('nama_program') }}">

                                <span class="text-danger">
                                    @error('nama_program')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Tittle</label>
                                <input type="text" class="form-control border border-secondary form-control"
                                    name="tittle" required value="{{ old('tittle') }}">

                                <span class="text-danger">
                                    @error('tittle')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" placeholder="Tulis Deskripsi Program...." style="height: 250px" required
                                    value="{{ old('deskripsi') }}"></textarea>
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Foto 1</label>
                                <input type="file" class="form-control" name="foto">
                                <div class="form-text">Maksimal ukuran gambar 5Mb</div>
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Foto 2</label>
                                <input type="file" class="form-control" name="foto2">
                                <div class="form-text">Maksimal ukuran gambar 5Mb</div>
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Foto 3</label>
                                <input type="file" class="form-control" name="foto3">
                                <div class="form-text">Maksimal ukuran gambar 5Mb</div>
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Tanggal Mulai</label>
                                <input type="date" class="form-control" name="tanggal_mulai" required
                                    value="{{ old('tanggal_mulai') }}">
                                <span class="text-danger">
                                    @error('tanggal_mulai')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Tanggal Selesai</label>
                                <input type="date" class="form-control" name="tanggal_selesai" required
                                    value="{{ old('tanggal_selesai') }}">
                                <span class="text-danger">
                                    @error('tanggal_selesai')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <button type="submit" class="btn btn-success mt-3">Tambah Program</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
