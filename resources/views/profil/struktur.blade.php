@extends('layouts.layouts')

@section('content')
<section id="struktur-organisasi" class="py-3" style="margin-top: 100px">
    <div class="container">
        <div class="d-flex align-items-center">
            <div class="stripe me-4"></div>
            <h2 class="sub-judul fw-bold">STRUKTUR ORGANISASI</h2>
        </div>

        <div style="margin-top: 100px;"></div> 
        <!-- Struktur Hirarkis -->
        <div class="d-flex flex-column align-items-center text-center">
            {{-- Pembina --}}
            @foreach ($struktur as $item)
                @if ($item->jabatan == 'Pembina Berkah Box Balikpapan')
                    <div class="position-relative">
                        <div class="person">
                            <img src="{{ asset('foto/' . $item->foto_pengurus) }}" class="rounded-circle border border-success mb-2" width="100" height="100" alt="{{ $item->nama_pengurus }}">
                            <h6>{{ $item->nama_pengurus }}</h6>
                            <p class="text-muted">{{ $item->jabatan }}</p>
                        </div>
                        <div class="connector-vertical mb-2"></div>
                    </div>
                @endif
            @endforeach

            {{-- Ketua --}}
            @foreach ($struktur as $item)
                @if ($item->jabatan == 'Ketua Berkah Box Balikpapan')
                    <div class="position-relative">
                        <div class="person">
                            <img src="{{ asset('foto/' . $item->foto_pengurus) }}" class="rounded-circle border border-success mb-2" width="100" height="100" alt="{{ $item->nama_pengurus }}">
                            <h6>{{ $item->nama_pengurus }}</h6>
                            <p class="text-muted">{{ $item->jabatan }}</p>
                        </div>
                        <div class="connector-horizontal mb-2"></div>
                    </div>
                @endif
            @endforeach

            {{-- Sekretaris & Bendahara --}}
            <div class="d-flex flex-wrap justify-content-center gap-4">
                @foreach ($struktur as $item)
                    @if ($item->jabatan == 'Sekretaris Berkah Box Balikpapan' || $item->jabatan == 'Bendahara Berkah Box Balikpapan')
                        <div class="position-relative">
                            <div class="person">
                                <img src="{{ asset('foto/' . $item->foto_pengurus) }}" class="rounded-circle border border-success mb-2" width="100" height="100" alt="{{ $item->nama_pengurus }}">
                                <h6>{{ $item->nama_pengurus }}</h6>
                                <p class="text-muted">{{ $item->jabatan }}</p>
                            </div>
                            <div class="connector-vertical"></div>
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- Pengawas --}}
            @foreach ($struktur as $item)
                @if ($item->jabatan == 'Ketua Pengawas Berkah Box Balikpapan')
                    <div class="position-relative">
                        <div class="person">
                            <img src="{{ asset('foto/' . $item->foto_pengurus) }}" class="rounded-circle border border-success mb-2" width="100" height="100" alt="{{ $item->nama_pengurus }}">
                            <h6>{{ $item->nama_pengurus }}</h6>
                            <p class="text-muted">{{ $item->jabatan }}</p>
                        </div>
                        <div class="connector-vertical mb-2"></div>
                    </div>
                @endif
            @endforeach

            {{-- Anggota --}}
            <div class="d-flex flex-wrap justify-content-center gap-4">
                @foreach ($struktur as $item)
                    @if ($item->jabatan == 'Anggota Berkah Box Balikpapan')
                        <div class="person">
                            <img src="{{ asset('foto/' . $item->foto_pengurus) }}" class="rounded-circle border border-success mb-2" width="100" height="100" alt="{{ $item->nama_pengurus }}">
                            <h6>{{ $item->nama_pengurus }}</h6>
                            <p class="text-muted">{{ $item->jabatan }}</p>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div style="margin-top: 100px;"></div> 

        @if (count($struktur) > 1)
        <!-- Tambahan: Card Slider -->
        <div class="mt-5 position-relative">
            <h4 class="fw-bold mb-3 text-center">Lihat Semua Pengurus</h4>
            
            <!-- Tombol Navigasi -->
            <button class="btn btn-light position-absolute top-50 start-0 translate-middle-y z-3" style="font-size: 2rem;" onclick="scrollToCard(-1)">
                &#60;
            </button>
            <button class="btn btn-light position-absolute top-50 end-0 translate-middle-y z-3" style="font-size: 2rem;" onclick="scrollToCard(1)">
                &#62;
            </button>
        
            <!-- Slider -->
            <div class="overflow-hidden px-2" id="slider-wrapper" style="max-width: 960px; margin: 0 auto;">
                <div id="slider-track" class="d-flex transition-all {{ count($struktur) === 1 ? 'justify-content-center' : '' }}" style="gap: 24px;">
                    @foreach ($struktur as $item)
                        <div class="card text-center flex-shrink-0 person-card"
                            style="width: 300px; border: 1px solid #ddd; cursor: pointer;"
                            data-bs-toggle="modal"
                            data-bs-target="#pengurusModal"
                            data-nama="{{ $item->nama_pengurus }}"
                            data-jabatan="{{ $item->jabatan }}"
                            data-foto="{{ asset('foto/' . $item->foto_pengurus) }}">
                            <div class="card-body">
                                <img src="{{ asset('foto/' . $item->foto_pengurus) }}"
                                    class="rounded-circle border border-success mb-3"
                                    width="120" height="120"
                                    alt="{{ $item->nama_pengurus }}">
                                <h5 class="fw-bold">{{ $item->nama_pengurus }}</h5>
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
    const cardWidth = 300 + 24;
    const totalCards = {{ count($struktur) }};
    const visibleCards = 3;
    let currentIndex = 0;

    function scrollToCard(direction) {
        currentIndex += direction;
        if (currentIndex < 0) currentIndex = 0;
        if (currentIndex > totalCards - visibleCards) currentIndex = totalCards - visibleCards;

        const scrollTo = currentIndex * cardWidth;
        track.style.transform = `translateX(-${scrollTo}px)`;
    }

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
        justify-content: center;
    }

    @media (min-width: 768px) {
        #slider-track {
            justify-content: start;
        }
    }
</style>
@endsection
