@extends('layouts.admin')

@section('title', 'Halo ' . ($authUser->isAdmin() ? 'Admin' : $authUser->name))

@section('contents')
    <div class="container-fluid">
        <div class="row">
            <!-- Total Donasi Keseluruhan -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Donasi
                                    Keseluruhan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp
                                    {{ number_format($totalDonasi, 0, ',', '.') }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Donasi Per Bulan -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Donasi Bulan
                                    {{ \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->translatedFormat('F Y') }}
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp
                                    {{ number_format($donasiPerBulan, 0, ',', '.') }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jumlah Pengajuan -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Pengajuan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahPengajuan }} Pengajuan</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Form Pilihan Bulan & Tahun -->
        <form method="GET" action="{{ route('user.dashboard') }}">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="bulan">Pilih Bulan:</label>
                    <select class="form-control" id="bulan" name="bulan">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($i)->locale('id')->translatedFormat('F') }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="tahun">Pilih Tahun:</label>
                    <select class="form-control" id="tahun" name="tahun">
                        @for ($y = \Carbon\Carbon::now()->year; $y >= 2020; $y--)
                            <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Tampilkan</button>
                </div>
            </div>
        </form>

        <!-- Donation History Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Donasi Anda Bulan
                    {{ \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->locale('id')->translatedFormat('F Y') }}
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Minggu</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($progress as $item)
                                <tr>
                                    <td>{{ $item['minggu'] }}</td>
                                    <td>
                                        @if ($item['status'] == 'Donasi')
                                            <span class="badge badge-success">{{ $item['status'] }}</span>
                                        @elseif ($item['status'] == 'Tidak Donasi')
                                            <span class="badge badge-danger">{{ $item['status'] }}</span>
                                        @else
                                            <span class="badge badge-secondary">{{ $item['status'] }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
