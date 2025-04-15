<?php

namespace App\Models;

use App\Models\Program;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Infodonasi extends Model
{
    use HasFactory;
    protected $table = 'info_donasi';
    protected $fillable = [
        'id_info_donasi',
        'id',
        'id_program_donasi',
        'deskripsi1',
        'fotodonasi1',
        'fotodonasi2',
        'fotodonasi3',
        'deskripsi2',
    ];

    public function program_donasi(){
        return $this->belongsTo(Program::class, 'id_program_donasi');
    }
    public function users(){
        return $this->belongsTo(User::class, 'id');
    }
}
