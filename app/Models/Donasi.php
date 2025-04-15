<?php

nameSpace App\Models;

use App\Models\Program;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donasi extends Model
{
    use HasFactory;
    protected $table = 'donasi_pembayaran';
    protected $primaryKey = 'id_donasi_pembayaran'; 
    public $incrementing = true;
    protected $keyType = 'int';
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];    
    protected $fillable = [
        'id_donasi_pembayaran',
        'order_id',
        'id',
        'id_program_donasi',
        'nama_donatur',
        'email',
        'no_telp',
        'nominal',
        'status',
        'snap_token',
    ];

    public function program_donasi(){
        return $this->belongsTo(Program::class, 'id_program_donasi', 'id_program_donasi');
    }
    public function users(){
        return $this->belongsTo(User::class, 'id');
    }
}

