@extends('layouts.admin')

@section('title', 'Edit Program')

@section('contents')
    <div class="container">
        <a href="{{ route('admin.program_donasi') }}">
            <i class="bi-arrow-left h1"></i>
        </a>

        <div class="container mt-3">
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif

            @if (Session::has('failed'))
                <div class="alert alert-danger">
                    {{ Session::get('failed') }}
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col d-flex justify-content-center">
                <div class="card mt-4" style="width: 800px">
                    <div class="card-body">
                        <h5 class="card-title text-center">Update Program</h5>
                        <form action="/postEditProgram/{{ $data->id_program_donasi }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Nama Program</label>
                                <input type="text" class="form-control border border-secondary form-control"
                                    name="nama_program" required value="{{ $data->nama_program }}">

                                <span class="text-danger">
                                    @error('nama_program')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Tittle</label>
                                <input type="text" class="form-control border border-secondary form-control"
                                    name="tittle" required value="{{ $data->tittle }}">

                                <span class="text-danger">
                                    @error('tittle')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" style="height: 250px" required>{{ $data->deskripsi }}</textarea>
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Foto 1</label>
                                <input class="form-control mb-2" placeholder="Nama file lama: {{ $data->foto }}" disabled>
                                <input class="form-control" type="file" name="foto">
                                <div class="form-text">Maksimal ukuran foto 5MB</div>
                                <img class="mt-3" style="width: 100px" src="{{ asset('/foto/' . $data->foto) }}"
                                    alt="foto program">
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Foto 2</label>
                                <input class="form-control mb-2" placeholder="Nama file lama: {{ $data->foto2 }}"
                                    disabled>
                                <input class="form-control" type="file" name="foto2">
                                <div class="form-text">Maksimal ukuran foto 5MB</div>
                                <img class="mt-3" style="width: 100px" src="{{ asset('/foto/' . $data->foto2) }}"
                                    alt="foto program">
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Foto 3</label>
                                <input class="form-control mb-2" placeholder="Nama file lama: {{ $data->foto3 }}"
                                    disabled>
                                <input class="form-control" type="file" name="foto3">
                                <div class="form-text">Maksimal ukuran foto 5MB</div>
                                <img class="mt-3" style="width: 100px" src="{{ asset('/foto/' . $data->foto3) }}"
                                    alt="foto program">
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Tanggal Mulai</label>
                                <input type="date" class="form-control" name="tanggal_mulai" required
                                    value="{{ $data->tanggal_mulai }}">
                                <span class="text-danger">
                                    @error('tanggal_mulai')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Tanggal Selesai</label>
                                <input type="date" class="form-control" name="tanggal_selesai" required
                                    value="{{ $data->tanggal_selesai }}">
                                <span class="text-danger">
                                    @error('tanggal_selesai')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <button type="submit" class="btn btn-success mt-3">Update Program</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
