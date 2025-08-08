<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artwork;
use App\Http\Resources\ArtworkResource;
use Illuminate\Support\Facades\Auth;


class ArtworkController extends Controller
{
    public function index()
    {
        $artworks = Artwork::with('category')->latest()->get();

        $lang = Auth::user()?->lang ?? 'en';

        $transformedArtworks = $artworks->map(function ($artwork) use ($lang) {
            return [
                'id' => $artwork->id,
                'title' => $lang === 'it' ? $artwork->title_it : $artwork->title,
                'description' => $lang === 'it' ? $artwork->description_it : $artwork->description,
                'image_path' => $artwork->image_path,
                'category_name' => $lang === 'it' ? $artwork->category?->name_it : $artwork->category?->name,
                'artist_name' => $artwork->artist_name,
            ];
        });

        return response()->json([
            'message' => 'Artworks retrieved successfully',
            'data' => [
                'artworks' => $transformedArtworks
            ],
        ]);
    }
}
