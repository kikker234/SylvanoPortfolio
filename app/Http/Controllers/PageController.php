<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Page;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use Inertia\Inertia;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/Pages')->with([
            'pages' => Page::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/PageEditor');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePageRequest $request)
    {
        Page::insert($request->validated());

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        $formId = $page->form_id;

        if ($formId) {
            $page->form = Form::find($formId)->with('fields')->first();
        }

        return Inertia::render("CustomPage")->with([
            'page' => $page,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return Inertia::render('Admin/PageEditor')->with([
            'page' => $page,
            'forms' => Form::select("id", "title")->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        $validated = $request->validated();

        $page->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'form_id' => $validated['form_id'] != -1 ? $validated['form_id'] : null,
        ]);

        return redirect()->route('pages.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        $page->delete();

        return back();
    }
}
