<?php

namespace App\Http\Controllers;

use App\Models\Containers;
use Illuminate\Http\Request;

class ContainersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // index s'ha de canviar a la vista on hi hagi el llistat de l'admin
        $containers = Containers::latest();
        return view('index', ['containers' => $containers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // create s'ha de canviar a la vista de creació de containers
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'weight' => 'required'
        ]);
        Containers::create($request->all());
        return redirect()->route('containers.index')->with('success', 'Nou contenidor afegit correctament');
    }

    /**
     * Display the specified resource.
     */
    public function show(Containers $containers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Containers $containers)
    {
        // edit s'ha de canviar a la vista de editar containers
        return view('edit', ['container' => $containers]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Containers $containers)
    {
        //
        $request->validate([
            'name' => 'required',
            'weight' => 'required'
        ]);
        $containers->update($request->all());
        return redirect()->route('containers.index')->with('success', 'Contenidor modificat correctament');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Containers $containers)
    {
        //
        $containers->delete();
        return redirect()->route('containers.index')->with('success', 'Contenidor eliminat correctament');
    }
}
