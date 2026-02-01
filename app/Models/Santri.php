<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nim',
        'major_id',
        'jumlah_hafalan',
        'informasi_hafalan'
    ];

    protected $casts = [
        'informasi_hafalan' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function setoran()
    {
        return $this->hasMany(Setoran::class);
    }

    public function verifiedSetoran()
    {
        return $this->hasMany(SantriVerifiedSetoran::class);
    }

    public function verifiedUjian()
    {
        return $this->hasMany(SantriVerifiedUjian::class);
    }

    public function ujian()
    {
        return $this->hasMany(Ujian::class);
    }
}
