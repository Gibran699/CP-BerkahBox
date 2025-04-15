@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    @if (session('failed'))
        <div class="alert alert-danger">
            {{ session('failed') }}
        </div>
    @endif

    <form action="{{ route('postLogin') }}" method="POST" class="mt-4">
        @csrf
        <div class="form-group mb-3">
            <input type="email" class="form-control username-input form-control-lg" name="email" placeholder="Email"
                required>
            <span class="text-danger">
                @error('email')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div class="form-group mb-3">
            <input type="password" class="form-control password-input form-control-lg" name="password"
                placeholder="Password" required>
            <span class="text-danger">
                @error('password')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <button type="submit" class="btn btn-lg w-100">LOGIN</button>
    </form>

    <div class="text-center mt-3">
        <a class="text-decoration-none text-danger" href="{{ route('password.request') }}">Lupa Sandi?</a>
    </div>
    <div class="text-center mt-3">
        <p>Belum punya akun? <a class="text-decoration-none" href="{{ route('auth.register') }}">Daftar di sini</a></p>
    </div>
    <div class="text-center mt-3">
        <a href="{{ route('home') }}" class="text-decoration-none btn-link">Kembali</a>
    </div>
@endsection
