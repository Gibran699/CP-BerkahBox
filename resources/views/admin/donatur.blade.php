@extends('layouts.admin')

@section('title', 'Data Donatur')

@section('contents')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Donatur</h6>
        </div>

        <div class="card-body">
            <!-- Formulir Pencarian -->
            <form action="{{ route('admin.donatur') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari donatur..." name="search"
                        value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered text-dark font-weight-bold" id="dataTable" width="100%"
                    cellspacing="0">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Donatur</th>
                            <th>No Telp</th>
                            <th>Email</th>
                            <th>Total Donasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = $data->firstItem() @endphp
                        @foreach ($data as $donatur)
                            @php
                                $totalDonasi = $donatur->donasi_pembayaran->where('status', 'success')->sum('nominal'); // Menghitung total donasi sukses
                            @endphp
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $donatur->name }}</td>
                                <td>{{ $donatur->no_telp }}</td>
                                <td>{{ $donatur->email }}</td>
                                <td>Rp {{ number_format($totalDonasi, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $data->links() }}
            </div>
        </div>
    </div>
@endsection
