@extends('layouts.admin')

@section('title', 'Pengajuan Donasi')

@section('contents')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pengajuan Donasi</h6>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-dark font-weight-bold" id="dataTable" width="100%" cellspacing="0">
                <thead class="table-primary text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>No Telp</th>
                        <th>Program Donasi</th>
                        <th>Deskripsi</th>
                        <th>Foto 1</th>
                        <th>Foto 2</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @php($no = $data->firstItem())
                    @foreach ($data as $index => $pengajuan)
                        <tr>
                            <td scope="row">{{ $no++ }}</td>
                            <td>{{ $pengajuan->nama_lengkap }}</td>
                            <td>{{ $pengajuan->no_telp }}</td>
                            <td>{{ $pengajuan->program_donasi ? $pengajuan->program_donasi->nama_program : 'Tidak ada program' }}
                            </td>
                            <td>{{ $pengajuan->desc_pengajuan }}</td>
                            <td class="text-center">
                                @if ($pengajuan->foto1)
                                    <img src="{{ asset('fotopengajuan/' . $pengajuan->foto1) }}" alt="Foto1"
                                        class="img-thumbnail" width="80" height="80">
                                @else
                                    <span class="text-muted">Tidak Ada Foto</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($pengajuan->foto2)
                                    <img src="{{ asset('fotopengajuan/' . $pengajuan->foto2) }}" alt="Foto2"
                                        class="img-thumbnail" width="80" height="80">
                                @else
                                    <span class="text-muted">Tidak Ada Foto</span>
                                @endif
                            </td>
                            <td>{{ $pengajuan->status }}</td>
                            <td class="text-center">
                                <a href="/admin/editpengajuan/{{ $pengajuan->id_pengajuan_donasi }}"
                                    class="text-warning mx-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" onclick="confirmDelete({{ $pengajuan->id_pengajuan_donasi }})"
                                    class="text-danger mx-2">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $data->links() }}
        </div>
    </div>
    </div>
    <script>
        function confirmDelete(id_pengajuan_donasi) {
            var confirmation = confirm("Apakah Anda yakin ingin menghapus data ini?");
            if (confirmation) {
                window.location.href = "/admin/deletepengajuan/" + id_pengajuan_donasi;
            }
        }
    </script>
@endsection
