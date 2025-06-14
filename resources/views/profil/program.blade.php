@extends('layouts.layouts')

@section('content')
    <style>
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-image: none; /* Remove default Bootstrap SVG */
            background-color: #d87300; /* Orange background */
            border-radius: 50%; /* Make it circular */
            width: 30px; /* Adjust size */
            height: 30px; /* Adjust size */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .carousel-control-prev-icon::after {
            content: '\2039'; /* Unicode for left arrow */
            font-size: 20px;
            color: white;
        }

        .carousel-control-next-icon::after {
            content: '\203A'; /* Unicode for right arrow */
            font-size: 20px;
            color: white;
        }

        /* Ensure images are 100% width within the carousel */
        #programCarousel .carousel-item img {
            width: 100%;
            height: auto; /* Maintain aspect ratio */
            max-height: 400px; /* Optional: limit max height if images are too tall */
            object-fit: contain; /* Ensure the entire image is visible */
        }
    </style>
    <section id="program" class="py-3">
        <div class="container py-5">
            <div class="row d-flex align-items-center mb-5">
                <div class="d-flex align-items-center">
                    <div class="stripe me-4"></div>
                    <h2 class="sub-judul fw-bold py-5">PROGRAM KAMI</h2>
                </div>
            </div>

            <div class="row">
                @foreach ($program as $item)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card program-card border-custom" data-bs-toggle="modal" data-bs-target="#programModal"
                            data-nama="{{ $item->nama_program }}"
                            data-title="{{ $item->title }}"
                            data-deskripsi="{{ $item->deskripsi }}"
                            data-foto1="/foto/{{ $item->foto }}"
                            data-foto2="/foto/{{ $item->foto2 }}"
                            data-foto3="/foto/{{ $item->foto3 }}"
                            data-tanggal-mulai="{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}"
                            data-tanggal-selesai="{{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}">
                            <img src="/foto/{{ $item->foto }}" class="card-img-top" alt="{{ $item->nama_program }}">
                            <div class="card-body">
                                <h5 class="card-title text-center">{{ $item->nama_program }}</h5>
                                <p class="card-text">{{ Str::limit($item->deskripsi, 100) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Program Modal -->
    <div class="modal fade" id="programModal" tabindex="-1" aria-labelledby="programModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="programModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div id="programCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img id="modalProgramImage1" src="/foto/{{ $item->foto }}" class="d-block w-100 img-fluid mb-3" alt="Program Image 1">
                            </div>
                            <div class="carousel-item">
                                <img id="modalProgramImage2" src="/foto/{{ $item->foto2 }}" class="d-block w-100 img-fluid mb-3" alt="Program Image 2">
                            </div>
                            <div class="carousel-item">
                                <img id="modalProgramImage3" src="/foto/{{ $item->foto3 }}" class="d-block w-100 img-fluid mb-3" alt="Program Image 3">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#programCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#programCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <h6 class="mt-3" id="modalProgramTitle"></h6>
                    <p id="modalProgramDescription" class="text-start"></p>
                    <p class="text-start"><strong>Tanggal Mulai:</strong> <span id="modalProgramTanggalMulai"></span></p>
                    <p class="text-start"><strong>Tanggal Selesai:</strong> <span id="modalProgramTanggalSelesai"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var programModal = document.getElementById('programModal');
            programModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var nama = button.getAttribute('data-nama');
                var title = button.getAttribute('data-title');
                var deskripsi = button.getAttribute('data-deskripsi');
                var foto1 = button.getAttribute('data-foto1');
                var foto2 = button.getAttribute('data-foto2');
                var foto3 = button.getAttribute('data-foto3');
                var tanggalMulai = button.getAttribute('data-tanggal-mulai');
                var tanggalSelesai = button.getAttribute('data-tanggal-selesai');

                var modalTitle = programModal.querySelector('.modal-title');
                var modalProgramTitle = programModal.querySelector('#modalProgramTitle');
                var modalProgramDescription = programModal.querySelector('#modalProgramDescription');
                var modalProgramImage1 = programModal.querySelector('#modalProgramImage1');
                var modalProgramImage2 = programModal.querySelector('#modalProgramImage2');
                var modalProgramImage3 = programModal.querySelector('#modalProgramImage3');
                var modalProgramTanggalMulai = programModal.querySelector('#modalProgramTanggalMulai');
                var modalProgramTanggalSelesai = programModal.querySelector('#modalProgramTanggalSelesai');

                modalTitle.textContent = nama;
                modalProgramTitle.textContent = title;
                modalProgramDescription.textContent = deskripsi;
                modalProgramImage1.src = foto1;
                modalProgramImage2.src = foto2;
                modalProgramImage3.src = foto3;
                modalProgramTanggalMulai.textContent = tanggalMulai;
                modalProgramTanggalSelesai.textContent = tanggalSelesai;

                // Reset carousel to first item
                var programCarousel = new bootstrap.Carousel(document.getElementById('programCarousel'));
                programCarousel.to(0);
            });
        });
    </script>
@endsection
