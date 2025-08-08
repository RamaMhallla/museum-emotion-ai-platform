<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArtworkEmotion;

class ReportController extends Controller
{
    public function index()
    {
        $artworkEmotions = ArtworkEmotion::with(['user', 'artwork', 'emotion'])->get();

        return view('pages.emotions-report', compact('artworkEmotions'));
    }
}
