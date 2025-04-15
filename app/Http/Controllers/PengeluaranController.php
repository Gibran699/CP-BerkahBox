<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class PengeluaranController extends Controller
{
    // Menampilkan Laporan Pengeluaran
    public function laporanPengeluaran(Request $request)
{
    $startDate = $request->start_date ?? Carbon::now()->startOfMonth();
    $endDate = $request->end_date ?? Carbon::now()->endOfMonth();

    // Ambil semua data pengeluaran dalam rentang tanggal
    $pengeluaran = Pengeluaran::whereBetween('tanggal', [$startDate, $endDate])->get();

    // Grupkan berdasarkan minggu
    $groupedPengeluaran = $pengeluaran->groupBy(function ($item) {
        return Carbon::parse($item->tanggal)->startOfWeek()->format('W');
    });

    // Hitung total masukan, pengeluaran, dan simpanan per minggu
    $totals = [];
    foreach ($groupedPengeluaran as $week => $items) {
        $totals[$week] = [
            'masukan' => $items->sum('pengeluaran') + $items->sum('simpanan'), 
            'pengeluaran' => $items->sum('pengeluaran'),
            'simpanan' => $items->sum('simpanan'), 
        ];
        
    }

    // Hitung total keseluruhan untuk footer
    $grandTotalMasukan = $pengeluaran->sum('pengeluaran') + $pengeluaran->sum('simpanan');
    $grandTotalPengeluaran = $pengeluaran->sum('pengeluaran');
    $grandTotalSimpanan = $pengeluaran->sum('simpanan');

    return view('admin.laporan_pengeluaran', compact(
        'groupedPengeluaran',
        'totals',
        'grandTotalMasukan',
        'grandTotalPengeluaran',
        'grandTotalSimpanan',
        'startDate',
        'endDate'
    ));
}

public function cetakLaporanPengeluaran(Request $request)
{
    $startDate = $request->query('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
    $endDate = $request->query('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));

    $pengeluaran = Pengeluaran::whereBetween('tanggal', [$startDate, $endDate])
        ->orderBy('tanggal')
        ->get();

    // Grupkan data berdasarkan minggu
    $groupedPengeluaran = $pengeluaran->groupBy(function ($item) {
        return Carbon::parse($item->tanggal)->weekOfMonth;
    });

    // Inisialisasi total mingguan dan keseluruhan
    $totals = [];
    $grandTotalMasukan = $grandTotalPengeluaran = $grandTotalSimpanan = 0;

    foreach ($groupedPengeluaran as $week => $items) {
        $totals[$week]['pengeluaran'] = $items->sum('pengeluaran');
        $totals[$week]['simpanan'] = $items->sum('simpanan');
        $totals[$week]['masukan'] = $totals[$week]['pengeluaran'] + $totals[$week]['simpanan'];

        // Hitung total keseluruhan
        $grandTotalPengeluaran += $totals[$week]['pengeluaran'];
        $grandTotalSimpanan += $totals[$week]['simpanan'];
        $grandTotalMasukan += $totals[$week]['masukan'];
    }

    // Generate PDF dengan data
    $pdf = \PDF::loadView('admin.laporan_pengeluaran_pdf', compact(
        'groupedPengeluaran',
        'totals',
        'startDate',
        'endDate',
        'grandTotalMasukan',
        'grandTotalPengeluaran',
        'grandTotalSimpanan'
    ));

    return $pdf->download('laporan_pengeluaran_donasi.pdf');
}


    // Menampilkan Form Tambah Pengeluaran
    public function tambahPengeluaran()
{
        return view('admin.tambah_pengeluaran');
}

    // Menyimpan Data Pengeluaran
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
            'pengeluaran' => 'required|numeric',
            'masukan' => 'required|numeric',
            'simpanan' => 'nullable|numeric',
            'keterangan' => 'nullable|string',
        ]);
    
        Pengeluaran::create([
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'pengeluaran' => $request->pengeluaran,
            'masukan' => $request->masukan,
            'simpanan' => $request->simpanan,
            'keterangan' => $request->keterangan,
        ]);
    
        return redirect()->route('admin.laporan_pengeluaran')->with('success', 'Pengeluaran berhasil ditambahkan.');
    }

    // Menampilkan Form Edit Pengeluaran
    public function editPengeluaran($id)
{
        $pengeluaran = Pengeluaran::findOrFail($id);
        return view('admin.edit_pengeluaran', compact('pengeluaran'));
}

    // Mengupdate Data Pengeluaran
    public function update(Request $request, $id)
{
    $pengeluaran = Pengeluaran::findOrFail($id);

    // Validasi data
    $request->validate([
        'tanggal' => 'required|date',
        'deskripsi' => 'required|string',
        'pengeluaran' => 'required|numeric',
        'masukan' => 'required|numeric',
        'simpanan' => 'nullable|numeric',
        'keterangan' => 'nullable|string',
    ]);

    // Update data pengeluaran
    $pengeluaran->update([
        'tanggal' => $request->tanggal,
        'deskripsi' => $request->deskripsi,
        'pengeluaran' => $request->pengeluaran,
        'masukan' => $request->masukan,
        'simpanan' => $request->simpanan,
        'keterangan' => $request->keterangan,
    ]);

    return redirect()->route('admin.laporan_pengeluaran')->with('success', 'Pengeluaran berhasil diperbarui.');
}


    public function deletePengeluaran($id)
    {
    $pengeluaran = Pengeluaran::findOrFail($id);
    $pengeluaran->delete();

    return redirect()->route('admin.laporan_pengeluaran')->with('success', 'Pengeluaran berhasil dihapus.');
    }

}
