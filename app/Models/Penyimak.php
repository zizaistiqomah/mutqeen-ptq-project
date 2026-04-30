<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyimak extends Model
{
    protected $fillable = [
        'user_id',
        'no_hp',
        'tipe',
        'nim',
        'fakultas',
        'jurusan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

        public function setorans()
    {
        return $this->hasMany(Setoran::class);
    }

    public function halaqahs()
    {
        return $this->hasMany(Halaqah::class);
    }
}
