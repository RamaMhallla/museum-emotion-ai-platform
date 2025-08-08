<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArtworkEmotion;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ArtworkEmotionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'artwork_id' => 'required|exists:artworks,id',
            'emotion_id' => 'required|exists:emotions,id',
            'detected_at' => 'required|date',
            'waiting_time' => 'nullable|integer',
        ]);

        $artworkEmotion = ArtworkEmotion::create([
            'user_id' => $request->user()->id,
            'artwork_id' => $request->artwork_id,
            'emotion_id' => $request->emotion_id,
            'detected_at' => $request->detected_at,
            'waiting_time' => $request->waiting_time,
        ]);

        return response()->json([
            'message' => 'Emotion saved',
        ]);
    }
    public function storeFromRasphery(Request $request)
    {
        $request->validate([
            'artwork_id' => 'required|exists:artworks,id',
            'emotion_id' => 'required|exists:emotions,id',
            'detected_at' => 'required|date',
            'waiting_time' => 'nullable',
        ]);


        // Store the emotion data linked to the new visitor
        $artworkEmotion = ArtworkEmotion::create([
            'user_id' => 4,
            'artwork_id' => $request->artwork_id,
            'emotion_id' => $request->emotion_id,
            'detected_at' => $request->detected_at,
            'waiting_time' => $request->waiting_time,
        ]);

        // Optional: log the received request
        Log::info('Emotion Data Received:', $request->all());

        // Return JSON response
        return response()->json([
            'status' => 'ok',

            'received_data' => $request->all(),
        ]);
    }
}