<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Donasi;
use App\Models\Kontak;
use App\Models\Program;
use Midtrans\Transaction;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class DonasiController extends Controller
{
    public function formDonasi(Request $request){
        $id_program_donasi = $request->id_program_donasi;
        $kontak = Kontak::all();
        $program = Program::find($id_program_donasi);

        return view('donasi.formdonasi', compact('program', 'kontak'));}

    public function __construct()
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function lanjutPembayaran(Request $request)
    {
    $request->validate([
        'id_program_donasi' => 'required|exists:program_donasi,id_program_donasi',
        'nama_donatur' => 'required_if:guest,true|string|max:255',
        'no_telp' => 'required_if:guest,true|digits_between:10,15',
        'email' => 'required_if:guest,true|email',
        'nominal' => 'required|numeric|min:10000',
    ]);

    $program = Program::find($request->id_program_donasi);
    $kontak = Kontak::all();
    $user = Auth::user();
    $orderId = 'ORDER-' . uniqid();

    // Simpan data donasi langsung ke database
    $data = new Donasi();
    $data -> id = Auth::id();
    $data->id_program_donasi = $request->id_program_donasi;
    $data->nama_donatur = $user ? $user->name : $request->nama_donatur;
    $data->no_telp = $user ? $user->no_telp : $request->no_telp;
    $data->email = $user ? $user->email : $request->email;
    $data->nominal = $request->nominal;
    $data->order_id = $orderId;
    $data->status = 'pending';
    $data->save();

    // params Midtrans
    $params = [
        'transaction_details' => [
            'order_id' => $orderId,
            'gross_amount' => $request->nominal,
        ],
        'customer_details' => [
            'first_name' => $data->nama_donatur,
            'email' => $data->email,
            'phone' => $data->no_telp,
        ],
        'item_details' => [
            [
                'id' => 'program-' . $data->id_program_donasi,
                'price' => $data->nominal,
                'quantity' => 1,
                'name' => $program->nama_program,
            ],
        ],
    ];

    // Snap Token
    $snapToken = Snap::getSnapToken($params);

    // snap_token disimpan ke database
    $data->snap_token = $snapToken;
    $data->save();

    return view('donasi.lanjut-pembayaran', [
        'data' => $data,
        'snapToken' => $snapToken,
        'kontak' => $kontak,
    ]);
    
    }

    public function bayar($orderId)
    {
    $data = Donasi::where('order_id', $orderId)->firstOrFail();

    if (!$data) {
        return redirect()->route('donasi.formdonasi')->with('error', 'Data donasi tidak ditemukan.');
    }

    return view('donasi.lanjut-pembayaran', compact('data'));   
    }

    public function berhasil($orderId)
    {
    $kontak = Kontak::all();
    $data = Donasi::where('order_id', $orderId)->firstOrFail();

    return view('donasi.success', compact('data', 'kontak'));
    }

    public function callback(Request $request){
        $serverKey = config('services.midtrans.serverKey');
        $signatureKey = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        
        if ($signatureKey === $request->signature_key) {
            $order = Donasi::find($request->order_id);

            if ($order) {
                if ($request->transaction_status === 'settlement') {
                    $order->update(['status' => 'completed']);
                } elseif ($request->transaction_status === 'pending') {
                    $order->update(['status' => 'pending']);
                } elseif ($request->transaction_status === 'cancel') {
                    $order->update(['status' => 'cancel']);
                }
            }
        }
        return response()->json(['status' => 'success']);
    }


    public function laporanDonasi(Request $request){
    $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
    $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());

    $donasi = Donasi::where('status', 'success')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->get();

    if ($request->input('action') === 'cetak') {
        $pdf = Pdf::loadView('admin.laporan_donasi_pdf', compact('donasi', 'startDate', 'endDate'));
        return $pdf->download('laporan_pemasukan_donasi.pdf');
    }

    return view('admin.laporan_donasi', compact('donasi', 'startDate', 'endDate'));
}

}
