@extends('layouts.admin')

@section('title', 'Riwayat Donasi')

@section('contents')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Riwayat Donasi</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Donasi</th>
                                <th>Program Donasi</th>
                                <th>Nominal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($donasi as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_donasi)->format('d-m-Y H:i') }}</td>
                                    <td>{{ $item->nama_program }}</td>
                                    <td>Rp {{ number_format($item->nominal, 2, ',', '.') }}</td>
                                    <td>
                                        @if ($item->status === 'success')
                                            <span class="badge badge-success">Berhasil</span>
                                        @elseif ($item->status === 'pending')
                                            <span class="badge badge-warning">Menunggu</span>
                                        @elseif ($item->status === 'failed')
                                            <span class="badge badge-danger">Gagal</span>
                                        @else
                                            <span class="badge badge-secondary">Tidak Diketahui</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada riwayat donasi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
