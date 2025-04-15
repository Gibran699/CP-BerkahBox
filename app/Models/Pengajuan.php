<?php

namespace App\Models;

use App\Models\Program;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengajuan extends Model
{
    use HasFactory;
    protected $table = 'pengajuan_donasi';
    protected $primaryKey = 'id_pengajuan_donasi'; 
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'id_pengajuan_donasi',
        'id',
        'id_program_donasi',
        'nama_lengkap',                
        'no_telp',
        'desc_pengajuan',
        'foto1',
        'foto2',
        'status',
    ];

    public function program_donasi(){
        return $this->belongsTo(Program::class, 'id_program_donasi');
    }
    public function users(){
        return $this->belongsTo(User::class, 'id');
    }
}
