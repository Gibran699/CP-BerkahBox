<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Donasi;
use App\Models\Program;
use Midtrans\Transaction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\AdminController;


class AdminController extends Controller
{
    // ini program
    public function admin(){
        return view('admin.admin');
    }

    // AdminController.php
    public function adminProgram(Request $request, $show_hidden = false)
{
    $search = $request->input('search');

    $query = Program::query();

    if (!$show_hidden) {
        $query->whereNull('deleted_at');
    }
    $data = $query->when($search, function ($query) use ($search) {
        $query->where('nama_program', 'LIKE', '%' . $search . '%');
    })->paginate(50);

    return view('admin.program_donasi', compact('data', 'show_hidden'));
}

    public function tambahProgram() {
        return view('admin.tambahprogram_donasi');
    }

    public function postTambahProgram(Request $request) {
        $request->validate([
            'nama_program' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|image|max:5120',
            'foto2' => 'nullable|image|max:5120',
            'foto3' => 'nullable|image|max:5120',
            'tittle' => 'nullable|string|max:255',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
        ]);

        $program = new Program;
        $program->id = Auth::id();
        $program ->nama_program  = $request->nama_program;
        $program ->deskripsi = $request->deskripsi;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_foto' . $extension;
        
            if ($file->move('foto/', $filename)) {
                $program->foto = $filename;
            } else {
                return back()->with('failed', 'Gagal mengupload gambar. Harap pilih gambar yang valid.');
            }
        }

        if ($request->hasFile('foto2')) {
            $file = $request->file('foto2');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_foto2' . $extension;
        
            if ($file->move('foto/', $filename)) {
                $program->foto2 = $filename;
            } else {
                return back()->with('failed', 'Gagal mengupload gambar. Harap pilih gambar yang valid.');
            }
        }

        if ($request->hasFile('foto3')) {
            $file = $request->file('foto3');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_foto3' . $extension;
        
            if ($file->move('foto/', $filename)) {
                $program->foto3 = $filename;
            } else {
                return back()->with('failed', 'Gagal mengupload gambar. Harap pilih gambar yang valid.');
            }
        }
        $program->tittle = $request->tittle;
        $program ->tanggal_mulai = $request->tanggal_mulai;
        $program ->tanggal_selesai = $request->tanggal_selesai;

        $program ->save();
        
        if($program ) {
            return back()->with('success', 'Program Donasi Berhasil ditambahkan!'); 
        } else {
            return back()->with('failed', 'Gagal Menambahkan Donasi!');
        }
    }
    public function editProgram($id_program_donasi) {
        $data = Program::findOrFail($id_program_donasi);
        
        return view('admin/editprogram_donasi', compact('data'));
    }
    public function postEditProgram(Request $request, $id_program_donasi) {
        $request->validate([
            'nama_program' => 'required',
            'deskripsi' => 'required',
            'foto' => 'image|max:5120',
            'foto2' => 'nullable|image|max:5120',
            'foto3' => 'nullable|image|max:5120',
            'tittle' => 'nullable|string|max:255',
        ]);
        
        $program = Program::findOrFail($id_program_donasi);

        $program ->nama_program  = $request->nama_program;
        $program ->deskripsi = $request->deskripsi;

        if ($request->hasFile('foto')) {
            $oldFilePath = 'foto/' . $program->foto;
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }
            $file = $request->file('foto');
            $filename = time() . '_foto.' . $file->getClientOriginalExtension();
            $file->move('foto/', $filename);
            $program->foto = $filename;
        }
    
        if ($request->hasFile('foto2')) {
            $oldFilePath = 'foto/' . $program->foto2;
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }
            $file = $request->file('foto2');
            $filename = time() . '_foto2.' . $file->getClientOriginalExtension();
            $file->move('foto/', $filename);
            $program->foto2 = $filename;
        }
    
        if ($request->hasFile('foto3')) {
            $oldFilePath = 'foto/' . $program->foto3;
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }
            $file = $request->file('foto3');
            $filename = time() . '_foto3.' . $file->getClientOriginalExtension();
            $file->move('foto/', $filename);
            $program->foto3 = $filename;
        }

        $program->tittle = $request->tittle;
        $program ->tanggal_mulai = $request->tanggal_mulai;
        $program ->tanggal_selesai = $request->tanggal_selesai;

        $program->save(); 

        return redirect()->route('admin.program_donasi')->with('success', 'Program Berhasil Diperbarui!');
    }

    public function deleteProgram($id_program_donasi) {
        $data = Program::find($id_program_donasi);
        if ($data) {
            // Menghapus file foto jika ada
            if (File::exists('foto/' . $data->foto)) {
                File::delete('foto/' . $data->foto);
            }
            if (File::exists('foto/' . $data->foto2)) {
                File::delete('foto/' . $data->foto2);
            }
            if (File::exists('foto/' . $data->foto3)) {
                File::delete('foto/' . $data->foto3);
            }
            $data->delete();
            return back()->with('success', 'Program Kegiatan berhasil dihapus!');
        } else {
            return back()->with('failed', 'Program Kegiatan tidak ditemukan!');
        }
    }
    // program


    //ini donasi

