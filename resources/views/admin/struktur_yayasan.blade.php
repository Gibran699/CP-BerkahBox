@extends('layouts.admin')

@section('title', 'Struktur Organisasi Berkah Box Balikpapan')

@section('contents')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Struktur Organisasi Yayasan</h6>
        </div>
    </div>

    <div class="card-body">

        {{-- ✅ Upload Gambar Struktur Organisasi --}}
        <div class="mb-4">
            <h6 class="font-weight-bold text-success">Upload Gambar Struktur Organisasi (Tampilan Frontend)</h6>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ route('struktur-gambar.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" name="gambar" class="form-control-file" required>
                </div>
                <button type="submit" class="btn btn-success mt-2">Upload</button>
            </form>

            @if(isset($strukturGambar) && $strukturGambar->gambar)
                <div class="mt-3">
                    <p class="font-italic">Gambar saat ini:</p>
                    <img src="{{ asset('struktur/' . $strukturGambar->gambar) }}" alt="Struktur Organisasi" class="img-fluid" style="max-height: 300px;">
                </div>
            @endif
        </div>

        {{-- 🔵 Tombol Tambah --}}
        <a href="{{ route('admin.tambahstruktur_yayasan') }}" class="btn btn-primary mb-3">Tambah</a>

        {{-- 🔵 Tabel Struktur --}}
        <div class="table-responsive">
            <table class="table table-bordered text-dark font-weight-bold" id="dataTable" width="100%" cellspacing="0">
                <thead class="table-primary text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Pengurus</th>
                        <th>Jabatan</th>
                        <th>Foto Pengurus</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @php($no = $data->firstItem())
                    @foreach ($data as $index => $struktur)
                        <tr>
                            <td scope="row">{{ $no++ }}</td>
                            <td>{{ $struktur->nama_pengurus }}</td>
                            <td>{{ $struktur->jabatan }}</td>
                            <td class="text-center">
                                @if ($struktur->foto_pengurus)
                                    <img src="{{ asset('foto/' . $struktur->foto_pengurus) }}" alt="Foto Pengurus"
                                        class="img-thumbnail" width="80" height="80">
                                @else
                                    <span class="text-muted">Tidak Ada Foto</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="/admin/editstruktur_yayasan/{{ $struktur->id_struktur_yayasan }}"
                                    class="text-warning mx-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" onclick="confirmDelete({{ $struktur->id_struktur_yayasan }})"
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
        function confirmDelete(id_struktur_yayasan) {
            var confirmation = confirm("Apakah Anda yakin ingin menghapus data ini?");
            if (confirmation) {
                window.location.href = "/admin/deletestruktur_yayasan/" + id_struktur_yayasan;
            }
        }
    </script>
@endsection
