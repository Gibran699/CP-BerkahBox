<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengeluaran;
use Carbon\Carbon;

class PengeluaranSeeder extends Seeder
{
    public function run()
    {
        Pengeluaran::create([
            'tanggal' => Carbon::now()->subDays(10),
            'deskripsi' => 'Beli bahan makanan untuk yatim',
            'kategori' => 'Makanan & Minuman',
            'jumlah' => 500000,
            'bukti' => 'bukti_makan.jpg'
        ]);

        Pengeluaran::create([
            'tanggal' => Carbon::now()->subDays(5),
            'deskripsi' => 'Pembelian Al-Quran',
            'kategori' => 'Keagamaan',
            'jumlah' => 300000,
            'bukti' => 'bukti_alquran.jpg'
        ]);
    }
}

