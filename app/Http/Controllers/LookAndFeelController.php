<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadImageRequest;
use Inertia\Inertia;

class LookAndFeelController extends Controller
{
    public function index() {
        return Inertia::render('Admin/LookAndFeel');
    }

    public function uploadAvatar(UploadImageRequest $request) {
        $request->file('image')->storeAs('avatar', 'avatar.png', 'public');
        return back();
    }

    public function uploadBackground(UploadImageRequest $request) {
        $request->file('image')->storeAs('background', 'background.png', 'public');
        return back();
    }
}
