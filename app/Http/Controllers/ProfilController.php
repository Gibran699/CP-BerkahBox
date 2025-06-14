<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\Jemput;
use App\Models\Kontak;
use App\Models\Program;
use App\Models\Sejarah;
use App\Models\Struktur;
use App\Models\Visimisi;
use App\Models\Pengajuan;
use App\Models\Fasilitas; 
use App\Models\StrukturGambar;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
// use App\Http\Controllers\ProfilController;

class ProfilController extends Controller
{
    public function admin(){
        return view('admin.admin');
    }

    // ini sejarah
    public function adminSejarah(Request $request) {
        $search = $request->input('search');
        $data = Sejarah::when($search, function ($query) use ($search) {
            $query->where('sejarah', 'LIKE', '%' . $search . '%');
        })->paginate(100);

        return view('admin.sejarah', compact('data'));
    }


    public function tambahSejarah() {
        return view('admin.tambahsejarah');
    }

    public function postTambahSejarah(Request $request)
    {
        // Cek jika data sejarah sudah ada
        if (Sejarah::count() > 0) {
            return redirect()->back()->with('failed', 'Data sejarah sudah ada, tidak bisa menambahkan lagi. Silakan edit data sejarah yang sudah ada.');
        }

        // Validasi
        $request->validate([
            'tekssejarah' => 'required',
            'perjalananAwal' => 'required',
            'gambarSejarah' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'awalPendirian' => 'required',
            'perkembangan' => 'required',
            'masaKini' => 'required',
            'tekssejarah2' => 'required',
        ]);

        // Simpan gambar
        $gambarPath = null;
        if ($request->hasFile('gambarSejarah')) {
            $file = $request->file('gambarSejarah');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/sejarah'), $filename);
            $gambarPath = 'uploads/sejarah/' . $filename;
        }

        // Simpan data sejarah
        Sejarah::create([
            'tekssejarah' => $request->tekssejarah,
            'perjalananAwal' => $request->perjalananAwal,
            'gambarSejarah' => $gambarPath,
            'awalPendirian' => $request->awalPendirian,
            'perkembangan' => $request->perkembangan,
            'masaKini' => $request->masaKini,
            'tekssejarah2' => $request->tekssejarah2,
        ]);

        return redirect()->route('admin.sejarah')->with('success', 'Data sejarah berhasil ditambahkan.');
    }

    public function editSejarah($id) {
        $data = Sejarah::findOrFail($id);
        // dd($data);
        return view('admin.editsejarah', compact('data'));
    }

