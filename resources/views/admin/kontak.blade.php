@extends('layouts.admin')

@section('title', 'Kontak')

@section('contents')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Kontak Yayasan</h6>
        </div>
    </div>
    <div class="card-body">
        <a href="{{ route('admin.tambahkontak') }}" class="btn btn-primary mb-3">Tambah</a>

        <div class="table-responsive">
            <table class="table table-bordered text-dark font-weight-bold" id="dataTable" width="100%" cellspacing="0">
                <thead class="table-primary text-center">
                    <tr>
                        <th>No</th>
                        <th>Alamat</th>
                        <th>No Telepon</th>
                        <th>Facebook</th>
                        <th>URL Maps</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @php($no = $data->firstItem())
                    @foreach ($data as $index => $kontak)
                        <tr>
                            <td scope="row">{{ $no++ }}</td>
                            <td>{{ $kontak->alamat }}</td>
                            <td>{{ $kontak->no_telp }}</td>
                            <td>{{ $kontak->facebook }}</td>
                            <td>{{ $kontak->maps_url }}</td>
                            <td class="text-center">
                                <a href="/admin/editkontak/{{ $kontak->id_kontak }}" class="text-warning mx-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" onclick="confirmDelete({{ $kontak->id_kontak }})"
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
        function confirmDelete(id_kontak) {
            var confirmation = confirm("Apakah Anda yakin ingin menghapus data ini?");
            if (confirmation) {
                window.location.href = "/admin/deletekontak/" + id_kontak;
            }
        }
    </script>
@endsection
