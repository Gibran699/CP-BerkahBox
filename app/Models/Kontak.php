<?php

nameSpace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kontak extends Model
{
    use HasFactory;
    protected $table = 'kontak';
    protected $primaryKey = 'id_kontak'; 
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'id_kontak',
        'id',
        'alamat',
        'no_telp',
        'facebook',
        'maps_url',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'id');
    }
}

