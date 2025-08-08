<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Artwork extends Model
{
    protected $fillable = [
        'title', 'title_it', 'description', 'description_it', 'image_path', 'artist_name', 'year_created', 
        'uploaded_by', 'category_id'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function emotions(): HasMany
    {
        return $this->hasMany(ArtworkEmotion::class);
    }
}
