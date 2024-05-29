<?php

use App\Http\Controllers\NodeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(["auth", "verified"])->prefix("/admin")->group(function () {
    Route::resource('/nodes', NodeController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::inertia('/', "Dashboard")->name('dashboard');
    Route::inertia('/about-me', "Admin/AboutMe")->name('about-me');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__ . '/auth.php';
