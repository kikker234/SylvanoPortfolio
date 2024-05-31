<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function upload($file): string
    {
        $path = $file->store('images', 'public');
        Storage::disk('public')->setVisibility($path, 'public');

        return $path;
    }

    public function delete($path): bool
    {
        return Storage::disk('public')->delete($path);
    }
}
