@extends('layouts.layouts')

@section('content')
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
                            data-deskripsi="{{ $item->deskripsi }}"
                            data-gambar="{{ asset('program/' . $item->gambar) }}">
                            <img src="{{ asset('program/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->nama_program }}">
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
                    <img id="modalProgramImage" src="" class="img-fluid mb-3" alt="Program Image">
                    <p id="modalProgramDescription" class="text-start"></p>
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
                var deskripsi = button.getAttribute('data-deskripsi');
                var gambar = button.getAttribute('data-gambar');

                var modalTitle = programModal.querySelector('.modal-title');
                var modalImage = programModal.querySelector('#modalProgramImage');
                var modalDescription = programModal.querySelector('#modalProgramDescription');

                modalTitle.textContent = nama;
                modalImage.src = gambar;
                modalDescription.textContent = deskripsi;
            });
        });
    </script>
@endsection