<?php

namespace App\Http\Controllers;
use App\Models\Donasi;
use App\Models\Galeri;
use App\Models\Kontak;
use App\Models\Program;
use App\Models\Sejarah;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use App\Http\Controllers\UserHomeController;

class UserHomeController extends Controller
{

    public function UserHome(){

        $user = auth()->user();

        $jumlahDonasiDiterima = Donasi::where('status', 'success')->sum('nominal');
        $jumlahPengajuan = Pengajuan::where('status', 'Diterima')->count();
        $jumlahDonatur = User::where('role', 'user')->count();

        $galeriuser = Galeri::take(10)->get();
        $kontak = Kontak::all();
        $sejarahuser = Sejarah::all();
        // $sejarahuser->each(function ($sejarah) {
        //     $sejarah->tekssejarah = \Illuminate\Support\Str::limit($sejarah->tekssejarah, 422);
        // });
        $program = Program::take(2)->get();
        $program->each(function ($program) {
            $program->jumlah_donasi_diterima = DB::table('donasi_pembayaran')
                ->where('id_program_donasi', $program->id)
                ->where('status', 'Diterima')
                ->sum('nominal');
        });

        
    
        return view("home", compact('user', 'program', 'galeriuser', 'kontak', 'sejarahuser', 'jumlahDonasiDiterima', 'jumlahDonatur', 'jumlahPengajuan'));
    }

}