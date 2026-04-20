<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    protected $fillable = [
        'user_id',
        'juz',
        'surat',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function murojaahLogs()
    {
        return $this->hasMany(MurojaahLog::class);
    }
}