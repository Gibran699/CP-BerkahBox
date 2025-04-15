<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Donasi;
use App\Models\Jemput;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;

class UserController extends Controller
{
    public function userHome(Request $request) {
        $authUser = auth()->user();
        
        // Ambil bulan dan tahun dari request (default ke bulan dan tahun saat ini)
        $bulan = $request->query('bulan', Carbon::now()->month);
        $tahun = $request->query('tahun', Carbon::now()->year);
    
        // Hitung total donasi selama ini (keseluruhan donasi sukses)
        $totalDonasi = Donasi::where('id', $authUser->id) 
            ->where('status', 'success')
            ->sum('nominal');
    
        // Hitung total donasi khusus untuk bulan & tahun yang dipilih
        $donasiPerBulan = Donasi::where('id', $authUser->id) 
            ->where('status', 'success')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->sum('nominal');
    
        // Hitung jumlah pengajuan
        $jumlahPengajuan = Pengajuan::where('id', $authUser->id)
                               ->where('status', 'Diterima')
                               ->count();
    
        // Ambil riwayat donasi mingguan berdasarkan bulan & tahun
        $progress = $this->getDonasiBulanan($bulan, $tahun);
    
        return view('user.dashboard', compact('bulan', 'tahun', 'progress', 'totalDonasi', 'donasiPerBulan', 'jumlahPengajuan'));
    }
    
    

    public function user(){
        return view('user.dashboard');
    }

    public function getDonasiBulanan($bulan, $tahun){
        $userId = auth()->user()->id;
    
        // Ambil semua tanggal Jumat di bulan tertentu
        $startOfMonth = Carbon::createFromDate($tahun, $bulan, 1)->startOfMonth();
        $endOfMonth = $startOfMonth->copy()->endOfMonth();
        $today = Carbon::now();
        $fridays = [];
    
        for ($date = $startOfMonth->copy(); $date->lte($endOfMonth); $date->addDay()) {
            if ($date->isFriday()) {
                $fridays[] = $date->format('Y-m-d'); // Ubah format agar lebih konsisten
            }
        }
    
        // Ambil daftar tanggal donasi yang sukses dalam rentang bulan ini
        $donations = Donasi::where('id', $userId)
            ->where('status', 'success')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->pluck('created_at')
            ->map(function ($date) {
                return Carbon::parse($date)->format('Y-m-d'); // Pastikan format tanggal sesuai
            });
    
        // Cek setiap Jumat apakah ada donasi atau belum terlewati
        $result = [];
        foreach ($fridays as $friday) {
            $weekNumber = Carbon::parse($friday)->weekOfMonth;
            $weekStart = Carbon::parse($friday)->subDays(6); // Mulai dari Sabtu sebelumnya
            $weekEnd = Carbon::parse($friday); // Berakhir pada hari Jumat
            
            // Periksa apakah ada donasi dalam minggu ini
            $donated = $donations->contains(function ($donationDate) use ($weekStart, $weekEnd) {
                return Carbon::parse($donationDate)->between($weekStart, $weekEnd);
            });
        
            if (Carbon::now()->gte($weekStart)) { // Jika minggu sudah dimulai
                $status = $donated ? 'Donasi' : 'Tidak Donasi';
            } else {
                $status = '-'; // Jika minggu belum tiba
            }
        
            $result[] = [
                'minggu' => 'Minggu Ke-' . $weekNumber,
                'status' => $status,
            ];
        }
        return $result;
    }
    

    public function userHistoryDonasi(){
        $userId = Auth::id();

    $donasi = DB::table('donasi_pembayaran')
        ->join('program_donasi', 'donasi_pembayaran.id_program_donasi', '=', 'program_donasi.id_program_donasi')
        ->select(
            'donasi_pembayaran.created_at as tanggal_donasi',
            'program_donasi.nama_program',
            'donasi_pembayaran.nominal',
            'donasi_pembayaran.status'
        )
        ->where('donasi_pembayaran.id', $userId)
        ->orderBy('donasi_pembayaran.created_at', 'desc')
        ->get();

    return view('user.riwayatdonasi', compact('donasi'));
}

    public function userHistoryDonasiJemput(){
        $data = Jemput::where('id', auth()->user()->id)->paginate(10);
        return view('user.donasijemput', compact('data'));
    }
    
    public function userHistoryPengajuanDonasi(){
        $data = Pengajuan::where('id', auth()->user()->id)->paginate(10);
        return view('user.pengajuanuser', compact('data'));
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('home');
    }
    
}
