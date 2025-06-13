<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonasiForm extends Model
{
    protected $table = 'donasi_forms';

    protected $fillable = [
        'nama_lengkap',
        'no_telp',
        'nominal',
        'bukti_transfer',
    ];
}
