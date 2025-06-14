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
                @foreach ($fasilitas as $item)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card fasilitas-card border-custom" data-bs-toggle="modal" data-bs-target="#fasilitasModal"
                            data-nama="{{ $item->nama_fasilitas }}"
                            data-deskripsi="{{ $item->deskripsi }}"
                            data-gambar="{{ asset('fasilitas/' . $item->gambar_fasilitas) }}">
                            <img src="{{ asset('fasilitas/' . $item->gambar_fasilitas) }}" class="card-img-top" alt="{{ $item->nama_fasilitas }}">
                            <div class="card-body">
                                <h5 class="card-title text-center">{{ $item->nama_fasilitas }}</h5>
                                <p class="card-text">{{ Str::limit($item->deskripsi, 100) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Fasilitas Modal -->
    <div class="modal fade" id="fasilitasModal" tabindex="-1" aria-labelledby="fasilitasModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fasilitasModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalFasilitasImage" src="" class="img-fluid mb-3" alt="Fasilitas Image">
                    <p id="modalFasilitasDescription" class="text-start"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var fasilitasModal = document.getElementById('fasilitasModal');
            fasilitasModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var nama = button.getAttribute('data-nama');
                var deskripsi = button.getAttribute('data-deskripsi');
                var gambar = button.getAttribute('data-gambar');

                var modalTitle = fasilitasModal.querySelector('.modal-title');
                var modalImage = fasilitasModal.querySelector('#modalFasilitasImage');
                var modalDescription = fasilitasModal.querySelector('#modalFasilitasDescription');

                modalTitle.textContent = nama;
                modalImage.src = gambar;
                modalDescription.textContent = deskripsi;
            });
        });
    </script>
@endsection
