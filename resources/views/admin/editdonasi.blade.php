@extends('layouts.admin')

@section('title', 'Edit donasi')

@section('contents')
    <div class="container">
        <a href="{{ route('admin.donasi') }}">
            <i class="bi-arrow-left h1"></i>
        </a>

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

        <div class="row">
            <div class="col d-flex justify-content-center">
                <div class="card mt-4" style="width: 800px">
                    <div class="card-body">
                        <h5 class="card-title text-center">Update Donasi</h5>
                        <form action="/postEditDonasi/{{ $data->id_donasi_pembayaran }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Nama Donatur</label>
                                <input type="text" class="form-control" name="nama_donatur" required
                                    value="{{ $data->nama_donatur }}">
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">No Telp</label>
                                <input type="number" class="form-control" name="no_telp" required
                                    value="{{ $data->no_telp }}">
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Email</label>
                                <input type="email" class="form-control" name="email" required
                                    value="{{ $data->email }}">
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Nominal Donasi</label>
                                <input type="number" class="form-control" name="nominal" required
                                    value="{{ $data->nominal }}">
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Program Donasi</label>
                                <select class="form-control" name="id_program_donasi" required>
                                    @foreach ($programs as $item)
                                        <option value="{{ $item->id_program_donasi }}"
                                            {{ $data->id_program_donasi == $item->id_program_donasi ? 'selected' : '' }}>
                                            {{ $item->nama_program }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Status</label>
                                <select class="form-control" name="status" required>
                                    <option value="success" {{ $data->status == 'success' ? 'selected' : '' }}>success
                                    </option>
                                    <option value="pending" {{ $data->status == 'pending' ? 'selected' : '' }}>pending
                                    </option>
                                    <option value="cancel" {{ $data->status == 'cancel' ? 'selected' : '' }}>cancel
                                    </option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success mt-5">Update Donasi</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
