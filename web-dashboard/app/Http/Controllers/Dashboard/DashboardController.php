<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ArtworkEmotion;
use App\Models\Artwork;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        $total_users = User::where('visitor', 0)->count();
        $total_visitors = User::where('visitor', 1)->count();

        $today_users = User::where('visitor', 0)
            ->whereDate('created_at', Carbon::today())
            ->count();

        $today_visitors = User::where('visitor', 1)
            ->whereDate('created_at', Carbon::today())
            ->count();
        $today = Carbon::today();

        // Get counts grouped by emotion ID
        $emotionCounts = DB::table('artwork_emotions')
            ->select(
                'emotion_id',
                DB::raw('COUNT(*) as count')
            )
            ->whereDate('detected_at', $today)
            ->groupBy('emotion_id')
            ->pluck('count', 'emotion_id'); // returns: [4 => 12, 5 => 6, ...]

        // Optional: load emotions for mapping
        $emotions = [
            1 => ['name' => 'Angry',    'name_it' => 'Arrabbiato'],
            2 => ['name' => 'Disgust',  'name_it' => 'Disgusto'],
            3 => ['name' => 'Fear',     'name_it' => 'Paura'],
            4 => ['name' => 'Happy',    'name_it' => 'Felice'],
            5 => ['name' => 'Sad',      'name_it' => 'Triste'],
            6 => ['name' => 'Surprise', 'name_it' => 'Sorpresa'],
            7 => ['name' => 'Neutral',  'name_it' => 'Neutrale'],
        ];
        $artworks = DB::table('artwork_emotions')
            ->join('artworks', 'artwork_emotions.artwork_id', '=', 'artworks.id')
            ->select(
                'artworks.id',
                'artworks.title', // Assuming 'title' exists in artworks table
                DB::raw('COUNT(artwork_emotions.id) as emotion_count')
            )
            ->groupBy('artworks.id', 'artworks.title')
            ->orderByDesc('emotion_count')
            ->limit(5) // Get top 5
            ->get();




        $total_captured_emotions = ArtworkEmotion::count();
        $average_time_spent = 1;
        //$popular_artist = 1;
        $total_artworks = Artwork::count();


        $today_viewed_artworks = 1;
        $today_common_emotion = 1;
        $today_common_artwork = 1;
        // // Return JSON response
        // return response()->json([
        //     'status' => 'ok',

        //     'emotionCounts' => $emotionCounts[4],
        // ]);


        return view(
            'pages.dashboard',
            compact(
                'total_visitors',
                'total_users',
                'today_visitors',
                'today_users',
                'emotionCounts',
                'emotions',
                'artworks',
                'total_captured_emotions',
                'average_time_spent',
                'total_artworks',
                'today_visitors',
                'today_viewed_artworks',
                'today_common_emotion',
                'today_common_artwork'
            )
        );
    }
}