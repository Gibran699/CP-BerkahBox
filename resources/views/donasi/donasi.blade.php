@extends('layouts.layouts')

@section('content')
<section class="donasi-section" style="margin-top: 110px;">
    <div class="container mb-5">
        <div class="d-flex align-items-center mb-4">
            <div class="stripe me-4"></div>
            <h2 class="sub-judul fw-bold">MARI BERDONASI</h2>
        </div>

        <div class="row align-items-start">
            <!-- Kolom Gambar -->
            <div class="col-md-6">
                <div class="card poster-card" style="padding: 15px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <img src="{{ asset('donasi/donasi.png') }}" class="img-fluid" alt="Poster Donasi" style="width: 100%; object-fit: contain;">
                </div>
            </div>

            <!-- Kolom Form -->
            <div class="col-md-6">
                <!-- Alert -->
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

                <!-- Pembungkus Form dengan Border dan Judul -->
                <div style="padding: 20px; background-color: white; border: 1px solid #dee2e6; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);">
                    <!-- Judul Form -->
                    <div class="text-center mb-4">
                        <h4 class="fw-bold">Form Pendataan Donasi</h4>
                        <p class="text-muted">Silakan isi data berikut untuk keperluan pendataan donasi.</p>
                        <p class="text-warning" style="font-size: 14px;"><em>Form ini bersifat opsional dan tidak wajib diisi.</em></p>
                    </div>

                    <!-- Form -->
                    <form action="{{ route('pengajuan.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Nama Donatur -->
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label">Nama Donatur</label>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" placeholder="Nama Donatur">
                        </div>

                        <!-- Nomor Telepon -->
                        <div class="mb-3">
                            <label for="no_telp" class="form-label">Nomor Telepon</label>
                            <input type="text" id="no_telp" name="no_telp" class="form-control" placeholder="08xxxxxxxxxx">
                        </div>

                        <!-- Nominal Donasi -->
                        <div class="mb-3">
                            <label for="nominal" class="form-label">Nominal Donasi</label>
                            <input type="text" id="nominal" name="nominal" class="form-control" placeholder="Rp 10.000">
                        </div>

                        <!-- Upload Bukti Transfer -->
                        <div class="mb-3">
                            <label for="bukti_transfer" class="form-label">Bukti Transfer</label>
                            <input type="file" class="form-control" id="bukti_transfer" name="bukti_transfer" accept="image/*">
                        </div>

                        <!-- Tombol Submit -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success w-100">SELESAI</button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</section>
@endsection

<script>
document.addEventListener("DOMContentLoaded", function () {
    const nominalInput = document.getElementById("nominal");

    nominalInput.addEventListener("input", function (e) {
        let value = nominalInput.value.replace(/[^0-9]/g, '');
        if (value) {
            nominalInput.value = formatRupiah(value, 'Rp ');
        } else {
            nominalInput.value = '';
        }
    });

    function formatRupiah(angka, prefix) {
        let number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa  = split[0].length % 3,
            rupiah  = split[0].substr(0, sisa),
            ribuan  = split[0].substr(sisa).match(/\d{3}/gi);
        
        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix === undefined ? rupiah : (rupiah ? prefix + rupiah : '');
    }
});
</script>
