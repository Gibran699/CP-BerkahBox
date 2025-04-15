<?php

namespace App\Models;

use App\Models\Donasi;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'program_donasi';
    protected $primaryKey = 'id_program_donasi'; 
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'id_program_donasi',
        'id',
        'nama_program',
        'deskripsi',
        'foto',
        'tanggal_mulai',
        'tanggal_selesai',
        'foto2',
        'foto3',
        'tittle'
    ];

    public function donasi_pembayaran(){
        return  $this->hasMany(Donasi::class);
    }
    public function users(){
        return $this->belongsTo(User::class, 'id');
    }
}
