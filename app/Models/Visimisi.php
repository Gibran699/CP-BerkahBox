<?php

nameSpace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visimisi extends Model
{
    use HasFactory;

    protected $table = 'visimisi';
    protected $primaryKey = 'id_visimisi'; 
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'id_visimisi',
        'id',
        'visi',
        'misi',
    ];
    public function users(){
        return $this->belongsTo(User::class, 'id');
    }
}

