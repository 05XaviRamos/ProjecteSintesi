<?php

namespace App\Http\Controllers;

use App\Models\Records;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): RedirectResponse
    {
        return redirect()->route('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): RedirectResponse
    {
        return redirect()->route('worker.zone-selector');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'zone_id' => 'required|exists:zones,id',
            'container_id' => 'required|exists:containers,id',
            'material_id' => 'required|exists:materials,id',
            'weight' => 'required|numeric',
            'movement' => 'required|in:input,output',
        ]);

        $request->user()->records()->create($request->all());

        return redirect()->route('dashboard')->with('success', 'Record created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Records $records): RedirectResponse
    {
        return redirect()->route('dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Records $records): RedirectResponse
    {
        return redirect()->route('dashboard');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Records $records): RedirectResponse
    {
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Records $records): RedirectResponse
    {
        return redirect()->route('dashboard');
    }
}
