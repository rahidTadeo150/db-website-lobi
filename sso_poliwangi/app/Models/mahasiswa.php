<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class mahasiswa extends Authenticatable
{
    use HasFactory, HasApiTokens;
    protected $table = 'mahasiswa';
    protected $guarded = ['id'];
  
    protected $casts = [
        'password' => 'hashed',
    ];
    
    public function prodi() 
    {
        return $this->belongsTo(prodi::class);
    }
}