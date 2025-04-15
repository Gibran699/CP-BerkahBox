@extends('layouts.admin')

@section('title', 'Tambah Laporan Pengeluaran')

@section('contents')
    <div class="container">
        <a href="{{ route('admin.laporan_pengeluaran') }}">
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
                        <h5 class="card-title text-center">Tambah Laporan Pengeluaran</h5>
                        <form action="{{ route('admin.postTambahPengeluaran') }}" method="POST">
                            @csrf

                            <!-- Tanggal -->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Tanggal</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                    name="tanggal" required value="{{ old('tanggal') }}">
                                @error('tanggal')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Uraian Kegiatan</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" required>{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Masukan -->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Masukan (Rp)</label>
                                <input type="number" class="form-control @error('masukan') is-invalid @enderror"
                                    name="masukan" required value="{{ old('masukan') }}">
                                @error('masukan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Pengeluaran -->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Pengeluaran (Rp)</label>
                                <input type="number" class="form-control @error('pengeluaran') is-invalid @enderror"
                                    name="pengeluaran" required value="{{ old('pengeluaran') }}">
                                @error('pengeluaran')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Simpanan -->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Simpanan (Rp) (Opsional)</label>
                                <input type="number" class="form-control @error('simpanan') is-invalid @enderror"
                                    name="simpanan" value="{{ old('simpanan') }}">
                                @error('simpanan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Keterangan -->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Keterangan (Opsional)</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan">{{ old('keterangan') }}</textarea>
                                @error('keterangan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tombol Simpan -->
                            <button type="submit" class="btn btn-success mt-3">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br><br><br>
    </div>
@endsection
