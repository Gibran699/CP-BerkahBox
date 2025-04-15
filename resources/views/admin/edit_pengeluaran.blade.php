@extends('layouts.admin')

@section('title', 'Edit Laporan Pengeluaran')

@section('contents')
    <div class="container">
        <!-- Tombol Kembali -->
        <a href="{{ route('admin.laporan_pengeluaran') }}" class="text-primary">
            <i class="bi bi-arrow-left h1"></i>
        </a>

        <div class="row">
            <div class="col d-flex justify-content-center">
                <div class="card mt-4" style="width: 800px">
                    <div class="card-body">
                        <h5 class="card-title text-center">Edit Laporan Pengeluaran</h5>

                        <!-- Form Edit -->
                        <form action="{{ route('admin.postEditPengeluaran', $pengeluaran->id) }}" method="POST">
                            @csrf

                            <!-- Tanggal -->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" required
                                    value="{{ $pengeluaran->tanggal }}">
                            </div>

                            <!-- Deskripsi -->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" required>{{ $pengeluaran->deskripsi }}</textarea>
                            </div>

                            <!-- Pengeluaran -->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Pengeluaran (Rp)</label>
                                <input type="number" class="form-control" name="pengeluaran" required
                                    value="{{ $pengeluaran->pengeluaran }}">
                            </div>

                            <!-- Masukan -->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Masukan (Rp)</label>
                                <input type="number" class="form-control" name="masukan" required
                                    value="{{ $pengeluaran->masukan }}">
                            </div>

                            <!-- Simpanan -->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Simpanan (Rp)</label>
                                <input type="number" class="form-control" name="simpanan"
                                    value="{{ $pengeluaran->simpanan }}">
                            </div>

                            <!-- Keterangan -->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Keterangan</label>
                                <textarea class="form-control" name="keterangan">{{ $pengeluaran->keterangan }}</textarea>
                            </div>

                            <!-- Tombol Simpan -->
                            <button type="submit" class="btn btn-success mt-3">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
