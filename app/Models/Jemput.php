<?php

namespace App\Models;

use App\Models\Program;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jemput extends Model
{
    use HasFactory;
    protected $table = 'donasi_jemput';
    protected $primaryKey = 'id_donasi_jemput'; 
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'id_donasi_jemput',
        'id',
        'id_program_donasi',
        'nama_donatur',
        'no_hp',
        'barang_donasi',
        'foto_pengambilan',
        'foto_penyerahan',
        'status',
    ];

    public function program_donasi(){
        return $this->belongsTo(Program::class, 'id_program_donasi');
    }
    public function users(){
        return $this->belongsTo(User::class, 'id');
    }
}
