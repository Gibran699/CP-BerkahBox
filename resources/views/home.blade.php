@extends('layouts.layouts')
{{-- Hero --}}
<section id="hero" class="text-center text-white py-3"
    style="background-image: url('../images/dashboard.JPG'); background-size:100%; ">
</section>


{{-- border --}}
<section id="border">
    <div class="container">
    <div class="row justify-content-center align-items-stretch">
        <!-- Card Jadwal Sholat -->
        <div class="col-12 col-sm-4 mb-4 d-flex">
            <div class="border-item shadow rounded text-center p-3 w-100 d-flex flex-column justify-content-center">
                <img src="../icon/man_14788065.png" alt="Jadwal Sholat"
                    class="mb-3 mx-auto d-block"
                    style="width: 60px; height: 60px; object-fit: contain;">
                <h5>
                    Jadwal Sholat
                    <span style="font-weight: bold; color: #fd7e14;">{{ $sholatBerikutnya['nama'] }}</span>
                </h5>
                <p class="mb-0">{{ $sholatBerikutnya['jam'] }} WITA</p>
            </div>
        </div>

        <!-- Card Partisipasi Donasi -->
        <div class="col-12 col-sm-4 mb-4 d-flex">
            <div class="border-item shadow rounded text-center p-3 w-100 d-flex flex-column justify-content-center">
                <img src="../icon/ikon3.png" alt="Jumlah Donatur"
                    class="mb-3 mx-auto d-block"
                    style="width: 60px; height: 60px; object-fit: contain;">
                <h5>Partisipasi Donasi</h5>
                <p class="mb-1">
                    <span class="text-warning fw-bold" style="font-size: 1.25rem;">
                        @if ($jumlahDonasi > 100)
                            100+
                        @else
                            {{ $jumlahDonasi }}
                        @endif
                    </span>
                </p>
                <p class="mb-0" style="font-size: 0.95rem;">
                    Aksi kebaikan tercatat di <strong>Berkah Box</strong>.
                </p>
            </div>
        </div>
    </div>
</div>
</section>
{{-- border --}}

{{-- tentang masjid --}}
<section id="tentang" class="py-4 bg-light">
    <div class="container">
        <div class="d-flex align-items-center mb-3">
            <div class="stripe me-3"></div>
            <h2 class="sub-judul fw-bold">TENTANG MASJID BERKAH BOX</h2>
        </div>
        <p style="text-align: justify;">
            Masjid Berkah Box merupakan pusat kegiatan keagamaan yang terletak di Kota Balikpapan. Tidak hanya menjadi tempat ibadah bagi umat Islam, masjid ini juga menjadi ruang yang aktif dalam menyelenggarakan kegiatan sosial, pendidikan, dan pembinaan masyarakat. Dengan semangat kebersamaan dan nilai-nilai keislaman, Masjid Berkah Box terus tumbuh sebagai wadah bagi jamaah untuk belajar, berinteraksi, serta mempererat silaturahmi di lingkungan sekitarnya.
        </p>
    </div>
</section>

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
                <img src="../images/Makan.jpg" class="img-banner" alt="Donasi">
            </div>
        </div>
    </div>
</section>
{{-- end ajukan --}}

{{-- galeri --}}
<section id="galeri" class="section-galeri mt-3">
    <div class="container">
        <div class="d-flex align-items-center mb-3">
            <div class="stripe me-4"></div>
            <h2 class="sub-judul fw-bold">DOKUMENTASI KEGIATAN</h2>
        </div>

        <div class="row">
            @foreach ($galeriuser->take(4) as $item)
                <div class="col-6 col-md-3 mb-3">
                    <div class="gallery-item">
                        <img class="galeri-img img-fluid" src="{{ asset('foto/' . $item->foto) }}" alt="Foto Kegiatan">
                    </div>
                </div>
            @endforeach
        </div>

        <a href="{{ route('galeri.galeri') }}" class="btn btn-success my-4 d-block mx-auto" style="width: fit-content;">
            Selengkapnya
        </a>
    </div>
</section>
{{-- end galeri --}}

{{-- @include('layouts.footer') --}}

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