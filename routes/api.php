<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonasiController; // Tambahkan ini

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route untuk mendapatkan user yang telah login
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Tambahkan route Midtrans callback di sini
Route::post('/midtrans/callback', [DonasiController::class, 'callback']);
