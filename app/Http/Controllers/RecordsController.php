<?php

namespace App\Http\Controllers;

use App\Models\Records;
use Illuminate\Http\Request;

class RecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //canviar index per vista de llistat de records
        $records = Records::latest();
        return view('index', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //canviar create per vista de creació de records
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'zone_id' => 'required|exists:zones,id',
            'container_id' => 'required|exists:containers,id',
            'material_id' => 'required|exists:materials,id',
            'weight' => 'required|numeric',
            'movement' => 'required|in:input,output'
        ]);
        $user = $request->user();
        return redirect()->route('records.index')->with('success', 'Record created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Records $records)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Records $records)
    {
        // canviar edit per vista d'editar records
        //return view('edit', ['record' => $records]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Records $records)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Records $records)
    {
        //
    }
}
