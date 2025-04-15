<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UserHomeController;
use App\Http\Controllers\UserDonasiController;
use App\Http\Controllers\UserProfilController;
use App\Http\Controllers\PengeluaranController;
use Illuminate\Support\Facades\Artisan;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/', [UserHomeController::class, 'UserHome'])->name('home');

// home utama
Route::get('/galeri/galeri', [UserProfilController::class, 'UserGaleri'])->name('galeri.galeri');
Route::get('/profil/sejarah', [UserProfilController::class, 'UserSejarah'])->name('profil.sejarah');
Route::get('/profil/visimisi', [UserProfilController::class, 'UserVisi'])->name('profil.visimisi');
Route::get('/profil/struktur', [UserProfilController::class, 'UserStruktur'])->name('profil.struktur');

// submit user
Route::get('/donasi/user', [UserDonasiController::class, 'showDonasiForm'])->name('donasi.donasi');
Route::get('/donasi/{id_program_donasi?}/infodonasi', [UserDonasiController::class, 'infodonasi'])->name('donasi.infodonasi');
Route::get('/donasi/form', [DonasiController::class, 'formDonasi'])->name('donasi.formdonasi');
Route::get('/donasi/bayar/{orderId}', [DonasiController::class, 'bayar'])->name('donasi.bayar');
Route::get('/donasi/berhasil/{orderId}', [DonasiController::class, 'berhasil'])->name('donasi.success');
Route::post('/donasi/bayar', [DonasiController::class, 'bayar'])->name('donasi.bayar');
Route::post('/donasi/callback', [DonasiController::class, 'callback']);
Route::post('/midtrans/callback', [DonasiController::class, 'callback']);
Route::post('/donasi/lanjut-pembayaran', [DonasiController::class, 'lanjutPembayaran'])->name('donasi.lanjut-pembayaran');

Route::get('/form/pengajuan', [UserProfilController::class, 'UserPengajuan'])->name('form.pengajuan');
Route::post('/pengajuan/submit', [UserProfilController::class, 'submitPengajuanForm'])->name('pengajuan.submit');

Route::get('/form/jemput', [UserProfilController::class, 'UserDonasiJemput'])->name('form.jemput');
Route::post('/jemput/submit', [UserProfilController::class, 'submitDonasiJemputForm'])->name('jemput.submit');

Route::middleware(['guest'])->group(function () {
    Route::get('/auth/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/auth/register', [AuthController::class, 'register'])->name('auth.register');

    Route::get('/forgot-password', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'reset'])->name('password.update');

});

// rute user yang telah login
Route::group(['middleware' => ['auth', 'user']], function ()
{

    Route::get('/user/dashboard', [UserController::class,'userHome'])->name('user.dashboard');
    Route::get('/user/historydonasi', [UserController::class,'userHistoryDonasi'])->name('user.riwayatdonasi');
    Route::get('/user/historydonasijemput', [UserController::class,'userHistoryDonasiJemput'])->name('user.donasijemput');
    Route::get('/user/historypengajuandonasi', [UserController::class,'userHistoryPengajuanDonasi'])->name('user.pengajuanuser');
    Route::get('/donatur/donasi-progress', [UserController::class, 'showDonasiProgress'])->name('user.donasi_progress');


});


