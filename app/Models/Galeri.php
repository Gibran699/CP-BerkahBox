<?php

nameSpace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Galeri extends Model
{
    use HasFactory;
    protected $table = 'galerii';
    protected $primaryKey = 'id_galerii'; 
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'id_galerii',
        'id',
        'tanggal',
        'foto',
        'deskripsi',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'id');
    }
}

