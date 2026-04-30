<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Halaqah extends Model
{
    protected $fillable = [
        'nama_halaqah',
        'penyimak_id',
    ];

    public function penyimak()
    {
        return $this->belongsTo(Penyimak::class);
    }

    public function santris()
    {
        return $this->hasMany(Santri::class);
    }
}
