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
use App\Models\Infodonasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserProfilController;

class UserProfilController extends Controller
{
    public function UserVisi(){
        $visimisi = Visimisi::all();
        $kontak = Kontak::all();
        return view ("profil.visimisi", compact('visimisi', 'kontak')); 
    }

    public function UserStruktur(){
        $struktur = Struktur::all();
        $kontak = Kontak::all();
        return view ("profil.struktur", compact('struktur', 'kontak')); 
    }

    public function UserSejarah(){
        $sejarah = Sejarah::all();
        $kontak = Kontak::all();
        return view ("profil.sejarah", compact('sejarah', 'kontak')); 
    }

    public function UserPengajuan(){
        $pengajuan = Pengajuan::all();
        $program = Program::all();
        $kontak = Kontak::all();
        return view ("form.pengajuan", compact('pengajuan', 'kontak', 'program')); 
    }

    public function UserDonasiJemput(){
        $jemput = Jemput::all();
        $program = Program::all();
        $kontak = Kontak::all();
        return view ("form.jemput", compact('jemput', 'kontak', 'program')); 
    }

    public function UserGaleri(){
        $galeri = Galeri::all();
        $kontak = Kontak::all();
        return view ("galeri.galeri", compact('galeri', 'kontak')); 
    }

    // show form halaman depan
    // pengajuan donasi
    public function submitPengajuanForm(Request $request)
{
    $request->validate([
        'nama_lengkap' => 'required|string|max:255',
        'no_telp' => 'required|string|max:15',
        'desc_pengajuan' => 'required|string',
        'foto1' => 'nullable|image|max:5120',
        'foto2' => 'nullable|image|max:5120',
        'id_program_donasi' => 'required|exists:program_donasi,id_program_donasi',
    ]);

    $userpengajuan = new Pengajuan;
    $userpengajuan->id = Auth::check() ? Auth::id() : null;
    $userpengajuan->id_program_donasi = $request->id_program_donasi;
    $userpengajuan->nama_lengkap = $request->nama_lengkap;
    $userpengajuan->no_telp = $request->no_telp;
    $userpengajuan->desc_pengajuan = $request->desc_pengajuan;
    
    if ($request->hasFile('foto1')) {
        $file1 = $request->file('foto1');
        $filename1 = time() . '_1.' . $file1->getClientOriginalExtension();

        if ($file1->move('fotopengajuan/', $filename1)) {
            $userpengajuan->foto1 = $filename1;
        } else {
            return back()->with('failed', 'Gagal mengupload foto1. Harap pilih gambar yang valid.');
        }
    }

    if ($request->hasFile('foto2')) {
        $file2 = $request->file('foto2');
        $filename2 = time() . '_2.' . $file2->getClientOriginalExtension();

        if ($file2->move('fotopengajuan/', $filename2)) {
            $userpengajuan->foto2 = $filename2;
        } else {
            return back()->with('failed', 'Gagal mengupload foto2. Harap pilih gambar yang valid.');
        }
    }
    
    // Default status diisi dengan null
    $userpengajuan->status = $request->status ?? 'Status';

    $userpengajuan->save();

    if ($userpengajuan) {
        return redirect()->route('form.pengajuan')->with('success', 'Terimakasih, Pengajuan Donasi Telah Dikirim!');
    } else {
        return back()->with('failed', 'Gagal Mengirimkan Pengajuan Donasi!');
    }
}
// end pengajuan donasi

// donasi jemput
public function submitDonasiJemputForm(Request $request)
{
    $request->validate([
        'nama_donatur' => 'required|string|max:255',
        'no_hp' => 'required|string|max:15',
        'barang_donasi' => 'required|string|max:255',
        'foto_pengambilan' => 'nullable|image|max:5120',
        'id_program_donasi' => 'required|exists:program_donasi,id_program_donasi',
    ]);

    $userdonasijemput = new Jemput;
    $userdonasijemput->id = Auth::check() ? Auth::id() : null;
    $userdonasijemput->id_program_donasi = $request->id_program_donasi;
    $userdonasijemput->nama_donatur = $request->nama_donatur;
    $userdonasijemput->no_hp = $request->no_hp;
    $userdonasijemput->barang_donasi = $request->barang_donasi;
    
    if ($request->hasFile('foto_pengambilan')) {
        $file = $request->file('foto_pengambilan');
        $filename = time() . '.' . $file->getClientOriginalExtension();

        if ($file->move('fotodonasijemput/', $filename)) {
            $userdonasijemput->foto_pengambilan = $filename;
        } else {
            return back()->with('failed', 'Gagal mengupload foto pengambilan. Harap pilih gambar yang valid.');
        }
    }
    
    // Default status diisi dengan null
    $userdonasijemput->foto_penyerahan = '';
    $userdonasijemput->status = $request->status ?? 'Status';

    $userdonasijemput->save();

    if ($userdonasijemput) {
        return redirect()->route('form.jemput')->with('success', 'Terimakasih, Pengajuan Donasi Jemput Telah Dikirim!');
    } else {
        return back()->with('failed', 'Gagal Mengirimkan Pengajuan Donasi Jemput!');
    }
}
}