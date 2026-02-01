<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function setorans()
    {
        return $this->belongsToMany(Setoran::class, 'nilai_setorans')->withPivot('nilai')->withTimestamps();
    }

    public function ujians()
    {
        return $this->belongsToMany(Ujian::class, 'nilai_ujians')->withPivot('nilai')->withTimestamps();
    }
}
