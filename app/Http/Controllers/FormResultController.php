<?php

namespace App\Http\Controllers;

use App\Models\FormResult;
use App\Http\Requests\StoreFormResultRequest;
use App\Http\Requests\UpdateFormResultRequest;

class FormResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreFormResultRequest $request)
    {
        $ip = request()->ip();
        $userAgent = request()->header('User-Agent');
        $formId = $request->form_id;

        $name = $request->name;
        $email = $request->email;

        FormResult::create([
            'ip_address' => $ip,
            'user_agent' => $userAgent,
            'form_id' => $formId,
            'name' => $name,
            'email' => $email,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(FormResult $formResult)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FormResult $formResult)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFormResultRequest $request, FormResult $formResult)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FormResult $formResult)
    {
        //
    }
}
