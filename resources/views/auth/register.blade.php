@extends('layouts.auth')

@section('title', 'Registrasi')

@section('content')
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
    <form action="{{ route('postRegister') }}" method="POST" class="mt-2">
        @csrf
        <div class="form-group mb-2">
            <input type="text" class="form-control form-control-lg" name="name" placeholder="Nama Lengkap" required>
        </div>

        <div class="form-group mb-2">
            <input type="email" class="form-control form-control-lg" name="email" placeholder="Email" required>
        </div>

        <div class="form-group mb-2">
            <input type="number" class="form-control form-control-lg" name="no_telp" placeholder="No Telp" required>
        </div>

        <div class="form-group mb-2">
            <input type="password" class="form-control form-control-lg" name="password" placeholder="Password" required>
        </div>

        <div class="form-group mb-2">
            <input type="password" class="form-control form-control-lg" name="password_confirmation"
                placeholder="Konfirmasi Password" required>
        </div>

        <button type="submit" class="btn btn-lg w-100">DAFTAR</button>
    </form>

    <div class="text-center mt-2">
        <p>Sudah punya akun? <a class="text-decoration-none" href="{{ route('auth.login') }}">Login di sini</a></p>
    </div>
@endsection
