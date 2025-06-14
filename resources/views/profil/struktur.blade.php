@extends('layouts.layouts')

@section('content')
<section id="struktur-organisasi" class="py-3" style="margin-top: 100px">
    <div class="container">
        <div class="d-flex align-items-center">
            <div class="stripe me-4"></div>
            <h2 class="sub-judul fw-bold">STRUKTUR ORGANISASI</h2>
        </div>

        <!-- Gambar Struktur Organisasi (Dari DB) -->
        @if ($gambar && $gambar->gambar)
            <div class="text-center mt-5">
                <img src="{{ asset('struktur/' . $gambar->gambar) }}" alt="Struktur Organisasi" class="img-fluid" style="max-width: 100%; height: auto;">
            </div>
        @else
            <p class="text-center text-muted mt-5">Belum ada gambar struktur yang diunggah.</p>
        @endif

        @if (!empty($struktur) && count($struktur) > 1)
        <!-- Card Slider -->
        <div class="mt-5 position-relative">
            <h4 class="fw-bold mb-3 text-center">Lihat Semua Pengurus</h4>

            <!-- Slider -->
            <div class="overflow-auto px-2" id="slider-wrapper" style="max-width: 100%; margin: 0 auto;">
                <div id="slider-track" class="d-flex flex-nowrap transition-all" style="gap: 16px; min-width: max-content;">
                    @foreach ($struktur as $item)
                        <div class="card text-center flex-shrink-0 person-card"
                            style="width: 240px; border: 1px solid #ddd; cursor: pointer;"
                            data-bs-toggle="modal"
                            data-bs-target="#pengurusModal"
                            data-nama="{{ $item->nama_pengurus }}"
                            data-jabatan="{{ $item->jabatan }}"
                            data-foto="{{ asset('foto/' . $item->foto_pengurus) }}">
                            <div class="card-body">
                                <img src="{{ asset('foto/' . $item->foto_pengurus) }}"
                                    class="rounded-circle border border-success mb-3"
                                    width="100" height="100"
                                    alt="{{ $item->nama_pengurus }}">
                                <h6 class="fw-bold">{{ $item->nama_pengurus }}</h6>
                                <p class="text-muted small">{{ $item->jabatan }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif        
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="pengurusModal" tabindex="-1" aria-labelledby="pengurusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="pengurusModalLabel">Informasi Pengurus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalFoto" class="rounded-circle border border-success mb-3" width="120" height="120" alt="">
                <h5 id="modalNama" class="fw-bold"></h5>
                <p id="modalJabatan" class="text-muted"></p>
            </div>
        </div>
    </div>
</div>

<!-- Script Slider -->
<script>
    const track = document.getElementById('slider-track');

    // Modal trigger
    document.querySelectorAll('.person-card').forEach(card => {
        card.addEventListener('click', function () {
            const foto = this.dataset.foto;
            const nama = this.dataset.nama;
            const jabatan = this.dataset.jabatan;

            document.getElementById('modalFoto').src = foto;
            document.getElementById('modalNama').textContent = nama;
            document.getElementById('modalJabatan').textContent = jabatan;
        });
    });
</script>

<!-- Style -->
<style>
    .transition-all {
        transition: transform 0.4s ease;
    }

    .person-card {
        transition: background-color 0.3s ease;
    }

    .person-card:hover {
        background-color: #f0f0f0;
    }

    #slider-track {
        justify-content: start;
        overflow-x: auto;
    }

    @media (max-width: 768px) {
        #slider-wrapper {
            padding: 0 10px;
        }

        .person-card {
            width: 200px !important;
        }

        #slider-track {
            gap: 12px !important;
        }
    }
</style>

@endsection
