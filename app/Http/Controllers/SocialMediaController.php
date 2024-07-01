<?php

namespace App\Http\Controllers;

use App\Models\SocialMedia;
use App\Http\Requests\StoreSocialMediaRequest;
use App\Http\Requests\UpdateSocialMediaRequest;
use Inertia\Inertia;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/SocialMedia', [
            'socialMedia' => SocialMedia::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSocialMediaRequest $request)
    {
        $icon = $request->name;
        $icon = strtolower($icon);
        $icon = str_replace(' ', '-', $icon);

        SocialMedia::insert([
            'name' => $request->name,
            'url' => $request->url,
            'icon' => $icon,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(SocialMedia $socialMedia)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SocialMedia $socialMedia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSocialMediaRequest $request, $id)
    {
        $icon = $request->name;
        $icon = strtolower($icon);
        $icon = str_replace(' ', '-', $icon);

        $socialMedia = SocialMedia::find($id);
        $socialMedia->icon = $icon;

        $socialMedia->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        SocialMedia::destroy($id);

        return redirect()->route('social-media.index');
    }
}
