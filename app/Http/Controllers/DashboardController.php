<?php

namespace App\Http\Controllers;

use App\Models\Containers;
use App\Models\Materials;
use App\Models\Records;
use App\Models\Zones;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index(): View|RedirectResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        $records = Records::query()
            ->with(['user', 'zone', 'container', 'material'])
            ->latest()
            ->get();

        $totalInputWeight = Records::where('movement', 'entrada')->sum('wight');
        $totalOutputWeight = Records::where('movement', 'sortida')->sum('wight');
        $totalRecords = Records::count();
        $zoneCount = Zones::count();
        $materialCount = Materials::count();
        $containerCount = Containers::count();

        return view('dashboard', compact(
            'records',
            'totalInputWeight',
            'totalOutputWeight',
            'totalRecords',
            'zoneCount',
            'materialCount',
            'containerCount',
        ));
    }

    public function exportCsv(): RedirectResponse|\Symfony\Component\HttpFoundation\StreamedResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        $records = Records::query()
            ->with(['user', 'zone', 'container', 'material'])
            ->latest()
            ->get();

        return response()->streamDownload(function () use ($records) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['Usuari', 'Pes', 'Moviment', 'Material', 'Contenidor', 'Zona', 'Data']);

            foreach ($records as $record) {
                fputcsv($handle, [
                    $record->user?->name ?? '-',
                    $record->weight ?? 0,
                    $record->movement ?? '-',
                    $record->material?->name ?? '-',
                    $record->container?->name ?? '-',
                    $record->zone?->name ?? $record->zone?->nom ?? '-',
                    $record->created_at?->format('d/m/Y H:i') ?? '-',
                ]);
            }

            fclose($handle);
        }, 'registres.csv', [
            'Content-Type' => 'text/csv',
        ]);
    }
}
