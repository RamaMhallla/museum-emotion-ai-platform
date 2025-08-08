<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Emotion extends Model
{
    protected $fillable = [
        'name', 'name_it'
    ];

    public function artworkEmotions(): HasMany
    {
        return $this->hasMany(ArtworkEmotion::class);
    }
}
