<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    protected $table = 'santris';

    protected $fillable = [
        'user_id',
        'nim',
        'no_hp',
        'fakultas',
        'jurusan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function halaqah()
    {
        return $this->belongsTo(Halaqah::class);
    }

    public function setorans()
    {
        return $this->hasMany(Setoran::class, 'user_id', 'user_id');
    }
}