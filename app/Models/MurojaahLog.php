<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MurojaahLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal',
        'juz',
        'surat',
        'ayat',
        'status'
    ];

    public function target()
    {
        return $this->belongsTo(Target::class);
    }
}
