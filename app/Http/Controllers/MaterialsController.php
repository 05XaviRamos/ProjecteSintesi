<?php

namespace App\Http\Controllers;

use App\Models\Materials;
use Illuminate\Http\Request;

class MaterialsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // canviar index per nom de vista de llistar materials de l'admin
        $materials = Materials::latest();
        return view('index', ['materials' => $materials]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // canviar create per vista de crear materials
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required'
        ]);
        Materials::create($request->all());
        return redirect()->route('materials.index')->with('success', 'Nou material afegit correctament');
    }

    /**
     * Display the specified resource.
     */
    public function show(Materials $materials)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Materials $materials)
    {
        //canviar edit per vista de editar material
        return view('edit', ['material' => $materials]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Materials $materials)
    {
        //
        $request->validate([
            'name' => 'required'
        ]);
        $materials->update($request->all());
        return redirect()->route('materials.index')->with('success', 'Material modificat correctament');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Materials $materials)
    {
        //
        $materials->delete();
        return redirect()->route('materials.index')->with('success', 'Material eliminat correctament');
    }
}
