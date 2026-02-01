<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tempat extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function ujians()
    {
        return $this->hasMany(Ujian::class);
    }
}
