@extends('layouts.layouts')

@section('content')
    <section id="fasilitas" class="py-3">
        <div class="container py-5">
            <div class="row d-flex align-items-center mb-5">
                <div class="d-flex align-items-center">
                    <div class="stripe me-4"></div>
                    <h2 class="sub-judul fw-bold py-5">FASILITAS KAMI</h2>
                </div>
            </div>

            <div class="row">
                <!-- First Facility: Ruang Komputer -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card fasilitas-card border-custom">
                        <img src="{{ asset('fasilitas/fasilitas1.jpg') }}" class="card-img-top" alt="Ruang Komputer">
                        <div class="card-body">
                            <h5 class="card-title text-center">Ruang Komputer</h5>
                            <p class="card-text">Ruang komputer yang dilengkapi dengan perangkat terbaru untuk kebutuhan belajar dan kerja.</p>
                        </div>
                    </div>
                </div>

                <!-- Second Facility: Ruang Pelatihan -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card fasilitas-card border-custom">
                        <img src="{{ asset('fasilitas/fasilitas2.jpg') }}" class="card-img-top" alt="Ruang Pelatihan">
                        <div class="card-body">
                            <h5 class="card-title text-center">Ruang Pelatihan</h5>
                            <p class="card-text">Ruang pelatihan yang nyaman dan mendukung kegiatan workshop dan seminar.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
