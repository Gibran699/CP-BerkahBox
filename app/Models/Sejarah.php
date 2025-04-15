<?php

nameSpace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sejarah extends Model
{
    use HasFactory;
    protected $table = 'sejarah';
    protected $primaryKey = 'id_sejarah'; 
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'id_sejarah',
        'id',
        'tekssejarah',
        'tekssejarah2',
        'tekssejarah3',
        'tekssejarah4',
    ];
    public function users(){
        return $this->belongsTo(User::class, 'id');
    }
}

