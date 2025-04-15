@extends('layouts.admin')

@section('title', 'Laporan Pengeluaran Donasi')

@section('contents')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Pengeluaran Donasi</h6>
            <!-- Tombol Tambah Pengeluaran -->
            <a href="{{ route('admin.tambah_pengeluaran') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Pengeluaran
            </a>
        </div>

        <div class="card-body">
            <!-- Filter Tanggal -->
            <form action="{{ route('admin.laporan_pengeluaran') }}" method="GET">
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

            <!-- Tombol Cetak PDF -->
            <form action="{{ route('admin.laporan_pengeluaran_pdf') }}" method="GET" target="_blank">
                <input type="hidden" name="start_date" value="{{ $startDate }}">
                <input type="hidden" name="end_date" value="{{ $endDate }}">
                <button type="submit" class="btn btn-success mb-3">Cetak PDF</button>
            </form>

            <!-- Tabel Laporan -->
            <div class="table-responsive mt-3">
                <table class="table table-bordered text-dark font-weight-bold">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>Minggu ke</th>
                            <th>Uraian Kegiatan</th>
                            <th>Tanggal</th>
                            <th>Masukan (Rp)</th>
                            <th>Pengeluaran (Rp)</th>
                            <th>Simpanan (Rp)</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $currentWeek = 1; @endphp
                        @foreach ($groupedPengeluaran as $week => $items)
                            <!-- Baris Total Mingguan -->
                            <tr>
                                <td class="text-center" rowspan="{{ count($items) + 1 }}">{{ $currentWeek }}</td>
                                <td colspan="1"><strong>Terkumpulnya Sedekah</strong></td>
                                <td></td>
                                <td class="text-right">
                                    <strong>
                                        Rp
                                        {{ number_format($totals[$week]['pengeluaran'] + $totals[$week]['simpanan'], 0, ',', '.') }}
                                    </strong>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>


                            <!-- Detail Kegiatan -->
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->deskripsi }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                    <td class="text-right">
                                        {{ $item->masukan ? 'Rp ' . number_format($item->masukan, 0, ',', '.') : '-' }}
                                    </td>
                                    <td class="text-right">
                                        {{ $item->pengeluaran ? 'Rp ' . number_format($item->pengeluaran, 0, ',', '.') : '-' }}
                                    </td>
                                    <td class="text-right">
                                        {{ $item->simpanan ? 'Rp ' . number_format($item->simpanan, 0, ',', '.') : '-' }}
                                    </td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td class="text-center">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('admin.edit_pengeluaran', ['id' => $item->id]) }}"
                                            class="text-warning mx-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('admin.deletePengeluaran', $item->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            <!-- Baris Total Pengeluaran dan Simpanan -->
                            <tr>
                                <td colspan="2"><strong>Total Pengeluaran</strong></td>
                                <td></td>
                                <td></td>
                                <td class="text-right"><strong>Rp
                                        {{ number_format($totals[$week]['pengeluaran'], 0, ',', '.') }}</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @php $currentWeek++; @endphp
                        @endforeach
                    </tbody>

                    <!-- Footer Total Keseluruhan -->
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-right">Total Keseluruhan Penerimaan</th>
                            <th class="text-right">Rp {{ number_format($grandTotalMasukan, 0, ',', '.') }}</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-right">Total Keseluruhan Pengeluaran</th>
                            <td></td>
                            <th class="text-right">Rp {{ number_format($grandTotalPengeluaran, 0, ',', '.') }}</th>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-right">Total Simpanan Bulan
                                {{ \Carbon\Carbon::parse($startDate)->format('F') }}</th>
                            <td></td>
                            <td></td>
                            <th class="text-right">Rp {{ number_format($grandTotalSimpanan, 0, ',', '.') }}</th>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
