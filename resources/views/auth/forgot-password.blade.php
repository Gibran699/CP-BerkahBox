@extends('layouts.auth')

@section('title', 'Lupa Sandi')

@section('content')
    <div class="container mt-5">
        <div class="card mx-auto p-4" style="max-width: 400px;">
            <h4 class="text-center">Lupa Kata Sandi</h4>
            <p class="text-muted text-center">Masukkan email Anda untuk menerima tautan reset sandi.</p>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Kirim Link Reset</button>
            </form>

            <div class="text-center mt-3">
                <a href="{{ route('auth.login') }}" class="text-decoration-none">Kembali ke Login</a>
            </div>
        </div>
    </div>
@endsection
