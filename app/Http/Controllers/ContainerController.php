<?php

namespace App\Http\Controllers;

use App\Models\Containers;
use App\Models\Zones;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContainerController extends Controller
{
    public function index(): View|RedirectResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        $containers = Containers::query()->latest()->get();

        return view('admin.containers.container-management', compact('containers'));
    }

    public function create(): View|RedirectResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        $zones = Zones::query()->orderBy('name')->get();

        return view('admin.containers.create', compact('zones'));
    }

    public function store(Request $request): RedirectResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:containers,name'],
            'weight' => ['required', 'integer', 'min:0'],
            'input' => ['nullable', 'boolean'],
            'output' => ['nullable', 'boolean'],
            'zones' => ['nullable', 'array'],
            'zones.*' => ['integer', 'exists:zones,id'],
        ]);

        $container = Containers::create([
            'name' => $validated['name'],
            'weight' => $validated['weight'],
            'input' => $request->boolean('input'),
            'output' => $request->boolean('output'),
        ]);

        $container->zones()->sync($validated['zones'] ?? []);

        return redirect()->route('containers.index')->with('success', 'Contenidor creat correctament.');
    }

    public function edit(Containers $container): View|RedirectResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        $zones = Zones::query()->orderBy('name')->get();
        $container->load('zones');

        return view('admin.containers.edit', compact('container', 'zones'));
    }

    public function update(Request $request, Containers $container): RedirectResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:containers,name,' . $container->id],
            'weight' => ['required', 'integer', 'min:0'],
            'input' => ['nullable', 'boolean'],
            'output' => ['nullable', 'boolean'],
            'zones' => ['nullable', 'array'],
            'zones.*' => ['integer', 'exists:zones,id'],
        ]);

        $container->update([
            'name' => $validated['name'],
            'weight' => $validated['weight'],
            'input' => $request->boolean('input'),
            'output' => $request->boolean('output'),
        ]);

        $container->zones()->sync($validated['zones'] ?? []);

        return redirect()->route('containers.index')->with('success', 'Contenidor actualitzat correctament.');
    }

    public function destroy(Containers $container): RedirectResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        $container->delete();

        return redirect()->route('containers.index')->with('success', 'Contenidor eliminat correctament.');
    }
}
