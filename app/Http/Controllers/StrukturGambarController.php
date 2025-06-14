<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StrukturGambar; // <-- Tambahkan ini

class StrukturGambarController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $file = $request->file('gambar');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('struktur'), $filename);

        StrukturGambar::create([
            'gambar' => $filename
        ]);

        return back()->with('success', 'Gambar struktur berhasil diunggah.');
    }

    public function show()
    {
        $gambar = StrukturGambar::latest()->first();
        return view('profil.struktur', compact('gambar'));
    }

}
