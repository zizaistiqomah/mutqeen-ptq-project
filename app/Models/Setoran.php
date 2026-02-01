<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    use HasFactory;

    protected $fillable = ['penguji_id', 'santri_id',  'jumlah_setoran', 'catatan', 'status', 'nilai', 'tanggal_setoran'];

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    public function penguji()
    {
        return $this->belongsTo(Penguji::class);
    }

    public function nilais()
    {
        return $this->belongsToMany(Nilai::class, 'nilai_setorans')->withPivot('nilai')->withTimestamps();
    }

    public function surats()
    {
        return $this->belongsToMany(Surat::class, 'surat_setorans')->withTimestamps();
    }
}
