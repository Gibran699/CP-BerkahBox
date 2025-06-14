<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/StrukturGambar.php
class StrukturGambar extends Model
{
    use HasFactory;
    protected $table = 'struktur_gambar';
    protected $fillable = ['gambar'];
}
