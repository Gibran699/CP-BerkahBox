@extends('layouts.layouts')

<section class="donasi-section" style="margin-top: 110px;">
    <div class="container">
        <div class="d-flex align-items-center mb-4">
            <div class="stripe me-4"></div>
            <h2 class="sub-judul fw-bold">MARI BERDONASI</h2>
        </div>

        <!-- Display the poster in a card with smaller size -->
        <div class="text-center mb-4">
            <div class="card poster-card mx-auto" style="max-width: 500px; padding: 15px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <img src="{{ asset('donasi/donasi.png') }}" class="img-fluid" alt="Poster Donasi" style="width: 100%; object-fit: contain;">
            </div>
        </div>

        @foreach ($programs as $program)
            @php
                // hitung total donasi
                $totalDonasi = \App\Models\Donasi::where('id_program_donasi', $program->id_program_donasi)
                    ->where('status', 'success')
                    ->sum('nominal');

                $tanggalSelesai = \Carbon\Carbon::parse($program->tanggal_selesai);
                $tanggalSekarang = \Carbon\Carbon::now();

                $isDonasiDitutup = $tanggalSelesai->lt($tanggalSekarang);
            @endphp

            <div class="row mb-5 gradient-background align-items-center" style="overflow: hidden; min-height: 450px;">
                <div class="col-lg-6 p-0 position-relative">
                    <img src="{{ asset('foto/' . $program->foto) }}" class="img-fluid"
                        style="width: 100%; height: 100%; object-fit: cover; min-height: 450px; max-height: 450px;"
                        alt="{{ $program->nama_program }}">
                    <a href="{{ route('donasi.infodonasi', ['id_program_donasi' => $program->id_program_donasi]) }}"
                        class="btn btn-outline-secondary position-absolute"
                        style="bottom: 20px; left: 50%; transform: translateX(-50%); background-color: rgba(255, 255, 255, 0.7); padding: 8px 20px; border-radius: 20px;">Selengkapnya</a>
                </div>
                <div class="col-lg-6 d-flex flex-column justify-content-center p-4">
                    <div class="card"
                        style="border-radius: 20px; padding: 20px; background-color: #ffffff; border: none;">
                        <h2 class="sub-judul fw-bold text-center mb-3">{{ strtoupper($program->nama_program) }}</h2>
                        <h4 class="sub-judul" style="font-size: 18px">_Ayo Bantu!</h4>
                        <p class="text-muted" style="text-align: justify; font-size: 15px">
                            {{ \Illuminate\Support\Str::limit($program->deskripsi, 100) }}</p>
                        <p class="text-muted" style="text-align: justify; font-size: 15px">
                            Jazakallahu Khairan untuk semua donatur Berkah Box Balikpapan yang berdonasi. Insya Allah
                            berkah Rezeki dan menjadi ladang Amal Dunia Akhirat.
                        </p>

                        <div class="d-flex justify-content-between">
                            <p class="text-success fw-bold mb-0">Total: Rp
                                {{ number_format($totalDonasi, 0, ',', '.') }}</p>
                            <p class="text-danger mb-0">Berakhir: {{ $tanggalSelesai->translatedFormat('d F Y') }}</p>
                        </div>

                        <div class="text-center mt-3">
                            @if ($isDonasiDitutup)
                                <div class="btn btn-danger mb-2 w-100">Maaf, donasi sudah ditutup</div>
                            @else
                                <a class="btn btn-success mb-2 w-100"
                                    href="{{ route('donasi.formdonasi', ['id_program_donasi' => $program->id_program_donasi]) }}">
                                    Donasi Sekarang
                                </a>
                            @endif

                            <button class="btn btn-outline-primary w-100" style="border-radius: 20px;"
                                onclick="shareDonasi('{{ $program->nama_program }}')">Bagikan</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- JavaScript untuk Bagikan --}}
        <script>
            function shareDonasi(donasiTitle) {
                if (navigator.share) {
                    navigator.share({
                        title: donasiTitle,
                        text: `Ayo berpartisipasi dalam ${donasiTitle}. Klik di sini untuk mendukung!`,
                        url: window.location.href
                    }).then(() => {
                        console.log('Terima kasih telah membagikan!');
                    }).catch((error) => {
                        console.error('Error membagikan:', error);
                    });
                } else {
                    alert('Fitur bagikan tidak didukung di browser Anda.');
                }
            }
        </script>
</section>
