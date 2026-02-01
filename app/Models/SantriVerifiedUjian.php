<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SantriVerifiedUjian extends Model
{
    use HasFactory;

    protected $fillable = [
        'santri_id',
        'panitia_verified',
        'penguji_verified',
        'panitia_done',
        'penguji_done',
        'is_done'
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }
}

