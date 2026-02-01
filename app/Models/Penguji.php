<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penguji extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setoran()
    {
        return $this->hasMany(Setoran::class);
    }

    public function ujian()
    {
        return $this->hasMany(Ujian::class);
    }
}
