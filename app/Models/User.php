<?php

namespace App\Models;

use App\Models\Donasi;
use App\Models\Galeri;
use App\Models\Jemput;
use App\Models\Kontak;
use App\Models\Program;
use App\Models\Sejarah;
use App\Models\Struktur;
use App\Models\Visimisi;
use App\Models\Pengajuan;
use App\Models\Infodonasi;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable implements CanResetPassword
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'no_telp',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Determine if the user is an admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function donasi_pembayaran(){
        return $this->hasMany(Donasi::class, 'id', 'id');
    }
    public function galerii(){
        return $this->hasMany(Galeri::class);
    }
    public function kontak(){
        return $this->hasMany(Kontak::class);
    }
    public function program_donasi(){
        return $this->hasMany(Program::class);
    }
    public function visimisi(){
        return $this->hasMany(Visimisi::class);
    }
    public function sejarah(){
        return $this->hasMany(Sejarah::class);
    }
    public function struktur_yayasan(){
        return $this->hasMany(Struktur::class);
    }
    public function pengajuan(){
        return $this->hasMany(Pengajuan::class);
    }
    public function jemput(){
        return $this->hasMany(Jemput::class);
    }
    public function infodonasi(){
        return $this->hasMany(Infodonasi::class);
    }
}
