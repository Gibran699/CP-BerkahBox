@extends('layouts.layouts')
@section('content')
    <section id="info-donasi" class="py-3">
        <div class="container py-5">
            <!-- Header Section -->
            <div class="d-flex align-items-center">
                <div class="stripe me-4 mt-5"></div>
                <h2 class="sub-judul fw-bold mt-5">DETAIL DONASI</h2>

            </div>
            <h2 class="sub-judul fw-bold mt-3">MARI MEMBANTU!</h2>

            <!-- Paragraf Deskripsi -->
            <div class="row align-items-center">
                <div class="col-lg-6" style="text-align: justify;">
                    <p>{{ $program->deskripsi }}</p>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="../../images/sejarah-detail.png" width="300" height="300" class="img-fluid"
                        alt="Detail Donasi">
                </div>
            </div>

            <!-- Gambar Donasi dan Ilustrasi -->
            <div class="row align-items-center"
                style="display: flex; justify-content: center; align-items:center; margin-top: 20px;">
                <div class="col-lg-4 d-flex justify-content-center" style="margin-right: -80px;">
                    <img src="{{ asset('foto/' . $program->foto) }}" style="width: 270px; height: 270px;" class="img-fluid"
                        alt="Detail Donasi 1">
                </div>
                <div class="col-lg-4 d-flex justify-content-center">
                    <img src="{{ asset('foto/' . $program->foto2) }}" style="width: 270px; height: 270px;" class="img-fluid"
                        alt="Detail Donasi 2">
                </div>
                <div class="col-lg-4 d-flex justify-content-center" style="margin-left: -80px;">
                    <img src="{{ asset('foto/' . $program->foto3) }}" style="width: 270px; height: 270px;" class="img-fluid"
                        alt="Detail Donasi 3">
                </div>
            </div>

            <!-- Pesan Terima Kasih -->
            <div style="margin-top: 30px; font-size: 15px; text-align: justify;">
                <p>Jazakallahu Khairan kepada semua donatur Berkah Box Balikpapan Terima kasih atas kedermawanan Anda yang
                    telah berdonasi di Berkah Box Balikpapan Insya Allah, semoga Anda mendapatkan ganjaran yang setimpal,
                    berkah rezeki, kesehatan yang selalu terjaga, dan semoga segala doa, niat, serta harapan yang telah
                    diungkapkan dalam sedekah Anda dikabulkan oleh Allah SWT. Semoga ini menjadi ladang amal dunia akhirat
                    dan
                    semoga kita semua tetap istiqomah dalam kebaikan. Aamiin ya Robbal 'Alamiin...</p>
            </div>

            <!-- Pesan Akhir -->
            <div style="margin-top: 10px; font-size: 15px; text-align: justify;">
                <p>(Sebaik-baik manusia adalah yang paling bermanfaat bagi orang lain.)</p>
            </div>
        </div>
    </section>
@endsection
