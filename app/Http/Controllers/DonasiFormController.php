<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            $path = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
            $validated['bukti_transfer'] = $path;
        }

        // Simpan ke DB
        DonasiForm::create($validated);

        // Redirect balik dengan pesan sukses
        return redirect()->back()->with('success', 'Data donasi berhasil disimpan.');
    }
}