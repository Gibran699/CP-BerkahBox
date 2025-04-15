@extends('layouts.admin')

@section('title', 'Laporan Pemasukan Donasi')

@section('contents')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Pemasukan Donasi</h6>
        </div>
        <div class="card-body">
            <!-- Filter Tanggal -->
            <form action="{{ route('admin.laporan_donasi') }}" method="GET">
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="start_date">Dari Tanggal</label>
                        <input type="date" class="form-control" id="start_date" name="start_date"
                            value="{{ $startDate }}">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="end_date">Sampai Tanggal</label>
                        <input type="date" class="form-control" id="end_date" name="end_date"
                            value="{{ $endDate }}">
                    </div>
                    <div class="form-group col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>

            <!-- Tombol Cetak -->
            <form action="{{ route('admin.laporan_donasi') }}" method="GET" target="_blank">
                <input type="hidden" name="start_date" value="{{ $startDate }}">
                <input type="hidden" name="end_date" value="{{ $endDate }}">
                <input type="hidden" name="action" value="cetak">
                <button type="submit" class="btn btn-success mb-3">Cetak PDF</button>
            </form>

            <!-- Tabel Laporan -->
            <div class="table-responsive">
                <table class="table table-bordered text-dark font-weight-bold" width="100%" cellspacing="0">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Donatur</th>
                            <th>No HP</th>
                            <th>Program Donasi</th>
                            <th>Jumlah Donasi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($donasi as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                <td>{{ $item->nama_donatur }}</td>
                                <td>{{ $item->no_telp }}</td>
                                <td>{{ $item->program_donasi ? $item->program_donasi->nama_program : '-' }}</td>
                                <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                <td>{{ ucfirst($item->status) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data donasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