// rute admin
Route::group(['middleware' => ['auth', 'admin']], function ()
{
    // login
    Route::get('/admin/admin', [LoginController::class,'adminHome'])->name('admin.admin');

    // program
    Route::get('/admin/program_donasi', [AdminController::class, 'adminProgram'])->name('admin.program_donasi');
    Route::get('/admin/tambahprogram_donasi', [AdminController::class, 'tambahProgram'])->name('admin.tambahprogram_donasi');
    Route::get('/admin/editprogram_donasi/{id_program_donasi}', [AdminController::class, 'editProgram'])->name('admin.editprogram_donasi');
    Route::get('/admin/deleteprogram_donasi/{id_program_donasi}', [AdminController::class, 'deleteProgram'])->name('admin.deleteprogram_donasi');

    // donasi
    Route::get('/admin/donasi', [AdminController::class, 'adminDonasi'])->name('admin.donasi');
    Route::get('/admin/tambahdonasi', [AdminController::class, 'tambahDonasi'])->name('admin.tambahdonasi');
    Route::get('/admin/editdonasi/{id_donasi_pembayaran}', [AdminController::class, 'editDonasi'])->name('admin.editdonasi');
    Route::get('/admin/deletedonasi/{id_donasi_pembayaran}', [AdminController::class, 'deleteDonasi'])->name('admin.deletedonasi');
    Route::get('/admin/laporan-donasi', [DonasiController::class, 'laporanDonasi'])->name('admin.laporan_donasi');

    Route::get('/admin/laporan_pengeluaran', [PengeluaranController::class, 'laporanPengeluaran'])->name('admin.laporan_pengeluaran');
    Route::get('/admin/laporan_pengeluaran/cetak', [PengeluaranController::class, 'cetakLaporanPengeluaran'])->name('admin.laporan_pengeluaran_pdf');
    Route::get('/laporan_pengeluaran/tambah', [PengeluaranController::class, 'tambahPengeluaran'])->name('admin.tambah_pengeluaran');
    Route::post('/laporan_pengeluaran/tambah', [PengeluaranController::class, 'store'])->name('admin.postTambahPengeluaran');
    Route::get('/laporan_pengeluaran/edit/{id}', [PengeluaranController::class, 'editPengeluaran'])->name('admin.edit_pengeluaran');
    Route::post('/laporan_pengeluaran/update/{id}', [PengeluaranController::class, 'update'])->name('admin.postEditPengeluaran');
    Route::delete('/admin/laporan_pengeluaran/delete/{id}', [PengeluaranController::class, 'deletePengeluaran'])->name('admin.deletePengeluaran');

    // donatur
    Route::get('/admin/user/donatur', [AdminController::class, 'dataDonatur'])->name('admin.donatur');

    // Profil
    // sejarah
    Route::get('/admin/sejarah', [ProfilController::class, 'adminSejarah'])->name('admin.sejarah');
    Route::get('/admin/tambahsejarah', [ProfilController::class, 'tambahSejarah'])->name('admin.tambahsejarah');
    Route::get('/admin/editsejarah/{id_sejarah}', [ProfilController::class, 'editSejarah'])->name('admin.editsejarah');
    Route::get('/admin/deletesejarah/{id_sejarah}', [ProfilController::class, 'deleteSejarah'])->name('admin.deletesejarah');

    // visimisi
    Route::get('/admin/visimisi', [ProfilController::class, 'adminVisimisi'])->name('admin.visimisi');
    Route::get('/admin/tambahvisimisi', [ProfilController::class, 'tambahVisimisi'])->name('admin.tambahvisimisi');
    Route::get('/admin/editvisimisi/{id_visimisi}', [ProfilController::class, 'editVisimisi'])->name('admin.editvisimisi');
    Route::get('/admin/deletevisimisi/{id_visimisi}', [ProfilController::class, 'deleteVisimisi'])->name('admin.deletevisimisi');

    // struktur_yayasan
    Route::get('/admin/struktur_yayasan', [ProfilController::class, 'adminStruktur'])->name('admin.struktur_yayasan');
    Route::get('/admin/tambahstruktur_yayasan', [ProfilController::class, 'tambahStruktur'])->name('admin.tambahstruktur_yayasan');
    Route::get('/admin/editstruktur_yayasan/{id_struktur_yayasan}', [ProfilController::class, 'editStruktur'])->name('admin.editstruktur_yayasan');
    Route::get('/admin/deletestruktur_yayasan/{id_struktur_yayasan}', [ProfilController::class, 'deleteStruktur'])->name('admin.deletestruktur_yayasan');
    
    // end profil

    // pengajuan
    Route::get('/admin/pengajuan', [ProfilController::class, 'adminPengajuan'])->name('admin.pengajuan');
    Route::get('/admin/editpengajuan/{id_pengajuan_donasi}', [ProfilController::class, 'editPengajuan'])->name('admin.editpengajuan');
    Route::get('/admin/deletepengajuan/{id_pengajuan_donasi}', [ProfilController::class, 'deletePengajuan'])->name('admin.deletepengajuan');

    // donasi jemput
    Route::get('/admin/donasi_jemput', [ProfilController::class, 'adminDonasijemput'])->name('admin.donasi_jemput');
    Route::get('/admin/editdonasi_jemput/{id_donasi_jemput}', [ProfilController::class, 'editDonasijemput'])->name('admin.editdonasi_jemput');
    Route::get('/admin/deletedonasi_jemput/{id_donasi_jemput}', [ProfilController::class, 'deleteDonasijemput'])->name('admin.deletedonasi_jemput');

    // galeri kegiatan
    Route::get('/admin/galeri', [ProfilController::class, 'adminGaleri'])->name('admin.galeri');
    Route::get('/admin/tambahgaleri', [ProfilController::class, 'tambahGaleri'])->name('admin.tambahgaleri');
    Route::get('/admin/editgaleri/{id_galerii}', [ProfilController::class, 'editGaleri'])->name('admin.editgaleri');
    Route::get('/admin/deletegaleri/{id_galerii}', [ProfilController::class, 'deleteGaleri'])->name('admin.deletegaleri');

    // kontak
    Route::get('/admin/kontak', [ProfilController::class, 'adminKontak'])->name('admin.kontak');
    Route::get('/admin/tambahkontak', [ProfilController::class, 'tambahKontak'])->name('admin.tambahkontak');
    Route::get('/admin/editkontak/{id_kontak}', [ProfilController::class, 'editKontak'])->name('admin.editkontak');
    Route::get('/admin/deletekontak/{id_kontak}', [ProfilController::class, 'deleteKontak'])->name('admin.deletekontak');

});   

