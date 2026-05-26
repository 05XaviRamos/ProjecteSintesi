<?php

namespace App\Http\Controllers;

use App\Models\Materials;
use App\Models\Zones;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MaterialController extends Controller
{
    public function index(): View|RedirectResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        $materials = Materials::query()->latest()->get();

        return view('admin.materials.material-management', compact('materials'));
    }

    public function create(): View|RedirectResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        $zones = Zones::query()->orderBy('name')->get();

        return view('admin.materials.create', compact('zones'));
    }

    public function store(Request $request): RedirectResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:materials,name'],
            'input' => ['nullable', 'boolean'],
            'output' => ['nullable', 'boolean'],
            'zones' => ['nullable', 'array'],
            'zones.*' => ['integer', 'exists:zones,id'],
        ]);

        $material = Materials::create([
            'name' => $validated['name'],
            'input' => $request->boolean('input'),
            'output' => $request->boolean('output'),
        ]);

        $material->zones()->sync($validated['zones'] ?? []);

        return redirect()->route('materials.index')->with('success', 'Material creat correctament.');
    }

    public function edit(Materials $material): View|RedirectResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        $zones = Zones::query()->orderBy('name')->get();
        $material->load('zones');

        return view('admin.materials.edit', compact('material', 'zones'));
    }

    public function update(Request $request, Materials $material): RedirectResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:materials,name,' . $material->id],
            'input' => ['nullable', 'boolean'],
            'output' => ['nullable', 'boolean'],
            'zones' => ['nullable', 'array'],
            'zones.*' => ['integer', 'exists:zones,id'],
        ]);

        $material->update([
            'name' => $validated['name'],
            'input' => $request->boolean('input'),
            'output' => $request->boolean('output'),
        ]);

        $material->zones()->sync($validated['zones'] ?? []);

        return redirect()->route('materials.index')->with('success', 'Material actualitzat correctament.');
    }

    public function destroy(Materials $material): RedirectResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        $material->delete();

        return redirect()->route('materials.index')->with('success', 'Material eliminat correctament.');
    }
}
