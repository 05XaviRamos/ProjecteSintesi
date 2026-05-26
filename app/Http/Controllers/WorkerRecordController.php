<?php

namespace App\Http\Controllers;

use App\Models\Records;
use App\Models\Zones;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class WorkerRecordController extends Controller
{
    /**
     * Display the worker send-record screen.
     */
    public function create(Request $request, ?int $zone = null): View|RedirectResponse
    {
        if (auth()->user()->is_admin) {
            return redirect()->route('dashboard');
        }

        if (! $zone) {
            return redirect()->route('worker.zone-selector');
        }

        $selectedZone = Zones::query()
            ->with([
                'materials' => fn ($query) => $query->orderBy('name'),
                'containers' => fn ($query) => $query->orderBy('name'),
            ])
            ->find($zone);

        if (! $selectedZone) {
            return redirect()->route('worker.zone-selector');
        }

        $materials = $selectedZone->materials;
        $containers = $selectedZone->containers;

        return view('worker.send-record', compact('materials', 'containers', 'selectedZone'));
    }

    /**
     * Store a newly created worker record.
     */
    public function store(Request $request): RedirectResponse
    {
        if (auth()->user()->is_admin) {
            return redirect()->route('dashboard');
        }

        $validator = validator($request->all(), [
            'zone_id' => ['required', 'exists:zones,id'],
            'material_id' => ['required', 'exists:materials,id'],
            'container_id' => ['required', 'exists:containers,id'],
            'total_weight' => ['required', 'numeric', 'min:0'],
            'active_containers' => ['required', 'integer', 'between:1,4'],
            'movement_type' => ['required', Rule::in(['entrada', 'sortida'])],
        ]);

        if ($validator->fails()) {
            return back()->withErrors([
                'form' => 'faltan dades',
            ])->withInput();
        }

        $validated = $validator->validated();

        $selectedZone = Zones::query()
            ->with([
                'materials' => fn ($query) => $query->orderBy('name'),
                'containers' => fn ($query) => $query->orderBy('name'),
            ])
            ->findOrFail($validated['zone_id']);

        $material = $selectedZone->materials->firstWhere('id', (int) $validated['material_id']);
        $container = $selectedZone->containers->firstWhere('id', (int) $validated['container_id']);

        if (! $material) {
            return back()->withErrors([
                'material_id' => 'El material seleccionat no pertany a la zona indicada.',
            ])->withInput();
        }

        if (! $container) {
            return back()->withErrors([
                'container_id' => 'El contenidor seleccionat no pertany a la zona indicada.',
            ])->withInput();
        }

        $movementField = $validated['movement_type'] === 'entrada' ? 'input' : 'output';

        if (! $material->{$movementField}) {
            return back()->withErrors([
                'material_id' => 'El material seleccionat no és vàlid per aquest tipus de moviment.',
            ])->withInput();
        }

        if (! $container->{$movementField}) {
            return back()->withErrors([
                'container_id' => 'El contenidor seleccionat no és vàlid per aquest tipus de moviment.',
            ])->withInput();
        }

        $finalWeight = $validated['total_weight'] - ($container->weight * $validated['active_containers']);

        if ($finalWeight < 0) {
            return back()->withErrors([
                'total_weight' => 'El pes final no pot ser negatiu.',
            ])->withInput();
        }

        Records::create([
            'user_id' => auth()->id(),
            'zone_id' => $selectedZone->id,
            'container_id' => $container->id,
            'material_id' => $material->id,
            'weight' => (int) round($finalWeight),
            'movement' => $validated['movement_type'],
        ]);

        return redirect()
            ->route('worker.send-record', ['zone' => $selectedZone->id])
            ->with('status', 'Registre afegit correctament');
    }
}
