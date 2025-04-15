@extends('layouts.admin')

@section('title', 'Donasi Jemput')

@section('contents')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Donasi Jemput</h6>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-dark font-weight-bold" id="dataTable" width="100%" cellspacing="0">
                <thead class="table-primary text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Donatur</th>
                        <th>No Hp</th>
                        <th>Program Donasi</th>
                        <th>Barang Donasi</th>
                        <th>Foto Pengambilan</th>
                        <th>Foto Penyerahan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @php($no = $data->firstItem())
                    @foreach ($data as $index => $jemput)
                        <tr>
                            <td scope="row">{{ $no++ }}</td>
                            <td>{{ $jemput->nama_donatur }}</td>
                            <td>{{ $jemput->no_hp }}</td>
                            <td>{{ $jemput->program_donasi ? $jemput->program_donasi->nama_program : 'Tidak ada program' }}
                            </td>
                            <td>{{ $jemput->barang_donasi }}</td>
                            <td class="text-center">
                                @if ($jemput->foto_pengambilan)
                                    <img src="{{ asset('fotodonasijemput/' . $jemput->foto_pengambilan) }}"
                                        alt="Foto Pengambilan" class="img-thumbnail" width="80" height="80">
                                @else
                                    <span class="text-muted">Tidak Ada Foto</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($jemput->foto_penyerahan)
                                    <img src="{{ asset('fotodonasijemput/' . $jemput->foto_penyerahan) }}"
                                        alt="Foto Penyerahan" class="img-thumbnail" width="80" height="80">
                                @else
                                    <span class="text-muted">Tidak Ada Foto</span>
                                @endif
                            </td>
                            <td>{{ $jemput->status }}</td>
                            <td class="text-center">
                                <a href="/admin/editdonasi_jemput/{{ $jemput->id_donasi_jemput }}"
                                    class="text-warning mx-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" onclick="confirmDelete({{ $jemput->id_donasi_jemput }})"
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
        function confirmDelete(id_donasi_jemput) {
            var confirmation = confirm("Apakah Anda yakin ingin menghapus data ini?");
            if (confirmation) {
                window.location.href = "/admin/deletedonasi_jemput/" + id_donasi_jemput;
            }
        }
    </script>
@endsection
