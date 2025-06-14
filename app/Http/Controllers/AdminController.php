<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Donasi;
use App\Models\Program;
use App\Models\DonasiForm;
use Midtrans\Transaction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
// use App\Http\Controllers\AdminController;


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

    // donasi form
    public function adminDonasi(Request $request)
    {
        $search = $request->input('search');

        $data = DonasiForm::when($search, function ($query) use ($search) {
            $query->where('nama_lengkap', 'like', '%' . $search . '%')
                ->orWhere('no_telp', 'like', '%' . $search . '%')
                ->orWhere('nominal', 'like', '%' . $search . '%');
        })->paginate(10);

        return view('admin.donasi', compact('data'));
    }

    public function tambahDonasi()
    {
        return view('admin.tambahdonasi');
    }

    public function postTambahDonasi(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'nominal' => 'required|numeric|min:1',
            'bukti_transfer' => 'nullable|image|max:2048',
        ]);

        $donasi = new DonasiForm();
        $donasi->nama_lengkap = $request->nama_lengkap;
        $donasi->no_telp = $request->no_telp;
        $donasi->nominal = $request->nominal;

        if ($request->hasFile('bukti_transfer')) {
            $file = $request->file('bukti_transfer');

            if (!File::exists(public_path('bukti_transfer'))) {
                File::makeDirectory(public_path('bukti_transfer'), 0755, true);
            }

            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $destination = public_path('bukti_transfer');

            $moved = $file->move($destination, $filename);

            if ($moved) {
                $donasi->bukti_transfer = 'bukti_transfer/' . $filename;
            } else {
                dd('Gagal memindahkan file!');
            }
        }

        $donasi->save();

        return redirect()->route('admin.donasi')->with('success', 'Donasi berhasil ditambahkan!');
    }

    public function editDonasi($id)
    {
        $data = DonasiForm::findOrFail($id);
        return view('admin.editdonasi', compact('data'));
    }

    public function postEditDonasi(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'nominal' => 'required|numeric|min:1',
            'bukti_transfer' => 'nullable|image|max:2048',
        ]);

        $donasi = DonasiForm::findOrFail($id);
        $donasi->nama_lengkap = $request->nama_lengkap;
        $donasi->no_telp = $request->no_telp;
        $donasi->nominal = $request->nominal;

        if ($request->hasFile('bukti_transfer')) {
            // hapus bukti lama jika ada
            if ($donasi->bukti_transfer && File::exists(public_path($donasi->bukti_transfer))) {
                File::delete(public_path($donasi->bukti_transfer));
            }

            $file = $request->file('bukti_transfer');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('bukti_transfer'), $filename);
            $donasi->bukti_transfer = 'bukti_transfer/' . $filename;
        }

        $donasi->save();

        return redirect()->route('admin.donasi')->with('success', 'Donasi berhasil diupdate!');
    }

    public function deleteDonasi($id)
    {
        $donasi = DonasiForm::find($id);

        if (!$donasi) {
            return back()->with('failed', 'Data donasi tidak ditemukan.');
        }

        // Hapus file bukti_transfer jika ada
        if ($donasi->bukti_transfer && File::exists(public_path($donasi->bukti_transfer))) {
            File::delete(public_path($donasi->bukti_transfer));
        }

        $donasi->delete();

        return back()->with('success', 'Data donasi berhasil dihapus.');
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