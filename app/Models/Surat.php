<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function setorans()
    {
        return $this->belongsToMany(Setoran::class, 'surat_setorans')->withTimestamps();
    }

    public function ujians()
    {
        return $this->belongsToMany(Ujian::class, 'surat_ujians')->withTimestamps();
    }
}
