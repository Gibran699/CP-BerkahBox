<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Struktur extends Model
{
    use HasFactory;
    protected $table = 'struktur_yayasan';
    protected $primaryKey = 'id_struktur_yayasan'; 
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'id_struktur_yayasan',
        'id',
        'nama_pengurus',
        'jabatan',
        'foto_pengurus',
    ];
    public function users(){
        return $this->belongsTo(User::class, 'id');
    }
}
