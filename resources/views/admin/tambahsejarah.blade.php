@extends('layouts.admin')

@section('title', 'Tambah Sejarah')

@section('contents')
    <div class="container">
        <a href="{{ route('admin.tambahsejarah') }}">
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
                        <h5 class="card-title text-center">Tambah</h5>
                        <form action="{{ route('postTambahSejarah') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Sejarah Paragraf 1</label>
                                <textarea class="form-control" name="tekssejarah" style="height: 250px" required>{{ old('tekssejarah') }}</textarea>
                            </div>
                            <br>
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Perjalanan Awal</label>
                                <textarea class="form-control" name="perjalananAwal" style="height: 250px" required>{{ old('perjalananAwal') }}</textarea>
                            </div>
                            <br>
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Upload Gambar Perjalanan Awal</label>
                                <input type="file" name="gambarSejarah" class="form-control" accept="image/*" required>
                            </div>
                            <br>
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Awal Pendirian</label>
                                <textarea class="form-control" name="awalPendirian" style="height: 250px" required>{{ old('awalPendirian') }}</textarea>
                            </div>
                            <br>
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Perkembangan</label>
                                <textarea class="form-control" name="perkembangan" style="height: 250px" required>{{ old('perkembangan') }}</textarea>
                            </div>
                            <br>
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Masa Kini</label>
                                <textarea class="form-control" name="masaKini" style="height: 250px" required>{{ old('masaKini') }}</textarea>
                            </div>
                            <br>
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Sejarah Paragraf 2 (Akhir)</label>
                                <textarea class="form-control" name="tekssejarah2" style="height: 250px" required>{{ old('tekssejarah2') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-success mt-5">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br><br><br>
    </div>
@endsection
