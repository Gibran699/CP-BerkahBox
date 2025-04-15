@extends('layouts.layouts')

@section('content')
    <section id="struktur-organisasi" class="py-3" style="margin-top: 100px">
        <div class="container">
            <div class="d-flex align-items-center">
                <div class="stripe me-4"></div>
                <h2 class="sub-judul fw-bold">STRUKTUR ORGANISASI</h2>
            </div>

            <!-- Organizational Structure -->
            <div class="d-flex flex-column align-items-center text-center">
                <!-- Pembina -->
                @foreach ($struktur as $item)
                    @if ($item->jabatan == 'Pembina Berkah Box Balikpapan')
                        <div class="position-relative">
                            <div class="person">
                                <img src="{{ asset('foto/' . $item->foto_pengurus) }}"
                                    class="rounded-circle border border-success mb-2" width="100" height="100"
                                    alt="{{ $item->nama_pengurus }}">
                                <h6>{{ $item->nama_pengurus }}</h6>
                                <p class="text-muted">{{ $item->jabatan }}</p>
                            </div>
                            <div class="connector-vertical mb-2"></div>
                        </div>
                    @endif
                @endforeach

                <!-- Ketua -->
                @foreach ($struktur as $item)
                    @if ($item->jabatan == 'Ketua Berkah Box Balikpapan')
                        <div class="position-relative">
                            <div class="person">
                                <img src="{{ asset('foto/' . $item->foto_pengurus) }}"
                                    class="rounded-circle border border-success mb-2" width="100" height="100"
                                    alt="{{ $item->nama_pengurus }}">
                                <h6>{{ $item->nama_pengurus }}</h6>
                                <p class="text-muted">{{ $item->jabatan }}</p>
                            </div>
                            <div class="connector-horizontal mb-2"></div>
                        </div>
                    @endif
                @endforeach

                <!-- Sekretaris & Bendahara -->
                <div class="d-flex flex-wrap justify-content-center gap-4">
                    @foreach ($struktur as $item)
                        @if ($item->jabatan == 'Sekretaris Berkah Box Balikpapan' || $item->jabatan == 'Bendahara Berkah Box Balikpapan')
                            <div class="position-relative">
                                <div class="person">
                                    <img src="{{ asset('foto/' . $item->foto_pengurus) }}"
                                        class="rounded-circle border border-success mb-2" width="100" height="100"
                                        alt="{{ $item->nama_pengurus }}">
                                    <h6>{{ $item->nama_pengurus }}</h6>
                                    <p class="text-muted">{{ $item->jabatan }}</p>
                                </div>
                                <div class="connector-vertical"></div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Pengawas -->
                @foreach ($struktur as $item)
                    @if ($item->jabatan == 'Ketua Pengawas Berkah Box Balikpapan')
                        <div class="position-relative">
                            <div class="person">
                                <img src="{{ asset('foto/' . $item->foto_pengurus) }}"
                                    class="rounded-circle border border-success mb-2" width="100" height="100"
                                    alt="{{ $item->nama_pengurus }}">
                                <h6>{{ $item->nama_pengurus }}</h6>
                                <p class="text-muted">{{ $item->jabatan }}</p>
                            </div>
                            <div class="connector-vertical mb-2"></div>
                        </div>
                    @endif
                @endforeach

                <!-- Anggota -->
                <div class="d-flex flex-wrap justify-content-center gap-4">
                    @foreach ($struktur as $item)
                        @if ($item->jabatan == 'Anggota Berkah Box Balikpapan')
                            <div class="person">
                                <img src="{{ asset('foto/' . $item->foto_pengurus) }}"
                                    class="rounded-circle border border-success mb-2" width="100" height="100"
                                    alt="{{ $item->nama_pengurus }}">
                                <h6>{{ $item->nama_pengurus }}</h6>
                                <p class="text-muted">{{ $item->jabatan }}</p>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
