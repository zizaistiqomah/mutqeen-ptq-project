<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SantriVerifiedSetoran extends Model
{
    use HasFactory;

    protected $fillable = [
        'santri_id',
        'panitia_verified',
        'penguji_verified'
    ];

    public function santri(): BelongsTo
    {
        return $this->belongsTo(Santri::class);
    }


}
