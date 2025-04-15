<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $table = 'pengeluaran'; 

    protected $fillable = [
        'tanggal',
        'deskripsi',
        'pengeluaran',
        'masukan', 
        'simpanan', 
        'keterangan', 
    ];

    public function getMingguKeAttribute()
    {
        return Carbon::parse($this->tanggal)->weekOfMonth;
    }
}
