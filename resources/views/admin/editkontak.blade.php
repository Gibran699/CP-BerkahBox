@extends('layouts.admin')

@section('title', 'Edit Kontak')

@section('contents')
    <div class="container">
        <a href="{{ route('admin.kontak') }}">
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
                        <h5 class="card-title text-center">Edit Kontak</h5>
                        <form action="{{ route('postEditKontak', $data->id_kontak) }}" method="POST">
                            @csrf
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Alamat</label>
                                <input type="text" class="form-control" name="alamat" value="{{ $data->alamat }}"
                                    required>
                                <span class="text-danger">
                                    @error('alamat')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group mt-4">
                                <label class="text-secondary mb-2">No Telepon</label>
                                <input type="text" class="form-control" name="no_telp" value="{{ $data->no_telp }}"
                                    required>
                                <span class="text-danger">
                                    @error('no_telp')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group mt-4">
                                <label class="text-secondary mb-2">Facebook</label>
                                <input type="text" class="form-control" name="facebook" value="{{ $data->facebook }}"
                                    required>
                                <span class="text-danger">
                                    @error('facebook')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group mt-4">
                                <label class="text-secondary mb-2">URL Maps</label>
                                <textarea class="form-control" name="maps_url" required>{{ $data->maps_url }}</textarea>
                                <span class="text-danger">
                                    @error('maps_url')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <button type="submit" class="btn btn-success mt-5">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
