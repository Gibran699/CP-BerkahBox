<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\DonasiForm;

class DonasiFormController extends Controller
{
    public function store(Request $request)
    {
        $request->merge([
            'nominal' => preg_replace('/[^0-9]/', '', $request->nominal)
        ]);

        // Validasi data
        $validated = $request->validate([
            'nama_lengkap' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:20',
            'nominal' => 'nullable|numeric',
            'bukti_transfer' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Simpan file jika ada
        if ($request->hasFile('bukti_transfer')) {
            $file = $request->file('bukti_transfer');

            // Buat folder jika belum ada
            if (!File::exists(public_path('bukti_transfer'))) {
                File::makeDirectory(public_path('bukti_transfer'), 0755, true);
            }

            // Buat nama file unik
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();

            // Pindahkan file ke public/bukti_transfer
            $file->move(public_path('bukti_transfer'), $filename);

            // Simpan path relatif
            $validated['bukti_transfer'] = 'bukti_transfer/' . $filename;
        }

        // Simpan ke DB
        DonasiForm::create($validated);

        // Redirect balik dengan pesan sukses
        return redirect()->back()->with('success', 'Data donasi berhasil disimpan.');
    }
}