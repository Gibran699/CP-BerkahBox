@extends('layouts.admin')

@section('title', 'Edit Donasi Jemput')

@section('contents')
    <div class="container">
        <a href="{{ route('admin.donasi_jemput') }}">
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
                        <h5 class="card-title text-center">Edit Donasi Jemput</h5>
                        <form action="/postEditDonasijemput/{{ $data->id_donasi_jemput }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Nama Donatur</label>
                                <input type="text" class="form-control" name="nama_donatur" required
                                    value="{{ $data->nama_donatur }}">
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">No Hp</label>
                                <input type="number" class="form-control" name="no_hp" required
                                    value={{ $data->no_hp }}>
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
                                <label class="text-secondary mb-2">Barang Donasi</label>
                                <input type="text" class="form-control" name="barang_donasi" required
                                    value="{{ $data->barang_donasi }}">
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Foto Pengambilan</label>
                                <input class="form-control mb-2"
                                    placeholder="Nama file lama: {{ $data->foto_pengambilan }}" disabled>
                                <input class="form-control" type="file" name="foto_pengambilan">
                                <div class="form-text">Maksimal ukuran foto 5MB</div>
                                <img class="mt-3" style="width: 100px"
                                    src="{{ asset('/fotodonasijemput/' . $data->foto_pengambilan) }}"
                                    alt="foto pengambilan">
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Foto Penyerahan</label>
                                <input class="form-control mb-2" placeholder="Nama file lama: {{ $data->foto_penyerahan }}"
                                    disabled>
                                <input class="form-control" type="file" name="foto_penyerahan">
                                <div class="form-text">Maksimal ukuran foto 5MB</div>
                                <img class="mt-3" style="width: 100px"
                                    src="{{ asset('/fotodonasijemput/' . $data->foto_penyerahan) }}" alt="foto penyerahan">
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Status</label>
                                <select class="form-control" name="status" required>
                                    <option value="Diterima" style="background-color: green; color: white;">Diterima
                                    </option>
                                    <option value="Pending" style="background-color: yellow; color: black;">Pending</option>
                                    <option value="Belum Diterima" style="background-color: red; color: white;">Ditolak
                                    </option>
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
