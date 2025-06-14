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
                        <h5 class="card-title text-center">Edit Sejarah</h5>
                        <form action="/postEditSejarah/{{ $data->id_sejarah }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Sejarah Paragraf 1</label>
                                <textarea class="form-control" name="tekssejarah" style="height: 250px" required>{{ $data->tekssejarah }}</textarea>
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Perjalanan Awal</label>
                                <textarea class="form-control" name="perjalananAwal" style="height: 250px" required>{{ $data->perjalananAwal }}</textarea>
                            </div>

                            {{-- Tambahan upload gambar --}}
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Gambar Perjalanan Awal (opsional)</label>
                                <input type="file" name="gambarSejarah" class="form-control" accept="image/*">
                                @if ($data->gambarSejarah)
                                    <div class="mt-2">
                                        <p class="text-muted mb-1">Gambar saat ini:</p>
                                        <img src="{{ asset($data->gambarSejarah) }}" alt="Gambar Saat Ini" class="img-fluid" style="max-height: 200px;">
                                    </div>
                                @endif
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Awal Pendirian</label>
                                <textarea class="form-control" name="awalPendirian" style="height: 250px" required>{{ $data->awalPendirian }}</textarea>
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Perkembangan</label>
                                <textarea class="form-control" name="perkembangan" style="height: 250px" required>{{ $data->perkembangan }}</textarea>
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Masa Kini</label>
                                <textarea class="form-control" name="masaKini" style="height: 250px" required>{{ $data->masaKini }}</textarea>
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Sejarah Paragraf 2 (Akhir)</label>
                                <textarea class="form-control" name="tekssejarah2" style="height: 250px" required>{{ $data->tekssejarah2 }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-success mt-5">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br><br><br>
    </div>
@endsection
