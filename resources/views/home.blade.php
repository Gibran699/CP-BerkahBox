@extends('layouts.layouts')
{{-- Hero --}}
<section id="hero" class="text-center text-white py-3"
    style="background-image: url('../images/bg.jpeg'); background-size:100%; ">
</section>


{{-- border --}}
<section id="border">
    <div class="container">
        <div class="row justify-content-center">
            {{-- Ganti Donasi Terkumpul dengan Jadwal Sholat --}}
            <div class="col-12 col-sm-6 col-md-4">
                <div class="border-item text-center shadow rounded">
                    <img src="../icon/man_14788065.png" alt="Jadwal Sholat">
                    <h5>Jadwal Sholat <span style="font-weight: bold; color: #fd7e14;">{{ $sholatBerikutnya['nama'] }}</span></h5>
                    <p>{{ $sholatBerikutnya['jam'] }} WITA</p>
                </div>
            </div>
            {{-- Tetap --}}
            <div class="col-12 col-sm-6 col-md-4">
                <div class="border-item text-center shadow rounded">
                    <img src="../icon/ikon2.png" alt="Pengajuan Donasi">
                    <h5>Pengajuan Donasi</h5>
                    <p>{{ $jumlahPengajuan }}</p>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="border-item text-center shadow rounded">
                    <img src="../icon/ikon3.png" alt="Jumlah Donatur">
                    <h5>Jumlah Donatur</h5>
                    <p>{{ $jumlahDonatur }}</p>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- border --}}


{{-- ajukan donasi --}}
<section id="ajukandonasi" class="py-3">
    <div class="container" style="padding-left: 5px; padding-right: 5px;">
        <div class="row d-flex align-items-center">
            <!-- Bagian Teks -->
            <div class="col-lg-6 col-md-12 text-center text-lg-start" data-aos="fade-right">
                <div class="d-flex align-items-center">
                    <div class="stripe me-4"></div>
                    <h2 class="sub-judul fw-bold py-3">AJUKAN DONASI</h2>
                </div>
                <h4 class="fw-bold">SEDERHANA DAN BERMAKNA</h4>
                <p style="text-align: justify; font-size: 16px;">"Mari berkontribusi untuk perubahan positif untuk
                    lingkungan sekitar
                    dengan pengajuan donasi. Satu langkah kecil untuk memberikan dampak besar."</p>
                <a href="{{ route('form.pengajuan') }}" class="btn btn-success btn-ajukan">Ajukan</a>
            </div>
            <!-- Bagian Gambar -->
            <div class="col-lg-6 col-md-12 d-flex justify-content-center mt-4 mt-lg-0" data-aos="fade-left">
                <img src="../images/ajukandonasi.jpg" class="img-banner" alt="Donasi">
            </div>
        </div>
    </div>
</section>



{{-- end ajukan --}}

{{-- donasi dan program --}}
<section id="program">
    <div class="container py-3">
        <div class="d-flex align-items-center mb-3">
            <div class="stripe me-4"></div>
            <h2 class="sub-judul fw-bold">MARI BERDONASI</h2>
        </div>
        <div class="row col-xxl-11 mx-auto" data-aos="fade-up">
            @foreach ($program as $program)
                @php
                    // Menghitung total donasi yang sudah terkumpul
                    $totalDonasi = \App\Models\Donasi::where('id_program_donasi', $program->id_program_donasi)
                        ->where('status', 'success')
                        ->sum('nominal');

                    // Format tanggal selesai
                    $tanggalSelesai = \Carbon\Carbon::parse($program->tanggal_selesai);
                    $tanggalSekarang = \Carbon\Carbon::now();

                    // Cek apakah donasi sudah lewat tanggal berakhir
                    $isDonasiDitutup = $tanggalSelesai->lt($tanggalSekarang);
                @endphp

                <div class="col-lg-6 mb-2">
                    <div class="card border-0 shadow">
                        <div class="img-container">
                            <img src="{{ asset('foto/' . $program->foto) }}" class="img-donasi"
                                alt="{{ $program->nama_program }}">
                        </div>
                        <div class="card-body py-2 mb-3">
                            <h5 class="card-title fw-bold">{{ $program->nama_program }}</h5>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($program->tittle, 100) }}</p>

                            <!-- Tampilkan Total Donasi & Tanggal Berakhir dalam 1 Baris -->
                            <div class="d-flex justify-content-between">
                                <p class="text-success fw-bold mb-0">Total: Rp
                                    {{ number_format($totalDonasi, 0, ',', '.') }}</p>
                                <p class="text-danger mb-0">Berakhir: {{ $tanggalSelesai->translatedFormat('d F Y') }}
                                </p>
                            </div>

                            @if ($isDonasiDitutup)
                                <!-- Jika sudah melewati tanggal, tampilkan pesan -->
                                <div class="btn btn-danger w-100">Maaf, donasi sudah ditutup</div>
                            @else
                                <!-- Jika masih aktif, tampilkan tombol donasi -->
                                <a class="btn btn-success mb-2 w-100"
                                    href="{{ route('donasi.formdonasi', ['id_program_donasi' => $program->id_program_donasi]) }}">
                                    Donasi Sekarang
                                </a>
                            @endif

                            <a href="{{ route('donasi.infodonasi', ['id_program_donasi' => $program->id_program_donasi]) }}"
                                class="btn btn-secondary w-100 mt-2">SELENGKAPNYA</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
{{-- end donasi --}}

{{-- galeri --}}
<section id="galeri" class="section-galeri mt-3">
    <div class="container">
        <div class="d-flex align-items-center mb-3">
            <div class="stripe me-4"></div>
            <h2 class="sub-judul fw-bold">DOKUMENTASI KEGIATAN</h2>
        </div>
        <div class="gallery-grid">
            @foreach ($galeriuser->take(4) as $item)
                <div class="gallery-item mb-3">
                    <img class="galeri-img" src="{{ asset('foto/' . $item->foto) }}" alt="{{ $item->deskripsi }}">
                    <p>{{ \Carbon\Carbon::parse($item->tanggal)->format('d - m - Y') }}</p>
                    <h6>{{ $item->deskripsi }}</h6>
                </div>
            @endforeach
        </div>
        <a href="{{ route('galeri.galeri') }}" class="btn btn-success mb-5"
            style="display: block; width: fit-content; margin: 0 auto;">Selengkapnya</a>
    </div>
</section>
{{-- end galeri --}}


{{-- scriptjava galeri --}}
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const dots = document.querySelectorAll('.dots-nav .dot');
            const sliderGroups = document.querySelectorAll('.slider-group');

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    dots.forEach(d => d.classList.remove('active'));
                    sliderGroups.forEach(group => group.classList.remove('active'));

                    dot.classList.add('active');
                    sliderGroups[index].classList.add('active');
                });
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
