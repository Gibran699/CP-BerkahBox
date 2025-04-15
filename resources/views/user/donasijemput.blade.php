@extends('layouts.admin')

@section('title', 'History Donasi Jemput')

@section('contents')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">History Donasi Jemput</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Donatur</th>
                            <th>No Hp</th>
                            <th>Program Donasi</th>
                            <th>Barang Donasi</th>
                            <th>Foto Pengambilan</th>
                            <th>Foto Penyerahan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($no = $data->firstItem())
                        @forelse ($data as $jemput)
                            @if ($jemput->id === auth()->user()->id)
                                <!-- Filter by user ID -->
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $jemput->nama_donatur }}</td>
                                    <td>{{ $jemput->no_hp }}</td>
                                    <td>{{ $jemput->program_donasi ? $jemput->program_donasi->nama_program : 'Tidak ada program' }}
                                    </td>
                                    <td>{{ $jemput->barang_donasi }}</td>
                                    <td>
                                        @if ($jemput->foto_pengambilan)
                                            <img src="{{ asset('fotodonasijemput/' . $jemput->foto_pengambilan) }}"
                                                alt="Foto Pengambilan" width="100">
                                        @else
                                            Tidak Ada Foto
                                        @endif
                                    </td>
                                    <td>
                                        @if ($jemput->foto_penyerahan)
                                            <img src="{{ asset('fotodonasijemput/' . $jemput->foto_penyerahan) }}"
                                                alt="Foto Penyerahan" width="100">
                                        @else
                                            Tidak Ada Foto
                                        @endif
                                    </td>
                                    <td>
                                        @if ($jemput->status == 'Diterima')
                                            <span class="badge badge-success">Diterima</span>
                                        @elseif ($jemput->status == 'Pending')
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
