@extends('layouts.admin')

@section('title', 'Manajemen Fasilitas')

@section('contents')
    <div class="container mt-3">
        @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (Session::get('failed'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> {{ Session::get('failed') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Fasilitas</h6>
        </div>
    </div>
    <div class="card-body">
        <a href="{{ route('admin.tambahfasilitas') }}" class="btn btn-primary mb-3">Tambah Fasilitas</a>

        <div class="table-responsive">
            <table class="table table-bordered text-dark font-weight-bold" id="dataTable" width="100%" cellspacing="0">
                <thead class="table-primary text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Fasilitas</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @php($no = $data->firstItem())
                    @foreach ($data as $item)
                        <tr>
                            <td scope="row">{{ $no++ }}</td>
                            <td>{{ $item->nama_fasilitas }}</td>
                            <td>{{ Str::limit($item->deskripsi, 150) }}</td>
                            <td>
                                @if ($item->gambar_fasilitas)
                                    <img src="{{ asset('fasilitas/' . $item->gambar_fasilitas) }}" alt="{{ $item->nama_fasilitas }}" width="100">
                                @else
                                    Tidak ada gambar
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.editfasilitas', $item->id) }}" class="text-warning mx-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" onclick="confirmDelete({{ $item->id }})"
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
        function confirmDelete(id) {
            var confirmation = confirm("Apakah Anda yakin ingin menghapus data fasilitas ini?");
            if (confirmation) {
                window.location.href = "/admin/deletefasilitas/" + id;
            } else {
                return false;
            }
        }
    </script>
@endsection
