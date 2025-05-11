@extends('layouts.admin')

@section('title', 'Tambah Struktur Organisasi Berkah Box Balikpapan')

@section('contents')
    <div class="container">
        <a href="{{ route('admin.tambahstruktur_yayasan') }}">
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
                        <h5 class="card-title text-center">Tambah</h5>
                        <form action="{{ route('postTambahStruktur') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Nama Pengurus</label>
                                <input type="text" class="form-control border border-secondary form-control"
                                    name="nama_pengurus" required value="{{ old('nama_pengurus') }}">

                                <span class="text-danger">
                                    @error('nama_pengurus')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Jabatan</label>
                                <!-- Dropdown untuk jabatan -->
                                <select class="form-control" name="jabatan" required>
                                    <option value="Pembina Berkah Box Balikpapan"
                                        {{ old('jabatan') == 'Pembina Berkah Box Balikpapan' ? 'selected' : '' }}>Pembina
                                        Berkah Box Balikpapan</option>
                                    <option value="Ketua Berkah Box Balikpapan"
                                        {{ old('jabatan') == 'Ketua Berkah Box Balikpapan' ? 'selected' : '' }}>Ketua
                                        Berkah Box Balikpapan</option>
                                    <option value="Sekretaris Berkah Box Balikpapan"
                                        {{ old('jabatan') == 'Sekretaris Berkah Box Balikpapan' ? 'selected' : '' }}>
                                        Sekretaris Berkah Box Balikpapan</option>
                                    <option value="Bendahara Berkah Box Balikpapan"
                                        {{ old('jabatan') == 'Bendahara Berkah Box Balikpapan' ? 'selected' : '' }}>
                                        Bendahara Berkah Box Balikpapan</option>
                                    <option value="Ketua Pengawas Berkah Box Balikpapan"
                                        {{ old('jabatan') == 'Ketua Pengawas Berkah Box Balikpapan' ? 'selected' : '' }}>
                                        Ketua Pengawas Berkah Box Balikpapan</option>
                                    <option value="Anggota Berkah Box Balikpapan"
                                        {{ old('jabatan') == 'Anggota Berkah Box Balikpapan' ? 'selected' : '' }}>Anggota
                                        Berkah Box Balikpapan</option>
                                </select>
                            </div>

                            <div class="form-group mt-2">
                                <label class="text-secondary mb-2">Foto Pengurus</label>
                                <input type="file" class="form-control" name="foto_pengurus">
                                <div class="form-text">Maksimal ukuran gambar 5Mb</div>
                            </div>

                            <button type="submit" class="btn btn-success mt-3">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br><br><br>
    </div>
@endsection
