@extends('layouts.admin')

@section('title', 'Sejarah Yayasan Berkah Box Balikpapan')

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
                <strong>Gagal!</strong> {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sejarah Yayasan</h6>
        </div>
    </div>
    <div class="card-body">
        <a href="{{ route('admin.tambahsejarah') }}" class="btn btn-primary mb-3">Tambah</a>

        <div class="table-responsive">
            <table class="table table-bordered text-dark font-weight-bold" id="dataTable" width="100%" cellspacing="0">
                <thead class="table-primary text-center">
                    <tr>
                        <th>No</th>
                        <th>Sejarah Paragraf 1</th>
                        <th>Perjalanan Awal</th>
                        <th>Awal Pendirian</th>
                        <th>Perkembangan</th>
                        <th>Masa Kini</th>
                        <th>Sejarah Paragraf 2 (Akhir)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @php($no = $data->firstItem())
                    @foreach ($data as $index => $sejarah)
                        <tr>
                            <td scope="row">{{ $no++ }}</td>
                            <td>{{ $sejarah->tekssejarah }}</td>
                            <td>{{ $sejarah->perjalananAwal }}</td>
                            <td>{{ $sejarah->awalPendirian }}</td>
                            <td>{{ $sejarah->perkembangan }}</td>
                            <td>{{ $sejarah->masaKini }}</td>
                            <td>{{ $sejarah->tekssejarah2 }}</td>
                            <td class="text-center">
                                <a href="/admin/editsejarah/{{ $sejarah->id_sejarah }}" class="text-warning mx-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" onclick="confirmDelete({{ $sejarah->id_sejarah }})"
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
        function confirmDelete(Sejarah) {
            var confirmation = confirm("Apakah Anda yakin ingin menghapus data ini?");
            if (confirmation) {
                window.location.href = "/admin/deletesejarah/" + Sejarah;
            } else {
                return false;
            }
        }
    </script>
@endsection
