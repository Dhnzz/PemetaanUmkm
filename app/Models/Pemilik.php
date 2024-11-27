<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{HasMany, BelongsTo};

class Pemilik extends Model
{
    protected $fillable = [
        'name',
        'nib',
        'no_hp',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function umkm(): HasMany
    {
        return $this->hasMany(Umkm::class);
    }
}
