<?php

namespace App\Http\Controllers;

use App\Enums\FormFieldTypes;
use App\Models\Form;
use App\Http\Requests\StoreFormRequest;
use App\Http\Requests\UpdateFormRequest;
use App\Models\FormResult;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Whoops\Exception\Inspector;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/Forms/Index', [
            'forms' => Form::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render("Admin/Forms/Edit", [
            'form' => new Form(),
            'availableTypes' => FormFieldTypes::toSelectArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFormRequest $request)
    {
        // check if slug is unique
        $slug = Str::slug($request->title);

        if (Form::where('slug', $slug)->exists()) {
            return redirect()->back()->withErrors([
                'title' => 'The title has already been taken.'
            ]);
        }

        $form = new Form();
        $form->fill($request->validated());
        $form->slug = $slug;
        $form->save();

        $form->fields()->createMany($request->fields);

        return redirect()->route('forms.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Form $form)
    {
        // dont return the fields which are not visible
        $form->load(['fields' => function ($query) {
            $query->where('visible', true);
        }]);

        return Inertia::render("Admin/Forms/Form", [
            'form' => $form
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Form $form)
    {
        error_log($form->fields);

        return Inertia::render("Admin/Forms/Edit", [
            'form' => $form,
            'availableTypes' => FormFieldTypes::toSelectArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFormRequest $request, Form $form)
    {
        $form->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Form $form)
    {
        $form->delete();
    }

    /**
     * Shows the results
     */
    public function results(Form $form)
    {
        dd($form);

        return Inertia::render('Admin/Forms/Show', [
            'results' => $form->results()->with('fields')->get(),
        ]);
    }

}
