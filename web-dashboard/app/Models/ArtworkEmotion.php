<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArtworkEmotion extends Model
{
    protected $fillable = [
        'user_id', 'artwork_id', 'emotion_id', 'detected_at', 'waiting_time',
    ];

    protected $dates = ['detected_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function artwork(): BelongsTo
    {
        return $this->belongsTo(Artwork::class);
    }

    public function emotion(): BelongsTo
    {
        return $this->belongsTo(Emotion::class);
    }
}
