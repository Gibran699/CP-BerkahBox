@extends('layouts.admin')

@section('title', 'Galeri Kegiatan')

@section('contents')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Galeri Kegiatan</h6>
        </div>
    </div>
    <div class="card-body">
        <a href="{{ route('admin.tambahgaleri') }}" class="btn btn-primary mb-3">Tambah</a>

        <div class="table-responsive">
            <table class="table table-bordered text-dark font-weight-bold" id="dataTable" width="100%" cellspacing="0">
                <thead class="table-primary text-center">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Foto</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @php($no = $data->firstItem())
                    @foreach ($data as $index => $galerii)
                        <tr>
                            <td scope="row">{{ $no++ }}</td>
                            <td>{{ $galerii->tanggal }}</td>
                            <td>
                                <img src="{{ asset('foto/' . $galerii->foto) }}" alt="Foto Kegiatan" width="100"
                                    height="100" style="object-fit: cover;">
                            </td>
                            <td>{{ $galerii->deskripsi }}</td>
                            <td class="text-center">
                                <a href="/admin/editgaleri/{{ $galerii->id_galerii }}" class="text-warning mx-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" onclick="confirmDelete({{ $galerii->id_galerii }})"
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
        function confirmDelete(id_galerii) {
            var confirmation = confirm("Apakah Anda yakin ingin menghapus data ini?");
            if (confirmation) {
                window.location.href = "/admin/deletegaleri/" + id_galerii;
            }
        }
    </script>
@endsection
