@extends('layouts.admin')

@section('title', 'Tambah Visi Misi')

@section('contents')
    <div class="container">
        <a href="{{ route('admin.tambahvisimisi') }}">
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
                        <h5 class="card-title text-center">Tambah</h5>
                        <form action="{{ route('postTambahVisimisi') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Visi</label>
                                <textarea class="form-control" name="visi" placeholder="Tulis Visi Yayasan..." style="height: 250px" required
                                    value="{{ old('visi') }}"></textarea>
                            </div>
                            <br>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Misi</label>
                                <textarea class="form-control" name="misi" placeholder="Tulis Misi Yayasan..." style="height: 250px" required
                                    value="{{ old('misi') }}"></textarea>
                            </div>

                            <button type="submit" class="btn btn-success mt-5">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br><br><br>
    </div>
@endsection
