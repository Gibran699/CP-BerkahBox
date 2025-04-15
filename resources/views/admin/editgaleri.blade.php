@extends('layouts.admin')

@section('title', 'Edit Galeri')

@section('contents')

    <div class="container">
        <a href="{{ route('admin.galeri') }}">
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
                        <h5 class="card-title text-center">Edit Galeri</h5>
                        <form action="/postEditGaleri/{{ $data->id_galerii }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mt-4">
                                <label class="text-secondary mb-2">Tanggal</label>
                                <input type="date" class="form-control border border-secondary form-control"
                                    name="tanggal" required value={{ $data->tanggal }}>

                                <span class="text-danger">
                                    @error('tanggal')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Foto</label>
                                <input class="form-control mb-2"
                                    placeholder="Nama file lama: {{ asset('foto/' . $data->foto) }}" disabled>
                                <input class="form-control" type="file" name="foto">
                                <div class="form-text">Maksimal ukuran foto 5MB</div>
                                <img class="mt-3" style="width: 100px" src="{{ asset('/foto/' . $data->foto) }}"
                                    alt="galeri kegiatan">
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" style="height: 250px" required>{{ $data->deskripsi }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-success mt-3">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
