@extends('layouts.auth')

@section('title', 'Reset Kata Sandi')

@section('content')
    <div class="container mt-5">
        <div class="card mx-auto p-4" style="max-width: 400px;">
            <h4 class="text-center">Atur Ulang Kata Sandi</h4>

            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        placeholder="Email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                        placeholder="Kata Sandi Baru" required>
                    @error('password')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <input type="password" class="form-control" name="password_confirmation"
                        placeholder="Konfirmasi Kata Sandi" required>
                </div>

                <button type="submit" class="btn btn-success w-100">Reset Sandi</button>
            </form>

            <div class="text-center mt-3">
                <a href="{{ route('auth.login') }}" class="text-decoration-none">Kembali ke Login</a>
            </div>
        </div>
    </div>
@endsection
