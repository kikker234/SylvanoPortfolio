<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LookAndFeelController;
use App\Http\Controllers\NodeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialMediaController;
use Illuminate\Support\Facades\Route;


Route::get('/', [\App\Http\Controllers\LandingController::class, 'index'])->name('landing');

Route::middleware(["auth", "verified"])->prefix("/admin")->group(function () {
    Route::resource('/nodes', NodeController::class);
    Route::resource('/pages', PageController::class);
    Route::resource('/social-media', SocialMediaController::class);

    Route::get('/look-and-feel', [LookAndFeelController::class, 'index'])->name('look-and-feel');
    Route::post('/look-and-feel/avatar', [LookAndFeelController::class, 'uploadAvatar'])->name('look-and-feel.avatar');
    Route::post('/look-and-feel/background', [LookAndFeelController::class, 'uploadBackground'])->name('look-and-feel.background');

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__ . '/auth.php';

Route::get('/{page:title}', [PageController::class, 'show'])->name('page.show');
