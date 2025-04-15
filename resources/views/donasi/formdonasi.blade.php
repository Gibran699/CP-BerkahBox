@extends('layouts.layouts')

@section('content')
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
    <section id="form-pengajuan-donasi" style="margin-top: 110px;">
        <div
            style="max-width: 600px; margin: 50px auto; padding: 30px; background-color: white; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.8); border-radius: 8px;">

            <!-- Logo -->
            <div class="logo py-3" style="text-align: center;">
                <img src="../icon/logo.png" alt="Berkah Box Balikpapan" style="width: 80px; margin-bottom: 20px;">
                <h3 class="sub-judul" style="color: #6b6b6b; font-size: 20px">BERKAH BOX BALIKPAPAN</h3>
                <h2 class="sub-judul fw-bold mb-5" style="color: #000000; font-size: 25px">SEDEKAH JUM'AT RUTIN</h2>
            </div>

            <!-- Form -->
            <form id="donasi-form" class="form mb-5" action="{{ route('donasi.lanjut-pembayaran') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <!-- Nominal -->
                <h5 class="fw-bold" style="color: #004803">Sedekah Jum'at Rutin</h5>
                <div style="margin-bottom: 20px;">
                    <label for="nominal" style="font-size: 14px; color: #333;">Nominal</label>
                    <div class="d-flex justify-content-between mt-2">
                        <button type="button" class="btn btn-outline-secondary nominal-btn" data-nominal="30000">Rp
                            30.000</button>
                        <button type="button" class="btn btn-outline-secondary nominal-btn" data-nominal="50000">Rp
                            50.000</button>
                        <button type="button" class="btn btn-outline-secondary nominal-btn" data-nominal="70000">Rp
                            70.000</button>
                        <button type="button" class="btn btn-outline-secondary nominal-btn" data-nominal="100000">Rp
                            100.000</button>
                    </div>
                </div>

                <!-- Nominal Lainnya -->
                <div style="margin-bottom: 20px;">
                    <label for="nominal-lainnya" style="font-size: 14px; color: #333;">Nominal Lainnya</label>
                    <input type="text" id="nominal-lainnya" name="nominal" placeholder="Rp"
                        style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;">
                    <small class="text-muted">Minimum donasi Rp 10.000</small>
                </div>

                <!-- Nama Program Donasi -->
                <div style="margin-bottom: 20px;">
                    <label for="kategori-donasi" style="font-size: 14px; color: #333;">Kategori Donasi</label>
                    @if ($program)
                        <input type="text" id="kategori-donasi" value="{{ $program->nama_program }}" readonly
                            style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;">
                        <input type="hidden" name="id_program_donasi" value="{{ $program->id_program_donasi }}">
                    @else
                        <input type="text" id="kategori-donasi" value="Program Tidak Ditemukan" readonly
                            style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;">
                    @endif
                </div>

                <!-- Info Donatur -->
                @if (!auth()->check())
                    <div class="info-donatur">
                        <p>Info Donatur</p>
                        <a class="mb-5" style="font-size: 10px; color: #0ba510" href="{{ route('auth.login') }}">Masuk
                            Akun <a style="text-decoration: none; color: black; font-size: 10px" href="">atau
                                lengkapi data di bawah ini</a></a>
                        <div style="margin-bottom: 20px;">
                            <label for="nama_donatur" style="font-size: 14px; color: #333;">Nama Lengkap</label>
                            <input type="text" id="nama_donatur" name="nama_donatur" placeholder="Nama Lengkap"
                                style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;">
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label for="no_telp" style="font-size: 14px; color: #333;">Nomor HP</label>
                            <input type="text" id="no_telp" name="no_telp" placeholder="085234567xxx"
                                style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;">
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label for="email" style="font-size: 14px; color: #333;">Email</label>
                            <input type="email" id="email" name="email" placeholder="berkahbox@gmail.com"
                                style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px;">
                        </div>
                    </div>
                @else
                    <div class="info-donatur">
                        <p>Anda sudah login sebagai <strong>{{ auth()->user()->name }}</strong>. Informasi donasi akan
                            otomatis terhubung dengan akun Anda.</p>
                    </div>
                @endif

                <!-- Submit Button -->
                <div class="mt-3" style="text-align: center;">
                    <button type="submit" class="btn btn-success">LANJUT PEMBAYARAN</button>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        const nominalButtons = document.querySelectorAll('.nominal-btn');
        const nominalLainnyaInput = document.getElementById('nominal-lainnya');

        nominalButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Jika tombol yang diklik sudah active, maka batalkan pilihan
                if (this.classList.contains('active')) {
                    this.classList.remove('active');
                    nominalLainnyaInput.value = ''; // Kosongkan kolom Nominal Lainnya jika batal dipilih
                } else {
                    // Hapus kelas 'active' dari semua tombol
                    nominalButtons.forEach(btn => btn.classList.remove('active'));

                    // Tambahkan kelas 'active' ke tombol yang diklik
                    this.classList.add('active');

                    // Ambil nilai dari tombol yang diklik
                    const nominalValue = this.getAttribute('data-nominal');
                    nominalLainnyaInput.value = nominalValue; // Isi kolom Nominal Lainnya
                }
            });
        });
    </script>
@endsection