// post login

Route::post('/postLogin', [LoginController::class, 'postLogin'])->name('postLogin');
Route::post('/postRegister', [LoginController::class, 'postRegister'])->name('postRegister');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// program POST
Route::post('/postTambahProgram', [AdminController::class, 'postTambahProgram'])->name('postTambahProgram');
Route::post('/postEditProgram/{id_program_donasi}', [AdminController::class, 'postEditProgram'])->name('postEditProgram');


// donasi POST
Route::post('/postTambahDonasi', [AdminController::class, 'postTambahDonasi'])->name('postTambahDonasi');
Route::post('/postEditDonasi/{id_donasi_pembayaran}', [AdminController::class, 'postEditDonasi'])->name('postEditDonasi');



// sejarah POST
Route::post('/postTambahSejarah', [ProfilController::class, 'postTambahSejarah'])->name('postTambahSejarah');
Route::post('/postEditSejarah/{id}', [ProfilController::class, 'postEditSejarah'])->name('postEditSejarah');


// Visimisi Post
Route::post('/postTambahVisimisi', [ProfilController::class, 'postTambahVisimisi'])->name('postTambahVisimisi');
Route::post('/postEditVisimisi/{id_visimisi}', [ProfilController::class, 'postEditVisimisi'])->name('postEditVisimisi');

// Pengajuan Post
Route::post('/postEditPengajuan/{id_pengajuan_donasi}', [ProfilController::class, 'postEditPengajuan'])->name('postEditPengajuan');

// Donasi Jemput Post
Route::post('/postEditDonasijemput/{id_donasi_jemput}', [ProfilController::class, 'postEditDonasijemput'])->name('postEditDonasijemput');

// struktur Post
Route::post('/postTambahStruktur', [ProfilController::class, 'postTambahStruktur'])->name('postTambahStruktur');
Route::post('/postEditStruktur/{id_struktur_yayasan}', [ProfilController::class, 'postEditStruktur'])->name('postEditStruktur');
// end struktur


// Galeri Post
Route::post('/postTambahGaleri', [ProfilController::class, 'postTambahGaleri'])->name('postTambahGaleri');
Route::post('/postEditGaleri/{id_galerii}', [ProfilController::class, 'postEditGaleri'])->name('postEditGaleri');
// end galeri


// Kontak Post
Route::post('/postTambahKontak', [ProfilController::class, 'postTambahKontak'])->name('postTambahKontak');
Route::post('/postEditKontak/{id_kontak}', [ProfilController::class, 'postEditKontak'])->name('postEditKontak');
// end kontak

Route::get('/run-donation-reminder', function () {
    Artisan::call('donation:reminder');
    return response()->json(['message' => 'Donation reminder executed']);
});


// php /home/u939290519/public_html/artisan donation:reminder
// /usr/bin/php /home/u939290519/domains/aisyahberbagi.site/public_html/artisan donation:reminder
// cat /home/u939290519/donation_cron.log
// grep CRON /var/log/syslog
// chmod +x /home/u939290519/domains/aisyahberbagi.site/public_html/artisan
// /usr/bin/php /home/u939290519/domains/aisyahberbagi.site/public_html/artisan donation:reminder >> /home/u939290519/donation_cron.log 2>&1
// ls -lah /var/spool/cron/
// cat /etc/cron.allow
// sudo systemctl status crond

// ssh -p 65002 u939290519@153.92.10.224