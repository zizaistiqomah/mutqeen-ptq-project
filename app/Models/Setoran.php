<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'penyimak_id',
        'tanggal',
        'juz',
        'surat_mulai',
        'ayat_mulai',
        'surat_selesai',
        'ayat_selesai',
        'is_tasmi',
        'status',
        'nilai',
        'catatan',
        'surah',
        'jumlah_halaman',
        'halaman',
    ];


    // relasi ke santri
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relasi ke penyimak
    public function penyimak()
    {
        return $this->belongsTo(Penyimak::class);
    }

    public function santri()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}