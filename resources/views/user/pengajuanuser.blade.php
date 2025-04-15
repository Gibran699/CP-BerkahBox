@extends('layouts.admin')

@section('title', 'History Pengajuan Donasi')

@section('contents')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">History Pengajuan Donasi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>No Telp</th>
                            <th>Program Donasi</th>
                            <th>Deskripsi</th>
                            <th>Foto 1</th>
                            <th>Foto 2</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($no = $data->firstItem())
                        @forelse ($data as $pengajuan)
                            @if ($pengajuan->id === auth()->user()->id)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $pengajuan->nama_lengkap }}</td>
                                    <td>{{ $pengajuan->no_telp }}</td>
                                    <td>{{ $pengajuan->program_donasi ? $pengajuan->program_donasi->nama_program : 'Tidak ada program' }}
                                    </td>
                                    <td>{{ $pengajuan->desc_pengajuan }}</td>
                                    <td>
                                        @if ($pengajuan->foto1)
                                            <img src="{{ asset('fotopengajuan/' . $pengajuan->foto1) }}" alt="Foto1"
                                                width="100">
                                        @else
                                            Tidak Ada Foto
                                        @endif
                                    </td>
                                    <td>
                                        @if ($pengajuan->foto2)
                                            <img src="{{ asset('fotopengajuan/' . $pengajuan->foto2) }}" alt="Foto2"
                                                width="100">
                                        @else
                                            Tidak Ada Foto
                                        @endif
                                    </td>
                                    <td>
                                        @if ($pengajuan->status == 'Diterima')
                                            <span class="badge badge-success">Diterima</span>
                                        @elseif ($pengajuan->status == 'Pending')
                                            <span class="badge badge-secondary">Pending</span>
                                        @else
                                            <span class="badge badge-danger">Belum Diterima</span>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Belum ada riwayat pengajuan donasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $data->links() }}
            </div>
        </div>
    </div>
@endsection