    public function postEditSejarah(Request $request, $id) {
        $request->validate([
            'tekssejarah' => 'required',
            'perjalananAwal' => 'required',
            'awalPendirian' => 'required',
            'perkembangan' => 'required',
            'masaKini' => 'required',
            'tekssejarah2' => 'required',
            'gambarSejarah' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $sejarah = Sejarah::findOrFail($id);

        // Update gambar jika ada
        if ($request->hasFile('gambarSejarah')) {
            $file = $request->file('gambarSejarah');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/sejarah'), $filename);
            $sejarah->gambarSejarah = 'uploads/sejarah/' . $filename;
        }

        // Update field lainnya
        $sejarah->tekssejarah = $request->tekssejarah;
        $sejarah->perjalananAwal = $request->perjalananAwal;
        $sejarah->awalPendirian = $request->awalPendirian;
        $sejarah->perkembangan = $request->perkembangan;
        $sejarah->masaKini = $request->masaKini;
        $sejarah->tekssejarah2 = $request->tekssejarah2;
        $sejarah->save();

        return back()->with('success', 'Sejarah berhasil diupdate!');
    }

    public function deleteSejarah($id_sejarah){
        $sejarah = Sejarah::find($id_sejarah);
        if (!$sejarah) {
            return back()->with('failed', 'Data tidak ditemukan.');
        }
        try {
            $sejarah->delete();
            return back()->with('success', 'Sejarah berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('failed', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
    // end sejarah

    // visimisi
    public function adminVisimisi(Request $request) {
        $search = $request->input('search');
        $data = Visimisi::when($search, function ($query) use ($search) {
            $query->where('visimisi', 'LIKE', '%' . $search . '%');
        })->paginate(5);

        return view('admin.visimisi', compact('data'));
    }

    public function tambahVisimisi() {
        return view('admin.tambahvisimisi');
    }

    public function postTambahVisimisi(Request $request) {
        $request->validate([
            'visi' => 'required',
            'misi' => 'required',
        ]);

        $visimisi = new Visimisi;
        $visimisi->visi = $request->visi;
        $visimisi->misi = strip_tags(nl2br($request->misi));
        $visimisi->id = Auth::id();

        $visimisi->save();

        if ($visimisi) {
            return back()->with('success', 'Visi misi Yayasan Berhasil ditambahkan!');
        } else {
            return back()->with('failed', 'Gagal Menambahkan Misi Misi Yayasan!');
        }
    }

    public function editVisimisi($id_visimisi){
        $data = Visimisi::find($id_visimisi);
        if (!$data) {
            return redirect()->route('admin.visimisi')->with('failed', 'Data tidak ditemukan!');
        }
        return view('admin.editvisimisi', compact('data'));}

    public function postEditVisimisi(Request $request, $id_visimisi){
        $request->validate([
            'visi' => 'required',
            'misi' => 'required',
        ]);
        $visimisi = Visimisi::find($id_visimisi);

        if (!$visimisi) {
            return back()->with('failed', 'Data tidak ditemukan!');
        }

        $visimisi->visi = $request->visi;
        $visimisi->misi = strip_tags(nl2br($request->misi));
        $visimisi->save();

        if ($visimisi) {
            return back()->with('success', 'Visi Misi berhasil diupdate!');
        } else {
            return back()->with('failed', 'Gagal mengupdate Visi Misi!');
        }}

    public function deleteVisimisi($id_visimisi){
        $data = Visimisi::find($id_visimisi);
        if (!$data) {
            return back()->with('failed', 'Data tidak ditemukan.');
        }
        try {
            $data->delete();
            return back()->with('success', 'Visi Misi berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('failed', 'Gagal menghapus data: ' . $e->getMessage());
        }
}
    // end visimisi

    // struktur yayasan
    public function adminStruktur(Request $request)
    {
        $search = $request->input('search');
        $data = Struktur::when($search, function ($query) use ($search) {
            $query->where('struktur_yayasan', 'LIKE', '%' . $search . '%');
        })->paginate(5);

        $strukturGambar = StrukturGambar::latest()->first();

        return view('admin.struktur_yayasan', compact('data', 'strukturGambar'));
    }

    public function tambahStruktur()
    {
        return view('admin.tambahstruktur_yayasan');
    }

    public function postTambahStruktur(Request $request)
    {
        $request->validate([
            'nama_pengurus' => 'required',
            'jabatan' => 'required',
            'foto_pengurus' => 'required|image|max:5120',
        ]);

        $struktur = new Struktur;
        $struktur->id = Auth::id();
        $struktur->nama_pengurus = $request->nama_pengurus;
        $struktur->jabatan = $request->jabatan;

        if ($request->hasFile('foto_pengurus')) {
            $file = $request->file('foto_pengurus');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            if ($file->move('foto/', $filename)) {
                $struktur->foto_pengurus = $filename;
            } else {
                return back()->with('failed', 'Gagal mengupload gambar. Harap pilih gambar yang valid.');
            }
        }

        $struktur->save();

        return $struktur
            ? back()->with('success', 'Struktur Yayasan Berhasil ditambahkan!')
            : back()->with('failed', 'Gagal Menambahkan Struktur Yayasan!');
    }

    public function editStruktur($id_struktur_yayasan)
    {
        $data = Struktur::find($id_struktur_yayasan);
        if (!$data) {
            return redirect()->route('admin.struktur_yayasan')->with('failed', 'Data tidak ditemukan!');
        }
        return view('admin.editstruktur_yayasan', compact('data'));
    }

    public function postEditStruktur(Request $request, $id_struktur_yayasan)
    {
        $request->validate([
            'nama_pengurus' => 'required',
            'jabatan' => 'required',
            'foto_pengurus' => 'image|max:5120|nullable',
        ]);

        $struktur = Struktur::find($id_struktur_yayasan);

        if (!$struktur) {
            return back()->with('failed', 'Data tidak ditemukan!');
        }

        $struktur->nama_pengurus = $request->nama_pengurus;
        $struktur->jabatan = $request->jabatan;

        if ($request->hasFile('foto_pengurus')) {
            $filepath = 'foto/' . $struktur->foto_pengurus;
            if (File::exists($filepath)) {
                File::delete($filepath);
            }

            $file = $request->file('foto_pengurus');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('foto/', $filename);
            $struktur->foto_pengurus = $filename;
        }

        $struktur->save();

        return $struktur
            ? back()->with('success', 'Struktur Pengurus berhasil diupdate!')
            : back()->with('failed', 'Gagal mengupdate Struktur Pengurus!');
    }

    public function deleteStruktur($id_struktur_yayasan)
    {
        $data = Struktur::find($id_struktur_yayasan);

        if (!$data) {
            return back()->with('failed', 'Data tidak ditemukan.');
        }

        $filepath = 'foto/' . $data->foto_pengurus;
        if (File::exists($filepath)) {
            File::delete($filepath);
        }

        try {
            $data->delete();
            return back()->with('success', 'Struktur Pengurus berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('failed', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    // Tambahan: Untuk menyimpan gambar struktur yayasan (frontend)
    public function storeStrukturGambar(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $file = $request->file('gambar');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('struktur'), $filename);

        StrukturGambar::create([
            'gambar' => $filename
        ]);

        return back()->with('success', 'Gambar struktur berhasil diunggah.');
    }


    // pengajuan donasi
    public function adminPengajuan(Request $request)
    {
        $search = $request->input('search');
        $data = Pengajuan::when($search, function ($query) use ($search) {
            $query->where('nama_lengkap', 'LIKE', '%' . $search . '%');
        })->paginate(100);

        return view('admin.pengajuan', compact('data'));
    }

    public function editPengajuan($id_pengajuan_donasi)
    {
        $data = Pengajuan::find($id_pengajuan_donasi);
        if (!$data) {
            return redirect()->route('admin.pengajuan')->with('failed', 'Data tidak ditemukan!');
        }

        $program = Program::all();
        return view('admin.editpengajuan', compact('data', 'program'));
    }

    public function postEditPengajuan(Request $request, $id_pengajuan_donasi){
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
            'desc_pengajuan' => 'required|string',
            'foto1' => 'nullable|image|max:5120',
            'foto2' => 'nullable|image|max:5120',
            'status' => 'required|in:Diterima,Pending,Ditolak',
            'id_program_donasi' => 'required|exists:program_donasi,id_program_donasi',
            ]);

            $pengajuan = Pengajuan::findOrFail($id_pengajuan_donasi);
            $pengajuan->id_program_donasi = $request->id_program_donasi;
            $pengajuan->nama_lengkap = $request->nama_lengkap;
            $pengajuan->no_telp = $request->no_telp;
            $pengajuan->desc_pengajuan = $request->desc_pengajuan;
            $pengajuan->status = $request->status;

            if ($request->hasFile('foto1')) {
                if (File::exists(public_path('fotopengajuan/' . $pengajuan->foto1))) {
                    File::delete(public_path('fotopengajuan/' . $pengajuan->foto1));
                }
                $file1 = $request->file('foto1');
                $filename1 = time() . '_1.' . $file1->getClientOriginalExtension();
                if ($file1->move('fotopengajuan/', $filename1)) {
                    $pengajuan->foto1 = $filename1;
                } else {
                    return back()->with('failed', 'Gagal mengupload foto1. Harap pilih gambar yang valid.');
                }
            }

            if ($request->hasFile('foto2')) {
                if (File::exists(public_path('fotopengajuan/' . $pengajuan->foto2))) {
                    File::delete(public_path('fotopengajuan/' . $pengajuan->foto2));
                }
                $file2 = $request->file('foto2');
                $filename2 = time() . '_2.' . $file2->getClientOriginalExtension();
                if ($file2->move('fotopengajuan/', $filename2)) {
                    $pengajuan->foto2 = $filename2;
                } else {
                    return back()->with('failed', 'Gagal mengupload foto2. Harap pilih gambar yang valid.');
                }
            }

            $pengajuan->save();

            if ($pengajuan) {
                return back()->with('success', 'Pengajuan berhasil diupdate!');
            } else {
                return back()->with('failed', 'Gagal mengupdate pengajuan!');
            }
        }


    public function deletePengajuan($id_pengajuan_donasi) {
        $data = Pengajuan::find($id_pengajuan_donasi);
        if ($data) {
            if (File::exists('fotopengajuan/' . $data->foto1)) {
                File::delete('fotopengajuan/' . $data->foto1);
                }
            if (File::exists('fotopengajuan/' . $data->foto2)) {
                File::delete('fotopengajuan/' . $data->foto2);
                }
            $data->delete();
                return back()->with('success', 'Pengajuan Kegiatan berhasil dihapus!');
            } else {
                return back()->with('failed', 'Pengajuan Kegiatan tidak ditemukan!');
            }
        }
    // end pengajuan

// donasi jemput
public function adminDonasijemput(Request $request) {
    $search = $request->input('search');
    $data = Jemput::when($search, function ($query) use ($search) {
        $query->where('donasi_jemput', 'LIKE', '%' . $search . '%');
    })->paginate(5);

    return view('admin.donasi_jemput', compact('data'));
}

    public function editDonasijemput($id_donasi_jemput)
    {
        $data = Jemput::find($id_donasi_jemput);
        if (!$data) {
            return redirect()->route('admin.donasi_jemput')->with('failed', 'Data tidak ditemukan!');
        }

        $program = Program::all();
        return view('admin.editdonasi_jemput', compact('data', 'program'));
    }

    public function postEditDonasijemput(Request $request, $id_donasi_jemput) {
        $request->validate([
            'nama_donatur' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'barang_donasi' => 'required|string|max:255',
            'foto_pengambilan' => 'nullable|image|max:5120',
            'foto_penyerahan' => 'nullable|image|max:5120',
            'status' => 'required|in:Diterima,Pending,Ditolak',
            'id_program_donasi' => 'required|exists:program_donasi,id_program_donasi',
        ]);

        $jemput = Jemput::findOrFail($id_donasi_jemput);

        $jemput->id_program_donasi = $request->id_program_donasi;
        $jemput->nama_donatur = $request->nama_donatur;
        $jemput->no_hp = $request->no_hp;
        $jemput->barang_donasi = $request->barang_donasi;
        $jemput->status = $request->status;

        if ($request->hasFile('foto_pengambilan')) {
            if ($jemput->foto_pengambilan && File::exists(public_path('fotodonasijemput/' . $jemput->foto_pengambilan))) {
                File::delete(public_path('fotodonasijemput/' . $jemput->foto_pengambilan));
            }

            $file = $request->file('foto_pengambilan');
            $filename = time() . '_1.' . $file->getClientOriginalExtension();
            $file->move(public_path('fotodonasijemput/'), $filename);
            $jemput->foto_pengambilan = $filename;
        }

        if ($request->hasFile('foto_penyerahan')) {
            if ($jemput->foto_penyerahan && File::exists(public_path('fotodonasijemput/' . $jemput->foto_penyerahan))) {
                File::delete(public_path('fotodonasijemput/' . $jemput->foto_penyerahan));
            }

            $file = $request->file('foto_penyerahan');
            $filename = time() . '_2.' . $file->getClientOriginalExtension();
            $file->move(public_path('fotodonasijemput/'), $filename);
            $jemput->foto_penyerahan = $filename;
        }

        $jemput->save();

        return back()->with('success', 'Jemput Donasi berhasil diupdate!');
    }


        public function deleteDonasijemput($id_donasi_jemput){
        $data = Jemput::find($id_donasi_jemput);
        if ($data) {
            if (File::exists('fotodonasijemput/' . $data->foto_pengambilan)) {
                File::delete('fotodonasijemput/' . $data->foto_pengambilan);
                }
            if (File::exists('fotodonasijemput/' . $data->foto_penyerahan)) {
                File::delete('fotodonasijemput/' . $data->foto_penyerahan);
                }
            $data->delete();
                return back()->with('success', 'Donasi Jemput berhasil dihapus!');
            } else {
                return back()->with('failed', 'Donasi Jemput tidak ditemukan!');
            }
        }
// end donasi-jemput


    // galeri
    public function adminGaleri(Request $request) {
        $search = $request->input('search');
        $data = Galeri::when($search, function ($query) use ($search) {
            $query->where('tanggal', 'LIKE', '%' . $search . '%');
        })->paginate(100);

        return view('admin.galeri', compact('data'));
    }


    public function tambahGaleri() {
        return view('admin.tambahgaleri');
    }

    public function postTambahGaleri(Request $request) {
        $request->validate([
            'tanggal' => 'required|date',
            'foto' => 'required|image|max:5120',
            'deskripsi' => 'required',

        ]);

        $galerii = new Galeri;
        $galerii->id = Auth::id();
        $galerii ->tanggal  = $request->tanggal;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;

            // Pastikan file berhasil diupload
            if ($file->move('foto/', $filename)) {
                $galerii->foto = $filename;
            } else {
                return back()->with('failed', 'Gagal mengupload gambar. Harap pilih gambar yang valid.');
            }
        }
        $galerii ->deskripsi  = $request->deskripsi;
        $galerii ->save();
        if($galerii ) {
            return back()->with('success', 'Galeri Kegiatan Berhasil ditambahkan!');
        } else {
            return back()->with('failed', 'Gagal Menambahkan Galeri Kegiatan!');
        }
    }


    public function editGaleri($id_galerii)
    {
        $data = Galeri::findOrFail($id_galerii); // Gunakan `findOrFail` untuk memastikan data ditemukan
        return view('admin.editgaleri', compact('data'));
    }

    // Menangani pengeditan galeri
    public function postEditGaleri(Request $request, $id_galerii)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'foto' => 'nullable|image|max:5120', // Foto opsional
            'deskripsi' => 'required|string|max:500',
        ]);

        $galerii = Galeri::findOrFail($id_galerii);
        $galerii->tanggal = $request->tanggal;
        $galerii->deskripsi = $request->deskripsi;

        if ($request->hasFile('foto')) {
            $oldFilePath = 'foto/' . $galerii->foto;
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }

            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('foto/', $filename);
            $galerii->foto = $filename;
        }

        if ($galerii->save()) {
            return redirect()->route('admin.galeri')->with('success', 'Galeri Berhasil Diperbarui!');
        } else {
            return back()->with('failed', 'Gagal Memperbarui Galeri!');
        }
    }


    public function deleteGaleri($id_galerii)
    {
        $galerii = Galeri::findOrFail($id_galerii);

        $filePath = 'foto/' . $galerii->foto;
        if (File::exists($filePath)) {
            File::delete($filePath); // Hapus file foto dari server
        }

        if ($galerii->delete()) {
            return redirect()->route('admin.galeri')->with('success', 'Galeri Kegiatan Berhasil Dihapus!');
        } else {
            return back()->with('failed', 'Gagal Menghapus Galeri Kegiatan!');
        }

    }
    // end galeri


    // kontak
    public function adminKontak(Request $request)
{
    $search = $request->input('search');
    $data = Kontak::when($search, function ($query) use ($search) {
        $query->where('alamat', 'LIKE', '%' . $search . '%');
    })->paginate(100);

    return view('admin.kontak', compact('data'));
}

public function tambahKontak()
{
    return view('admin.tambahkontak');
}

public function postTambahKontak(Request $request)
{
    $request->validate([
        'alamat' => 'required',
        'no_telp' => 'required',
        'facebook' => 'required',
        'maps_url' => 'required|url',
    ]);

    $kontak = new Kontak();

    $kontak->alamat = $request->alamat;
    $kontak->no_telp = $request->no_telp;
    $kontak->facebook = $request->facebook;
    $kontak->maps_url = $request->maps_url;
    $kontak->id = Auth::id();

    $kontak->save();

    if ($kontak) {
        return back()->with('success', 'Kontak Yayasan Berhasil ditambahkan!');
    } else {
        return back()->with('failed', 'Gagal Menambahkan Kontak Yayasan!');
    }
}

public function editKontak($id_kontak)
{
    $data = Kontak::find($id_kontak);
    if (!$data) {
        return redirect()->route('admin.kontak')->with('failed', 'Data tidak ditemukan!');
    }
    return view('admin.editkontak', compact('data'));
}

public function postEditKontak(Request $request, $id_kontak)
{
    $request->validate([
        'alamat' => 'required',
        'no_telp' => 'required',
        'facebook' => 'required',
        'maps_url' => 'required|url',
    ]);


    $kontak = Kontak::find($id_kontak);

    if (!$kontak) {
        return back()->with('failed', 'Data tidak ditemukan!');
    }

    $kontak->alamat = $request->alamat;
    $kontak->no_telp = $request->no_telp;
    $kontak->facebook = $request->facebook;
    $kontak->maps_url = $request->maps_url;

    if ($kontak->save()) {
        return back()->with('success', 'Kontak berhasil diupdate!');
    } else {
        return back()->with('failed', 'Gagal mengupdate Kontak!');
    }
}

public function deleteKontak($id_kontak)
{
    $data = Kontak::find($id_kontak);

    if (!$data) {
        return back()->with('failed', 'Data tidak ditemukan.');
    }

    try {
        $data->delete();
        return back()->with('success', 'Kontak berhasil dihapus!');
    } catch (\Exception $e) {
        return back()->with('failed', 'Gagal menghapus data: ' . $e->getMessage());
    }
}
    // end kontak

    // Fasilitas
    public function adminFasilitas(Request $request){
        $search = $request->input('search');
        $data = Fasilitas::when($search, function ($query) use ($search) {
            $query->where('nama_fasilitas', 'LIKE', '%' . $search . '%');
        })->paginate(100);
        return view('admin.fasilitas', compact('data'));
    }

    public function tambahFasilitas(){
        return view('admin.tambahfasilitas');
    }

    public function postTambahFasilitas(Request $request){
        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar_fasilitas' => 'required|image|max:5120', // Max 5MB
        ]);

