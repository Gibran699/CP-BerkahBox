@extends('layouts.admin')

@section('title', 'Edit Pengajuan')

@section('contents')
    <div class="container">
        <a href="{{ route('admin.pengajuan') }}">
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
                        <h5 class="card-title text-center">Edit Pengajuan Donasi</h5>
                        <form action="/postEditPengajuan/{{ $data->id_pengajuan_donasi }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama_lengkap" required
                                    value="{{ $data->nama_lengkap }}">
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">No Telp</label>
                                <input type="number" class="form-control" name="no_telp" required
                                    value={{ $data->no_telp }}>
                            </div>

                            <div class="form-group mt-4">
                                <label class="text-secondary mb-2">Program Donasi</label>
                                <select class="form-control" name="id_program_donasi" required>
                                    @foreach ($program as $item)
                                        <option value="{{ $item->id_program_donasi }}"
                                            {{ $data->id_program_donasi == $item->id_program_donasi ? 'selected' : '' }}>
                                            {{ $item->nama_program }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('id_program_donasi')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>


                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Deskripsi</label>
                                <textarea class="form-control" name="desc_pengajuan" style="height: 250px" required>{{ $data->desc_pengajuan }}</textarea>
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Foto 1</label>
                                <input class="form-control mb-2" placeholder="Nama file lama: {{ $data->foto1 }}"
                                    disabled>
                                <input class="form-control" type="file" name="foto1">
                                <div class="form-text">Maksimal ukuran foto 5MB</div>
                                <img class="mt-3" style="width: 100px"
                                    src="{{ asset('/fotopengajuan/' . $data->foto1) }}" alt="foto pengajuan">
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Foto 2</label>
                                <input class="form-control mb-2" placeholder="Nama file lama: {{ $data->foto2 }}"
                                    disabled>
                                <input class="form-control" type="file" name="foto2">
                                <div class="form-text">Maksimal ukuran foto 5MB</div>
                                <img class="mt-3" style="width: 100px"
                                    src="{{ asset('/fotopengajuan/' . $data->foto2) }}" alt="foto pengajuan">
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Status</label>
                                <select class="form-control" name="status" required>
                                    <option value="Diterima" style="background-color: green; color: white;">Diterima
                                    </option>
                                    <option value="Pending" style="background-color: yellow; color: black;">Pending</option>
                                    <option value="Ditolak" style="background-color: red; color: white;">Ditolak</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success mt-1">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
