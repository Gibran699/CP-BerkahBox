@extends('layouts.layouts')

@section('content')
    <section id="visimisi" style="margin-top: 100px">
        <div class="container py-3">
            <div class="d-flex align-items-center">
                <div class="stripe me-4"></div>
                <h2 class="sub-judul fw-bold">VISI DAN MISI</h2>
            </div>

            <div class="row align-items-center">
                @foreach ($visimisi as $visimisi)
                    <div class="col-lg-6 text-center">
                        <img src="../images/visi.png" width="350" height="350" class="img-fluid" alt="Mission Image">
                    </div>
                    <div class="col-lg-6">
                        <h4 class="text-success sub-judul fw-bold mb-4">VISI</h4>
                        <p style="text-align: justify;">{{ $visimisi->visi }}</p>
                    </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h4 class="text-success sub-judul fw-bold">MISI</h4>
                    <ul style="text-align: justify;">
                        @foreach (explode("\n", $visimisi->misi) as $point)
                            <li>{{ $point }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="../images/misi.png" width="350" height="350" class="img-fluid" alt="Vision Image">
                </div>
            </div>
            @endforeach
        </div>
    </section>
@endsection
