<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\EmotionController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\ArtworkController;
use App\Http\Controllers\Dashboard\ReportController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

Route::get('/locale/{locale}', function ($locale) {
    Session::put('locale', $locale);

    return redirect()->back();
})->name('switchLan');

Route::get('/', function () {
    return view('pages.newLogin');
});
// Route::get('/newLogin', function () {
//     return view('pages.newLogin');
// });
Route::get('/login', function () {
    return view('pages.newLogin');
})->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Users
    Route::prefix('/users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/get-all', [UserController::class, 'getAll'])->withoutMiddleware('auth')->name('users.getAll');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // Emotions
    Route::prefix('/emotions')->group(function () {
        Route::get('/', [EmotionController::class, 'index'])->name('emotions');
        Route::get('/get-all', [EmotionController::class, 'getAll'])->withoutMiddleware('auth')->name('emotions.getAll');
    });

    // Categories
    Route::prefix('/categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories');
        Route::get('/get-all', [CategoryController::class, 'getAll'])->withoutMiddleware('auth')->name('categories.getAll');
        Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });

    // Profile
    Route::prefix('/admin')->group(function () {
        Route::get('/profile', [AdminController::class, 'index'])->name('profile');
        Route::post('/update/{id}', [AdminController::class, 'update'])->name('admin.update');
        Route::post('/reset-password', [AdminController::class, 'resetPassword'])->name('admin.resetPassword');
    });

    // Artworks
    Route::prefix('/artworks')->group(function () {
        Route::get('/', [ArtworkController::class, 'index'])->name('artworks');
        Route::get('/get-all', [ArtworkController::class, 'getAll'])->withoutMiddleware('auth')->name('artworks.getAll');
        Route::post('/', [ArtworkController::class, 'store'])->name('artworks.store');
        Route::get('/{artwork}/edit', [ArtworkController::class, 'edit'])->name('artworks.edit');
        Route::put('/{artwork}', [ArtworkController::class, 'update'])->name('artworks.update');
        Route::delete('/{artwork}', [ArtworkController::class, 'destroy'])->name('artworks.destroy');
    });

    // Report
    Route::get('/emotions/report', [ReportController::class, 'index'])->name('emotions.report');
});

Route::get('/activity', function () {
    return view('activity');
});
