<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ArtworkController;
use App\Http\Controllers\API\ArtworkEmotionController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // profile
    Route::put('/user/update', [AuthController::class, 'update']);

    // artworks
    Route::get('/artworks', [ArtworkController::class, 'index']);

    // artwork emotions
    Route::post('/artwork-emotions', [ArtworkEmotionController::class, 'store']);
});
Route::post('/receive-data', [ArtworkEmotionController::class, 'storeFromRasphery']);