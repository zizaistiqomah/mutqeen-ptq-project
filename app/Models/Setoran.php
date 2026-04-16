<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    protected $fillable = [
        'user_id',
        'juz',
        'surah',
        'ayat_mulai',
        'ayat_selesai',
        'tanggal_setor'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}