        $fasilitas = new \App\Models\Fasilitas();
        $fasilitas->nama_fasilitas = $request->nama_fasilitas;
        $fasilitas->deskripsi = $request->deskripsi;

        if ($request->hasFile('gambar_fasilitas')) {
            $file = $request->file('gambar_fasilitas');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            if ($file->move(public_path('fasilitas/'), $filename)) {
                $fasilitas->gambar_fasilitas = $filename;
            } else {
                return back()->with('failed', 'Gagal mengupload gambar fasilitas. Harap pilih gambar yang valid.');
            }
        }

        $fasilitas->save();

        if ($fasilitas) {
            return back()->with('success', 'Fasilitas berhasil ditambahkan!');
        } else {
            return back()->with('failed', 'Gagal menambahkan fasilitas!');
        }
    }

    public function editFasilitas($id){
        $data = \App\Models\Fasilitas::find($id);
        if (!$data) {
            return redirect()->route('admin.fasilitas')->with('failed', 'Data fasilitas tidak ditemukan!');
        }
        return view('admin.editfasilitas', compact('data'));
    }

    public function postEditFasilitas(Request $request, $id){
        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar_fasilitas' => 'nullable|image|max:5120', // Max 5MB, nullable for update
        ]);

        $fasilitas = \App\Models\Fasilitas::find($id);
        if (!$fasilitas) {
            return back()->with('failed', 'Data fasilitas tidak ditemukan!');
        }

        $fasilitas->nama_fasilitas = $request->nama_fasilitas;
        $fasilitas->deskripsi = $request->deskripsi;

        if ($request->hasFile('gambar_fasilitas')) {
            // Delete old image if exists
            $oldFilePath = public_path('fasilitas/' . $fasilitas->gambar_fasilitas);
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }

            $file = $request->file('gambar_fasilitas');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            if ($file->move(public_path('fasilitas/'), $filename)) {
                $fasilitas->gambar_fasilitas = $filename;
            } else {
                return back()->with('failed', 'Gagal mengupload gambar fasilitas. Harap pilih gambar yang valid.');
            }
        }

        $fasilitas->save();

        if ($fasilitas) {
            return back()->with('success', 'Fasilitas berhasil diupdate!');
        } else {
            return back()->with('failed', 'Gagal mengupdate fasilitas!');
        }
    }

    public function deleteFasilitas($id){
        $fasilitas = \App\Models\Fasilitas::find($id);
        if (!$fasilitas) {
            return back()->with('failed', 'Data fasilitas tidak ditemukan.');
        }

        // Delete image file if exists
        $filePath = public_path('fasilitas/' . $fasilitas->gambar_fasilitas);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        try {
            $fasilitas->delete();
            return back()->with('success', 'Fasilitas berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('failed', 'Gagal menghapus data fasilitas: ' . $e->getMessage());
        }
    }
}
