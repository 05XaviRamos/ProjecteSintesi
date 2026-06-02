<?php

namespace App\Http\Controllers;

use App\Models\Zones;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ZoneController extends Controller
{
    /**
     * Mostra el selector de zones per al treballador.
     *
     * @return View|RedirectResponse
     */
    public function selector(): View|RedirectResponse
    {
        if (auth()->user()->is_admin) {
            return redirect()->route('dashboard');
        }

        $zones = Zones::all();

        return view('worker.zone-selector', compact('zones'));
    }

    /**
     * Mostra la gestió de zones.
     *
     * @return View|RedirectResponse
     */
    public function index(): View|RedirectResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        $zones = Zones::query()->latest()->get();

        return view('admin.zones.zone-management', compact('zones'));
    }

    /**
     * Mostra el formulari de creació de zones.
     *
     * @return View|RedirectResponse
     */
    public function create(): View|RedirectResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        return view('admin.zones.create');
    }

    /**
     * Desa una zona nova.
     *
     * @param Request $request
     * @return RedirectResponse
     */
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

    /**
     * Mostra el formulari d'edició d'una zona.
     *
     * @param Zones $zone
     * @return View|RedirectResponse
     */
    public function edit(Zones $zone): View|RedirectResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        return view('admin.zones.edit', compact('zone'));
    }

    /**
     * Actualitza una zona.
     *
     * @param Request $request
     * @param Zones $zone
     * @return RedirectResponse
     */
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

    /**
     * Elimina una zona.
     *
     * @param Zones $zone
     * @return RedirectResponse
     */
    public function destroy(Zones $zone): RedirectResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        $zone->delete();

        return redirect()->route('zones.index')->with('success', 'Zona eliminada correctament.');
    }
}
