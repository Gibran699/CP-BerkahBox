@extends('layouts.layouts')

@section('content')
    <section id="sejarah" class="py-3">
        <div class="container py-5">
            <div class="row d-flex align-items-center">
                @foreach ($sejarah as $sejarah)
                    <div class="col-lg-12">
                        <div class="d-flex align-items-center">
                            <div class="stripe me-4"></div>
                            <h2 class="sub-judul fw-bold py-5">SEJARAH KAMI</h2>
                        </div>
                        <h2 class="sub-judul fw-bold">HAI SOBAT BERBAGI!</h2>
                        <p style="text-align: justify;">{{ $sejarah->tekssejarah }}</p>
                    </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <p style="text-align: justify;">{{ $sejarah->tekssejarah2 }}</p>
                    <p style="text-align: justify;">{{ $sejarah->tekssejarah3 }}</p>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 text-center">
                    <i>{{ $sejarah->tekssejarah4 }}</i>
                </div>
            </div>
            @endforeach
        </div>
    </section>
@endsection
