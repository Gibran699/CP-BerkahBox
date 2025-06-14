<?php

namespace App\Http\Controllers;
use App\Models\Donasi;
use App\Models\Galeri;
use App\Models\Kontak;
use App\Models\Program;
use App\Models\Sejarah;
use App\Models\Pengajuan;
use App\Models\DonasiForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
// use App\Http\Controllers\UserHomeController;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class UserHomeController extends Controller
{

    public function UserHome(){

        $user = auth()->user();

        $jumlahDonasiDiterima = Donasi::where('status', 'success')->sum('nominal');
        $jumlahPengajuan = Pengajuan::where('status', 'Diterima')->count();
        $jumlahDonasi = DonasiForm::count();

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

        $today = Carbon::now('Asia/Makassar')->format('Y-m-d');
        $response = Http::withOptions([
            'verify' => false,
        ])->get("https://api.myquran.com/v2/sholat/jadwal/2308/{$today}");

        $jadwal = $response->json()['data']['jadwal'];

        $now = Carbon::now('Asia/Makassar')->setSeconds(0);

        // dd($now);

        // Buat waktu sholat
        $jadwalSholat = [
            'Subuh'   => Carbon::createFromFormat('Y-m-d H:i', "$today {$jadwal['subuh']}", 'Asia/Makassar')->setSeconds(0),
            'Dzuhur'  => Carbon::createFromFormat('Y-m-d H:i', "$today {$jadwal['dzuhur']}", 'Asia/Makassar')->setSeconds(0),
            'Ashar'   => Carbon::createFromFormat('Y-m-d H:i', "$today {$jadwal['ashar']}", 'Asia/Makassar')->setSeconds(0),
            'Maghrib' => Carbon::createFromFormat('Y-m-d H:i', "$today {$jadwal['maghrib']}", 'Asia/Makassar')->setSeconds(0),
            'Isya'    => Carbon::createFromFormat('Y-m-d H:i', "$today {$jadwal['isya']}", 'Asia/Makassar')->setSeconds(0),
        ];

        $sholatBerikutnya = null;

        foreach ($jadwalSholat as $nama => $waktu) {
            $waktuDenganGracePeriod = $waktu->copy()->addMinutes(15); 
            if ($now->lessThan($waktuDenganGracePeriod)) {
                $sholatBerikutnya = [
                    'nama' => $nama,
                    'jam' => $waktu->format('H:i'),
                ];
                break;
            }
        }

        if (!$sholatBerikutnya) {
            $besok = Carbon::tomorrow('Asia/Makassar')->format('Y-m-d');
            $responseBesok = Http::withOptions([
                'verify' => false,
            ])->get("https://api.myquran.com/v2/sholat/jadwal/2308/{$besok}");

            $jadwalBesok = $responseBesok->json()['data']['jadwal'];

            $sholatBerikutnya = [
                'nama' => 'Subuh',
                'jam' => $jadwalBesok['subuh'],
                'tanggal' => $besok,
            ];
        }

        // Kirim variabel ke view
        return view("home", compact(
            'user', 'program', 'galeriuser', 'kontak', 'sejarahuser',
            'jumlahDonasiDiterima', 'jumlahDonasi', 'jumlahPengajuan',
            'sholatBerikutnya'
        ));
    }

}