public function adminDonasi(Request $request, $show_hidden = false)
{
    $search = $request->input('search');
    $query = Donasi::query();

    $data = $query->when($search, function ($query) use ($search) {
        $query->where('nama_donatur', 'LIKE', '%' . $search . '%');
    })->paginate(10);

    foreach ($data as $donasi) {
        try {
            $status = Transaction::status($donasi->order_id);
            $transactionStatus = $status->transaction_status;

            // Update status berdasarkan transaksi di Midtrans
            if (in_array($transactionStatus, ['capture', 'settlement'])) {
                $donasi->status = 'success';
            } elseif ($transactionStatus === 'pending') {
                $donasi->status = 'pending';
            } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
                $donasi->status = 'cancel';
            } elseif ($transactionStatus === 'failure' || $status->fraud_status === 'challenge') {
                $donasi->status = 'failed';
            }

            $donasi->save();
        } catch (\Exception $e) {
            Log::error("Error syncing status for order_id {$donasi->order_id}: " . $e->getMessage());
        }
    }

    return view('admin.donasi', compact('data', 'show_hidden'));
}


    public function tambahDonasi() {
            $programs = Program::all();

            return view('admin.tambahdonasi', compact('programs'));
        
    }

    public function postTambahDonasi(Request $request) {
        $request->validate([
            'id_program_donasi' => 'required|exists:program_donasi,id_program_donasi',
            'nama_donatur'=> 'required|string|max:255',
            'no_telp'=> 'required|string|max:15',
            'email'=> 'required|email',
            'nominal' => 'required',
            'status' => ['required', 'in:success,pending,failed'],

        ]);

        $donasii = new Donasi;
        $donasii->id = Auth::id();
        $donasii ->id_program_donasi = $request->id_program_donasi;
        $donasii ->nama_donatur = $request->nama_donatur;
        $donasii ->no_telp = $request->no_telp;
        $donasii ->email = $request->email;
        $donasii ->nominal = $request->nominal;
        
        $donasii ->status = $request->status;

        $donasii->save();
        
        if($donasii ) {
            return back()->with('success', 'Donasi Berhasil ditambahkan!'); 
        } else {
            return back()->with('failed', 'Gagal Menambahkan Donasi!');
        }
    }

    public function editDonasi($id_donasi_pembayaran) {
            $data = Donasi::find($id_donasi_pembayaran);
            $programs = Program::all();
        
            return view('admin.editdonasi', compact('data', 'programs'));
        }  

    public function postEditDonasi(Request $request, $id_donasi_pembayaran) {
        $request->validate([
            'nama_donatur'=> 'required|string|max:255',
            'no_telp'=> 'required|string|max:15',
            'email'=> 'required|email',
            'nominal' => 'required',
            'status' => ['required', 'in:success,pending,failed'],
            'id_program_donasi' => 'required|exists:program_donasi,id_program_donasi',
        ]);
        
        $donasii = Donasi::findOrFail($id_donasi_pembayaran);
        $donasii ->id_program_donasi = $request->id_program_donasi;
        $donasii ->nama_donatur = $request->nama_donatur;
        $donasii ->no_telp = $request->no_telp;
        $donasii ->email = $request->email;
        $donasii ->nominal = $request->nominal;
        $donasii->status = $request->status;

        $donasii->save();
        
        if($donasii){
            return back()->with('success', 'Donasi berhasil di update!'); 
        } else {
            return back()->with('failed', 'Gagal mengupdate Donasi!');
        }
    }
    

    public function deleteDonasi($id_donasi_pembayaran) {
        $donasii = Donasi::find($id_donasi_pembayaran);
        $donasii->delete();

        if ($donasii) {
            return back()->with('success', 'Data Donasi berhasil dihapus!');
        } else {
            return back()->with('failed', 'Gagal menghapus data Donasi!');
        }
    }

    // data donatur
    public function dataDonatur(Request $request)
{
    $query = User::where('role', 'user')
        ->with(['donasi_pembayaran' => function ($query) {
            $query->where('status', 'success');
        }]);

    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
              ->orWhere('email', 'like', '%' . $search . '%')
              ->orWhere('no_telp', 'like', '%' . $search . '%');
        });
    }

    $data = $query->paginate(10);

    return view('admin.donatur', compact('data'));
}

}