<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\Program;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function adminHome() {
        $user = auth()->user();

        $jumlahDonasiDiterima = Donasi::where('status', 'success')->sum('nominal');
        $jumlahPengajuan = Pengajuan::where('status', 'Diterima')->count();
        $jumlahDonatur = User::where('role', 'user')->count();
        return view('admin.admin', compact('jumlahDonasiDiterima', 'jumlahPengajuan', 'jumlahDonatur'));
    }
    
    public function postLogin(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|max:20'
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.admin');
            } elseif ($user->role === 'user') {
                return redirect()->route('user.dashboard');
            }
        }
    
        return back()->with('failed', 'Login gagal! Periksa email atau password.');
    }
    
    // registrasi donatur
    public function postRegister(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'no_telp'=> 'required|string|max:15',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan pengguna ke database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_telp'=> $request->no_telp,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return redirect()->route('auth.login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
    
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

    return redirect()->route('home');}

}
