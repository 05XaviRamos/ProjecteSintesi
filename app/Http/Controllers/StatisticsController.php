<?php

namespace App\Http\Controllers;

use App\Models\Containers;
use App\Models\Materials;
use App\Models\Records;
use App\Models\Zones;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class StatisticsController extends Controller
{
    /**
     * Mostra les estadístiques amb filtres.
     *
     * @param Request $request
     * @return View|RedirectResponse
     */
    public function index(Request $request): View|RedirectResponse
    {
        if (! auth()->user()->is_admin) {
            return redirect()->route('worker.zone-selector');
        }

        $zones = Zones::query()->orderBy('name')->get();
        $materials = Materials::query()->orderBy('name')->get();
        $containers = Containers::query()->orderBy('name')->get();

        $records = Records::query()
            ->with(['user', 'zone', 'material', 'container'])
            ->when($request->filled('date_from'), function ($query) use ($request) {
                $query->where('created_at', '>=', Carbon::parse($request->string('date_from'))->startOfDay());
            })
            ->when($request->filled('date_to'), function ($query) use ($request) {
                $query->where('created_at', '<=', Carbon::parse($request->string('date_to'))->endOfDay());
            })
            ->when($request->filled('zone_id'), function ($query) use ($request) {
                $query->where('zone_id', $request->integer('zone_id'));
            })
            ->when($request->filled('material_id'), function ($query) use ($request) {
                $query->where('material_id', $request->integer('material_id'));
            })
            ->when($request->filled('container_id'), function ($query) use ($request) {
                $query->where('container_id', $request->integer('container_id'));
            })
            ->when($request->filled('movement_type'), function ($query) use ($request) {
                $query->where('movement', $request->string('movement_type')->toString());
            })
            ->latest()
            ->get();

        $totalInputWeight = $records
            ->where('movement', 'entrada')
            ->sum(fn (Records $record) => (float) ($record->weight ?? 0));

        $totalOutputWeight = $records
            ->where('movement', 'sortida')
            ->sum(fn (Records $record) => (float) ($record->weight ?? 0));

        $totalRecords = $records->count();
        $averageWeight = $totalRecords > 0
            ? $records->avg(fn (Records $record) => (float) ($record->weight ?? 0))
            : 0;

        $monthLabels = ['Gener', 'Febrer', 'Marc', 'Abril', 'Maig', 'Juny', 'Juliol', 'Agost', 'Setembre', 'Octubre', 'Novembre', 'Desembre'];
        $entradaByMonth = array_fill(0, 12, 0);
        $sortidaByMonth = array_fill(0, 12, 0);

        $recordsByMonth = $records->groupBy(function (Records $record) {
            return optional($record->created_at)->format('Y-m');
        });

        foreach ($recordsByMonth as $monthKey => $monthRecords) {
            if (! $monthKey) {
                continue;
            }

            $monthIndex = ((int) substr($monthKey, 5, 2)) - 1;

            if ($monthIndex < 0 || $monthIndex > 11) {
                continue;
            }

            $entradaByMonth[$monthIndex] = $monthRecords
                ->where('movement', 'entrada')
                ->sum(fn (Records $record) => (float) ($record->weight ?? 0));

            $sortidaByMonth[$monthIndex] = $monthRecords
                ->where('movement', 'sortida')
                ->sum(fn (Records $record) => (float) ($record->weight ?? 0));
        }

        $weightByMonth = [
            'labels' => $monthLabels,
            'entrada' => $entradaByMonth,
            'sortida' => $sortidaByMonth,
        ];

        return view('admin.statistics', compact(
            'totalInputWeight',
            'totalOutputWeight',
            'totalRecords',
            'averageWeight',
            'weightByMonth',
            'zones',
            'materials',
            'containers',
        ));
    }
}
