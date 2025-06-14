@extends('layouts.admin')

@section('title', 'Tambah Donasi')

@section('contents')
    <div class="container">
        <a href="{{ route('admin.donasi') }}">
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
                        <h5 class="card-title text-center">Tambah Donasi</h5>
                        <form action="{{ route('postTambahDonasi') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Nama Lengkap -->
                            <div class="form-group mt-4">
                                <label class="text-secondary mb-2">Nama Lengkap</label>
                                <input type="text" class="form-control border border-secondary" name="nama_lengkap" required
                                    value="{{ old('nama_lengkap') }}">
                                <span class="text-danger">
                                    @error('nama_lengkap')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- No Telp -->
                            <div class="form-group mt-4">
                                <label class="text-secondary mb-2">No Telp</label>
                                <input type="text" class="form-control border border-secondary" name="no_telp" required
                                    value="{{ old('no_telp') }}">
                                <span class="text-danger">
                                    @error('no_telp')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Nominal -->
                            <div class="form-group mt-4">
                                <label class="text-secondary mb-2">Nominal Donasi</label>
                                <input type="number" class="form-control border border-secondary" name="nominal" required
                                    value="{{ old('nominal') }}">
                                <span class="text-danger">
                                    @error('nominal')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Bukti Transfer -->
                            <div class="form-group mt-4">
                                <label class="text-secondary mb-2">Bukti Transfer (Opsional)</label>
                                <input type="file" class="form-control border border-secondary" name="bukti_transfer"
                                    accept="image/*">
                                <span class="text-danger">
                                    @error('bukti_transfer')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <button type="submit" class="btn btn-success mt-5">Tambah Donasi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
