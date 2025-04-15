@extends('layouts.layouts')

@section('content')
    <section id="foto" style="margin-top: 100px">
        <div class="container">
            <div class="d-flex align-items-center">
                <div class="stripe me-4"></div>
                <h2 class="sub-judul fw-bold py-3">GALERI KEGIATAN</h2>
            </div>
            <div class="row">
                @foreach ($galeri as $galeri)
                    <!-- Gunakan col-6 untuk layar kecil -->
                    <div class="col-6 col-md-6 col-lg-4 mb-4">
                        <a href="../foto/{{ $galeri->foto }}" data-lightbox="models"
                            data-title="{{ $galeri->deskripsi }} : {{ $galeri->tanggal }}">
                            <img src="../foto/{{ $galeri->foto }}" class="img-fluid galeri-img">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
