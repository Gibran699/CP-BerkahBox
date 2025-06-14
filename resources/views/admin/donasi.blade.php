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
                <input type="text" class="form-control" placeholder="Cari nama..." name="search" value="{{ request('search') }}">
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
                        <th>Nama Lengkap</th>
                        <th>No Telp</th>
                        <th>Nominal</th>
                        <th>Bukti Transfer</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @php($no = $data->firstItem())
                    @foreach ($data as $donasi)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $donasi->nama_lengkap }}</td>
                            <td>{{ $donasi->no_telp }}</td>
                            <td>Rp {{ number_format($donasi->nominal, 0, ',', '.') }}</td>
                            <td>
                                @if ($donasi->bukti_transfer)
                                    <a href="{{ asset($donasi->bukti_transfer) }}" target="_blank" class="btn btn-sm btn-info">Lihat</a>
                                @else
                                    <span class="text-muted">Belum ada</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="/admin/editdonasi/{{ $donasi->id }}" class="text-warning mx-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" onclick="confirmDelete({{ $donasi->id }})" class="text-danger mx-2">
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
            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                window.location.href = "/admin/deletedonasi/" + id;
            }
        }
    </script>
@endsection
