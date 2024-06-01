<?php

use App\Http\Controllers\NodeController;
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

    Route::inertia('/', "Dashboard", [
        "nodes" => (new NodesServices())->getAllNodes()
    ])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__ . '/auth.php';
