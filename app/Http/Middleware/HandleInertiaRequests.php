<?php

namespace App\Http\Middleware;

use App\Models\Page;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'avatar' => $this->getAvatar(),
            'background' => $this->getBackground(),
            'pages' => $this->getPages(),
        ];
    }

    private function getAvatar() {
        if (file_exists(public_path('storage/avatar/avatar.png'))) {
            return asset('storage/avatar/avatar.png');
        }

        return 'https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png?20150327203541';
    }

    private function getBackground() {
        if (file_exists(public_path('storage/background/background.png'))) {
            return asset('storage/background/background.png');
        }

        return 'https://placehold.co/600x400';
    }

    private function getPages()
    {
        return Page::all()->map->only('id', 'title');
    }
}
