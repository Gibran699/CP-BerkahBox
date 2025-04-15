<?php

namespace App\Http\Controllers;
use Exception;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Donasi;
use App\Models\Kontak;
use App\Models\Program; 
use Illuminate\Http\Request;
use App\Mail\DonationReceived;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserDonasiController extends Controller
{
    public function formdonasi(){
    $kontak = Kontak::all(); 
    $program = Program::all();

    return view('donasi.formdonasi', compact('kontak', 'program'));
}

    public function infodonasi($id_program_donasi)
    {
        $kontak = Kontak::all(); 
        $program = Program::findOrFail($id_program_donasi);
        return view('donasi.infodonasi', compact('kontak', 'program'));
    }

    public function showDonasiForm(){
        $programs = Program::all();
        $kontak = Kontak::all();
        return view('donasi.donasi', compact('programs', 'kontak'));
    }

    public function showJumlahDonasi()
    {
    // Menghitung jumlah donasi dengan status 'diterima'
    $jumlahDonasiDiterima = Donasi::where('status', 'Diterima')->sum('nominal');

    return view('admin.admin', ['jumlahDonasiDiterima' => $jumlahDonasiDiterima]);
    }
}