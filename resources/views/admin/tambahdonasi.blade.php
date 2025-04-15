@extends('layouts.admin')

@section('title', 'Tambah Donasi')

@section('contents')
    <div class="container">
        <a href="{{ route('admin.tambahdonasi') }}">
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
                        <h5 class="card-title text-center">Tambah Donasi</h5>
                        <form action="{{ route('postTambahDonasi') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mt-4">
                                <label class="text-secondary mb-2">Nama Donatur</label>
                                <input type="text" class="form-control border border-secondary form-control"
                                    name="nama_donatur" required value="{{ old('nama_donatur') }}">

                                <span class="text-danger">
                                    @error('nama_donatur')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group mt-4">
                                <label class="text-secondary mb-2">No Telp</label>
                                <input type="number" class="form-control border border-secondary form-control"
                                    name="no_telp" required value="{{ old('no_telp') }}">

                                <span class="text-danger">
                                    @error('no_telp')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group mt-4">
                                <label class="text-secondary mb-2">Email</label>
                                <input type="email" class="form-control border border-secondary form-control"
                                    name="email" required value="{{ old('email') }}">

                                <span class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group mt-4">
                                <label class="text-secondary mb-2">Nominal Donasi</label>
                                <input type="number" class="form-control border border-secondary form-control"
                                    name="nominal" required value="{{ old('nominal') }}">

                                <span class="text-danger">
                                    @error('nominal')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group mt-4">
                                <label class="text-secondary mb-2">Program Donasi</label>
                                <select class="form-control" name="id_program_donasi" required>
                                    @foreach ($programs as $item)
                                        <option value="{{ $item->id_program_donasi }}">{{ $item->nama_program }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('id_program_donasi')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Status</label>
                                <select class="form-control" name="status" required>
                                    <option value="success" style="background-color: green; color: white;">success
                                    </option>
                                    <option value="pending" style="background-color: yellow; color: black;">pending</option>
                                    <option value="cancel" style="background-color: red; color: white;">cancel</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success mt-5">Tambah Donasi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
