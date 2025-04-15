@extends('layouts.admin')

@section('title', 'Donasi')

@section('contents')
    <div class="card shadow ">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Donasi</h6>
        </div>
    </div>
    <div class="card-body">
        <a href="{{ route('admin.tambahdonasi') }}" class="btn btn-primary mb-3">Tambah</a>

        <!-- Formulir Pencarian -->
        <form action="{{ route('admin.donasi') }}" method="GET">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="..." name="search" value="{{ request('search') }}">
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
                        <th>Nama Donatur</th>
                        <th>No Telp</th>
                        <th>Email</th>
                        <th>Nominal</th>
                        <th>Nama Program</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @php($no = $data->firstItem())
                    @foreach ($data as $index => $donasi)
                        <tr>
                            <td scope="row">{{ $no++ }}</td>
                            <td>{{ $donasi->nama_donatur }}</td>
                            <td>{{ $donasi->no_telp }}</td>
                            <td>{{ $donasi->email }}</td>
                            <td>Rp {{ number_format($donasi->nominal, 0, ',', '.') }}</td>
                            <td>{{ $donasi->program_donasi ? $donasi->program_donasi->nama_program : 'Program Tidak Ditemukan' }}
                            </td>
                            <td>{{ ucfirst($donasi->status) }}</td>
                            <td class="text-center">
                                <!-- Ikon Edit -->
                                <a href="/admin/editdonasi/{{ $donasi->id_donasi_pembayaran }}" class="text-warning mx-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <!-- Ikon Delete -->
                                <a href="#" onclick="confirmDelete({{ $donasi->id_donasi_pembayaran }})"
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
        function confirmDelete(id_donasi_pembayaran) {
            var confirmation = confirm("Apakah Anda yakin ingin menghapus data ini?");
            if (confirmation) {
                window.location.href = "/admin/deletedonasi/" + id_donasi_pembayaran;
            }
        }
    </script>
@endsection
