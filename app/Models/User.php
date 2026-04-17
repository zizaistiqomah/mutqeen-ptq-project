<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];



    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    
        public function santri()
    {
        return $this->hasOne(Santri::class);
    }

    public function pengurus()
    {
        return $this->hasOne(Pengurus::class);
    }

    public function penyimak()
    {
        return $this->hasOne(Penyimak::class);
    }

        public function setorans()
    {
        return $this->hasMany(Setoran::class);
    }


}
