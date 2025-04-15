@extends('layouts.admin')

@section('title', 'Visi Misi')

@section('contents')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Visi Misi Yayasan</h6>
        </div>
    </div>
    <div class="card-body">
        <a href="{{ route('admin.tambahvisimisi') }}" class="btn btn-primary mb-3">Tambah</a>

        <div class="table-responsive">
            <table class="table table-bordered text-dark font-weight-bold" id="dataTable" width="100%" cellspacing="0">
                <thead class="table-primary text-center">
                    <tr>
                        <th>No</th>
                        <th>Visi</th>
                        <th>Misi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @php($no = $data->firstItem())
                    @foreach ($data as $index => $visimisi)
                        <tr>
                            <td scope="row">{{ $no++ }}</td>
                            <td>{{ $visimisi->visi }}</td>
                            <td>{{ $visimisi->misi }}</td>
                            <td class="text-center">
                                <a href="/admin/editvisimisi/{{ $visimisi->id_visimisi }}" class="text-warning mx-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" onclick="confirmDelete({{ $visimisi->id_visimisi }})"
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
        function confirmDelete(id_visimisi) {
            var confirmation = confirm("Apakah Anda yakin ingin menghapus data ini?");
            if (confirmation) {
                window.location.href = "/admin/deletevisimisi/" + id_visimisi;
            }
        }
    </script>
@endsection
