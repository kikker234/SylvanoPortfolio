<?php

use App\Http\Controllers\LookAndFeelController;
use App\Http\Controllers\NodeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Models\Node;
use App\Services\NodesServices;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
    $nodes = new NodesServices();
    return Inertia::render("Landing", [
        "nodes" => $nodes->getAllNodes()
    ]);
});

Route::get('/admin/nodes', [NodeController::class, 'index'])->name("nodes");

Route::middleware(["auth", "verified"])->prefix("/admin")->group(function () {
    Route::resource('/nodes', NodeController::class)->except(['index']);
    Route::resource('/pages', PageController::class)->name('index', 'pages');

    Route::get('/look-and-feel', [LookAndFeelController::class, 'index'])->name('look-and-feel');
    Route::post('/look-and-feel/avatar', [LookAndFeelController::class, 'uploadAvatar'])->name('look-and-feel.avatar');
    Route::post('/look-and-feel/background', [LookAndFeelController::class, 'uploadBackground'])->name('look-and-feel.background');

    Route::inertia('/', "Dashboard", [
        "nodes" => (new NodesServices())->getAllNodes()
    ])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__ . '/auth.php';
