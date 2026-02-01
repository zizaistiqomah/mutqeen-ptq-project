<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;

    protected $fillable = [
        'santri_id',
        'penguji_id',
        'tanggal_ujian',
        'jumlah_ujian',
        'catatan',
        'nilai',
        'jam',
        'tempat_id',
        'isDone'
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    public function penguji()
    {
        return $this->belongsTo(Penguji::class);
    }

    public function surats()
    {
        return $this->belongsToMany(Surat::class, 'surat_ujians')->withTimestamps();
    }

    public function nilais()
    {
        return $this->belongsToMany(Nilai::class, 'nilai_ujians')->withPivot('nilai')->withTimestamps();
    }

    public function tempat()
    {
        return $this->belongsTo(Tempat::class);
    }
}
