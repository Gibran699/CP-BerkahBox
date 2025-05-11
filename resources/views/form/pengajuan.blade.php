@extends('layouts.layouts')

@section('content')
    <section id="form-pengajuan-donasi" style="margin-top: 110px;">
        <div class="container mt-2">
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
        <div
            style="max-width: 600px; margin: 50px auto; padding: 30px; background-color: white; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.8); border-radius: 8px;">

            <!-- Logo -->
            <div class="logo py-3" style="text-align: center;">
                <img src="../icon/logo.png" alt="Berkah Box Balikpapan" style="width: 80px; margin-bottom: 20px;">
                <h3 class="sub-judul" style="color: #6b6b6b; font-size: 20px">BERKAH BOX</h3>
                <h2 class="sub-judul fw-bold mb-3" style="color: #000000; font-size: 25px">FORM
                    PENGAJUAN DONASI</h2>
            </div>

            <!-- Form -->
            <form action="{{ route('pengajuan.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Nama Lengkap -->
                <div style="margin-bottom: 10px;">
                    <label for="nama_lengkap" style="font-size: 14px; color: #333;">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap"
                        style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;">
                </div>

                <!-- Nomor Telepon -->
                <div style="margin-bottom: 20px;">
                    <label for="no_telp" style="font-size: 14px; color: #333;">Nomor Telepon</label>
                    <input type="text" id="no_telp" name="no_telp" placeholder="08534567xxx"
                        style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;">
                </div>

                <!-- Kategori Donasi -->
                <div style="margin-bottom: 20px;">
                    <label for="kategori-donasi" style="font-size: 14px; color: #333;">Kategori Donasi</label>
                    <select id="kategori-donasi" name="id_program_donasi" required
                        style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;">
                        <option value="" disabled selected>Pilih Kategori</option>
                        @foreach ($program as $programs)
                            <option value="{{ $programs->id_program_donasi }}">{{ $programs->nama_program }}</option>
                        @endforeach
                    </select>

                </div>

                <!-- Deskripsi Pengajuan -->
                <div style="margin-bottom: 20px;">
                    <label for="desc_pengajuan" style="font-size: 14px; color: #333;">Deskripsi Pengajuan</label>
                    <textarea id="desc_pengajuan" name="desc_pengajuan" placeholder="Deskripsi kondisi tentang donasi yang ingin diajukan"
                        style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px; height: 100px;"></textarea>
                </div>

                <!-- Foto Kondisi -->
                <div class="mt-3">
                    <label style="font-size: 14px;">Foto Bukti</label>
                    <!-- Foto 1 -->
                    <div style="display: flex; align-items: center;">
                        <input type="file" id="foto1" name="foto1" required
                            style="flex-grow: 1; width: auto; background-color: #f1f1f1; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                    </div>
                    <!-- Foto 2 -->
                    <div class="mt-3" style="display: flex; align-items: center;">
                        <input type="file" id="foto2" name="foto2" required
                            style="flex-grow: 1; width: auto; background-color: #f1f1f1; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-4 mb-3" style="text-align: center;">
                    <button type="submit" class="btn btn-success"
                        style="width: 100%; padding: 5px; margin-top: 5px; cursor: pointer;">
                        AJUKAN
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
