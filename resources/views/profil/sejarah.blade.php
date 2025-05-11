@extends('layouts.layouts')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/sejarah.css') }}">
@endsection

@section('content')
    <section id="sejarah" class="py-5">
        <div class="container py-5">
            @foreach ($sejarah as $item)
            <div class="sejarah-header">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex align-items-center mb-4">
                            <div class="stripe me-4"></div>
                            <h2 class="sub-judul fw-bold mb-0">SEJARAH KAMI</h2>
                        </div>
                        <h1 class="display-5 fw-bold mb-4">HAI SOBAT BERBAGI!</h1>
                        <p class="lead" style="text-align: justify; line-height: 1.8;">{{ $item->tekssejarah }}</p>
                    </div>
                </div>
            </div>
            
            <div class="row my-5">
                {{-- <div class="col-md-6 mb-4 mb-md-0">
                    <img src="{{ asset('images/galeri3.jpg') }}" alt="Masjid Berkah Box" class="img-fluid sejarah-image" onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                </div> --}}
                <div class="col-md-6">
                    <h3 class="mb-4">Perjalanan Awal Kami</h3>
                    <p style="text-align: justify; line-height: 1.8;">{{ $item->perjalananAwal }}</p>
                </div>
            </div>
            
            <div class="sejarah-timeline mt-5 pt-3">
                <h3 class="text-center mb-4">Perjalanan Sejarah Masjid Berkah Box</h3>
                
                <div class="timeline-cards">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 col-sm-10 mb-4">
                            <div class="card h-100 border-0 shadow-sm timeline-card">
                                <div class="card-header btn-success text-white text-center py-3">
                                    <h5 class="mb-0">Awal Pendirian</h5>
                                </div>
                                <div class="card-body">
                                    <p>{{ $item->awalPendirian }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-6 col-sm-10 mb-4">
                            <div class="card h-100 border-0 shadow-sm timeline-card">
                                <div class="card-header btn-success text-white text-center py-3">
                                    <h5 class="mb-0">Perkembangan</h5>
                                </div>
                                <div class="card-body">
                                    <p>{{ $item->perkembangan }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-6 col-sm-10 mb-4">
                            <div class="card h-100 border-0 shadow-sm timeline-card">
                                <div class="card-header btn-success text-white text-center py-3">
                                    <h5 class="mb-0">Masa Kini</h5>
                                </div>
                                <div class="card-body">
                                    <p>{{ $item->masaKini }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row mt-5">
                <div class="col-12">
                    <p style="text-align: justify; line-height: 1.8;">{{ $item->tekssejarah2 }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>
@endsection