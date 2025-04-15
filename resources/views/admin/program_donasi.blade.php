@extends('layouts.admin')

@section('title', 'Program Kegiatan')

@section('contents')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Program Kegiatan</h6>
        </div>
    </div>
    <div class="card-body">
        <a href="{{ route('admin.tambahprogram_donasi') }}" class="btn btn-primary mb-3">Tambah Program</a>

        <!-- Formulir Pencarian -->
        <form action="{{ route('admin.program_donasi') }}" method="GET">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari Program..." name="search"
                    value="{{ request('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered text-dark font-weight-bold" id="dataTable" width="100%" cellspacing="0">
                <thead class="table-primary text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Program</th>
                        <th>Tittle</th>
                        <th>Deskripsi</th>
                        <th>Foto 1</th>
                        <th>Foto 2</th>
                        <th>Foto 3</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @php($no = $data->firstItem())
                    @foreach ($data as $index => $program)
                        <tr class="{{ $program->trashed() ? 'text-muted' : '' }}">
                            <td scope="row">{{ $no++ }}</td>
                            <td>{{ optional($program)->nama_program }}</td>
                            <td>{{ optional($program)->tittle }}</td>
                            <td>{{ optional($program)->deskripsi }}</td>
                            <td>
                                @if ($program->foto)
                                    <img src="{{ asset('/foto/' . $program->foto) }}" alt="Foto" style="width: 100px;">
                                @else
                                    Tidak ada foto
                                @endif
                            </td>
                            <td>
                                @if ($program->foto2)
                                    <img src="{{ asset('/foto/' . $program->foto2) }}" alt="Foto2" style="width: 100px;">
                                @else
                                    Tidak ada foto
                                @endif
                            </td>
                            <td>
                                @if ($program->foto3)
                                    <img src="{{ asset('/foto/' . $program->foto3) }}" alt="Foto3"
                                        style="width: 100px;">
                                @else
                                    Tidak ada foto
                                @endif
                            </td>
                            <td>{{ $program->tanggal_mulai }}</td>
                            <td>{{ $program->tanggal_selesai }}</td>
                            <td class="text-center">
                                <a href="/admin/editprogram_donasi/{{ $program->id_program_donasi }}"
                                    class="text-warning mx-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" onclick="confirmDelete({{ $program->id_program_donasi }})"
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
    <script>
        function confirmDelete(id_program_donasi) {
            var confirmation = confirm("Apakah Anda yakin ingin menghapus data ini?");
            if (confirmation) {
                window.location.href = "/admin/deleteprogram_donasi/" + id_program_donasi;
            }
        }
    </script>
@endsection
