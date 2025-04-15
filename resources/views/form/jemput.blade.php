@extends('layouts.layouts')

@section('content')
    <section id="form-pickupcare" style="margin-top: 110px;">
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
                <h2 class="sub-judul fw-bold mb-3" style="color: #000000; font-size: 25px">FORM DONASI JEMPUT</h2>
            </div>

            <!-- Form -->
            <form action="{{ route('jemput.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Nama Donatur -->
                <div style="margin-bottom: 20px;">
                    <label for="nama_donatur" style="font-size: 14px;">Nama Donatur</label>
                    <input type="text" id="nama_donatur" name="nama_donatur" placeholder="Nama Donatur"
                        style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;">
                </div>

                <!-- Nomor Telepon Pickupcare -->
                <div style="margin-bottom: 20px;">
                    <label for="no_hp" style="font-size: 14px;">Nomor Telepon Donatur</label>
                    <input type="text" id="no_hp" name="no_hp" placeholder="08534567xxx"
                        style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;">
                </div>

                {{-- Barang Donasi --}}
                <div style="margin-bottom: 20px;">
                    <label for="barang_donasi" style="font-size: 14px;">Barang Donasi</label>
                    <input type="text" id="barang_donasi" name="barang_donasi"
                        placeholder="Sembako atau Uang sejumlah..."
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

                <!-- Dokuemntasi Pengambilan -->
                <label style="margin-bottom: 10px; font-size: 14px;">Dokumentasi Pengambilan</label>
                <div style="display: flex; align-items: center;">
                    <input type="file" id="foto_pengambilan" name="foto_pengambilan" required
                        style="flex-grow: 1; width: auto; background-color: #f1f1f1; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                </div>

                <!-- Submit Button -->
                <div class="mt-3" style="text-align: center;">
                    <button type="submit" class="btn btn-success"
                        style="width: 100%; padding: 5px; margin-top: 5px; cursor: pointer;">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
