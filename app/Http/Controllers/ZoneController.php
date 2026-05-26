<?php

namespace App\Http\Controllers;

use App\Models\Zones;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ZoneController extends Controller
{
    public function selector(): View|RedirectResponse
    {
        if (auth()->user()->is_admin) {
            return redirect()->route('dashboard');
        }

        $zones = Zones::all();

        return view('worker.zone-selector', compact('zones'));
    }

    public function index(): View|RedirectResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        $zones = Zones::query()->latest()->get();

        return view('admin.zones.zone-management', compact('zones'));
    }

    public function create(): View|RedirectResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        return view('admin.zones.create');
    }

    public function store(Request $request): RedirectResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:zones,name'],
        ]);

        Zones::create($validated);

        return redirect()->route('zones.index')->with('success', 'Zona creada correctament.');
    }

    public function edit(Zones $zone): View|RedirectResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        return view('admin.zones.edit', compact('zone'));
    }

    public function update(Request $request, Zones $zone): RedirectResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:zones,name,' . $zone->id],
        ]);

        $zone->update($validated);

        return redirect()->route('zones.index')->with('success', 'Zona actualitzada correctament.');
    }

    public function destroy(Zones $zone): RedirectResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        $zone->delete();

        return redirect()->route('zones.index')->with('success', 'Zona eliminada correctament.');
    }
}
