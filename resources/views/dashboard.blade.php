<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2">
            <p class="text-sm font-semibold uppercase tracking-[0.32em] text-emerald-700">Administració</p>
            <h2 class="text-3xl font-black tracking-tight text-slate-900">
                Dashboard general
            </h2>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto flex max-w-7xl flex-col gap-8 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-end">
                <a
                    href="{{ route('export.csv') }}"
                    class="inline-flex items-center rounded-2xl bg-emerald-700 px-5 py-3 text-sm font-black uppercase tracking-[0.14em] text-white shadow-lg shadow-emerald-900/20 transition hover:bg-emerald-800"
                >
                    Exportar CSV
                </a>
            </div>

            <section class="grid gap-5 lg:grid-cols-2">
                <a
                    href="{{ route('users.index') }}"
                    class="group overflow-hidden rounded-[2rem] border border-emerald-200 bg-gradient-to-br from-emerald-500 via-emerald-600 to-teal-700 p-7 text-white shadow-xl shadow-emerald-900/20 transition hover:-translate-y-1 hover:shadow-2xl hover:shadow-emerald-900/25"
                >
                    <div class="flex h-full items-start justify-between gap-6">
                        <div class="flex-1">
                            <p class="text-sm font-semibold uppercase tracking-[0.28em] text-emerald-100">Acció principal</p>
                            <h3 class="mt-4 text-3xl font-black tracking-tight">Gestionar Usuaris</h3>
                            <p class="mt-3 max-w-md text-sm text-emerald-50/90 sm:text-base">Dona d'alta nous usuaris i administra accessos de la plataforma.</p>
                        </div>

                        <div class="flex flex-col items-end justify-between gap-8">
                            <div class="flex h-16 w-16 items-center justify-center rounded-[1.4rem] bg-white/15 text-3xl font-black shadow-lg shadow-emerald-950/10">
                                U
                            </div>
                            <span class="text-3xl transition group-hover:translate-x-1">→</span>
                        </div>
                    </div>
                </a>

                <a
                    href="{{ route('statistics.index') }}"
                    class="group overflow-hidden rounded-[2rem] border border-sky-200 bg-gradient-to-br from-sky-500 via-sky-600 to-blue-700 p-7 text-white shadow-xl shadow-sky-900/20 transition hover:-translate-y-1 hover:shadow-2xl hover:shadow-sky-900/25"
                >
                    <div class="flex h-full items-start justify-between gap-6">
                        <div class="flex-1">
                            <p class="text-sm font-semibold uppercase tracking-[0.28em] text-sky-100">Vista global</p>
                            <h3 class="mt-4 text-3xl font-black tracking-tight">Veure Estadístiques</h3>
                            <p class="mt-3 max-w-md text-sm text-sky-50/90 sm:text-base">Consulta l'activitat, els volums registrats i l'estat general del sistema.</p>
                        </div>

                        <div class="flex flex-col items-end justify-between gap-8">
                            <div class="flex h-16 w-16 items-center justify-center rounded-[1.4rem] bg-white/15 text-3xl font-black shadow-lg shadow-sky-950/10">
                                E
                            </div>
                            <span class="text-3xl transition group-hover:translate-x-1">→</span>
                        </div>
                    </div>
                </a>
            </section>

            <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm sm:p-7">
                <div class="mb-6">
                    <p class="text-sm font-semibold uppercase tracking-[0.28em] text-emerald-700">Mòduls principals</p>
                    <h3 class="mt-2 text-2xl font-black tracking-tight text-slate-900">Gestió centralitzada</h3>
                    <p class="mt-2 text-sm text-slate-500">Accedeix ràpidament als mòduls clau de configuració interna.</p>
                </div>

                <div class="grid gap-4 lg:grid-cols-3">
                    <a
                        href="{{ route('zones.index') }}"
                        class="group rounded-[1.6rem] border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-emerald-300 hover:shadow-lg hover:shadow-emerald-100"
                    >
                        <p class="text-xl font-black text-slate-900">Gestionar Zones</p>
                        <p class="mt-5 text-4xl font-black tracking-tight text-slate-900">{{ number_format($zoneCount, 0, ',', '.') }}</p>
                        <p class="mt-2 text-sm font-medium text-slate-500">zones configurades</p>
                        <span class="mt-5 inline-flex text-sm font-bold uppercase tracking-[0.18em] text-emerald-700 transition group-hover:translate-x-1">Obrir →</span>
                    </a>

                    <a
                        href="{{ route('materials.index') }}"
                        class="group rounded-[1.6rem] border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-emerald-300 hover:shadow-lg hover:shadow-emerald-100"
                    >
                        <p class="text-xl font-black text-slate-900">Gestionar Materials</p>
                        <p class="mt-5 text-4xl font-black tracking-tight text-slate-900">{{ number_format($materialCount, 0, ',', '.') }}</p>
                        <p class="mt-2 text-sm font-medium text-slate-500">materials disponibles</p>
                        <span class="mt-5 inline-flex text-sm font-bold uppercase tracking-[0.18em] text-emerald-700 transition group-hover:translate-x-1">Obrir →</span>
                    </a>

                    <a
                        href="{{ route('containers.index') }}"
                        class="group rounded-[1.6rem] border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-emerald-300 hover:shadow-lg hover:shadow-emerald-100"
                    >
                        <p class="text-xl font-black text-slate-900">Gestionar Contenidors</p>
                        <p class="mt-5 text-4xl font-black tracking-tight text-slate-900">{{ number_format($containerCount, 0, ',', '.') }}</p>
                        <p class="mt-2 text-sm font-medium text-slate-500">contenidors actius</p>
                        <span class="mt-5 inline-flex text-sm font-bold uppercase tracking-[0.18em] text-emerald-700 transition group-hover:translate-x-1">Obrir →</span>
                    </a>
                </div>
            </section>

            <section class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-6 py-5 sm:px-7">
                    <div class="flex flex-col gap-5">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.28em] text-slate-500">Registres</p>
                            <h3 class="mt-2 text-2xl font-black tracking-tight text-slate-900">Llistat complet de registres</h3>
                        </div>

                        <div class="grid gap-4 lg:grid-cols-3">
                            <article class="rounded-[1.4rem] border border-emerald-100 bg-emerald-50/80 p-4">
                                <p class="text-xs font-bold uppercase tracking-[0.18em] text-emerald-700">Kilos entrada</p>
                                <p class="mt-3 text-3xl font-black tracking-tight text-slate-900">{{ number_format($totalInputWeight, 0, ',', '.') }}</p>
                            </article>

                            <article class="rounded-[1.4rem] border border-sky-100 bg-sky-50/80 p-4">
                                <p class="text-xs font-bold uppercase tracking-[0.18em] text-sky-700">Kilos sortida</p>
                                <p class="mt-3 text-3xl font-black tracking-tight text-slate-900">{{ number_format($totalOutputWeight, 0, ',', '.') }}</p>
                            </article>

                            <article class="rounded-[1.4rem] border border-violet-100 bg-violet-50/80 p-4">
                                <p class="text-xs font-bold uppercase tracking-[0.18em] text-violet-700">Total registres</p>
                                <p class="mt-3 text-3xl font-black tracking-tight text-slate-900">{{ number_format($totalRecords, 0, ',', '.') }}</p>
                            </article>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-sm">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-4 text-left font-black uppercase tracking-[0.14em] text-slate-600">Usuari</th>
                                <th class="px-6 py-4 text-left font-black uppercase tracking-[0.14em] text-slate-600">Pes</th>
                                <th class="px-6 py-4 text-left font-black uppercase tracking-[0.14em] text-slate-600">Moviment</th>
                                <th class="px-6 py-4 text-left font-black uppercase tracking-[0.14em] text-slate-600">Material</th>
                                <th class="px-6 py-4 text-left font-black uppercase tracking-[0.14em] text-slate-600">Contenidor</th>
                                <th class="px-6 py-4 text-left font-black uppercase tracking-[0.14em] text-slate-600">Zona</th>
                                <th class="px-6 py-4 text-left font-black uppercase tracking-[0.14em] text-slate-600">Data</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse ($records as $record)
                                <tr class="hover:bg-slate-50">
                                    <td class="px-6 py-4 font-semibold text-slate-900">{{ $record->user?->name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-slate-700">{{ number_format($record->weight ?? 0, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold uppercase tracking-[0.14em] {{ $record->movement === 'entrada' ? 'bg-emerald-100 text-emerald-700' : 'bg-sky-100 text-sky-700' }}">
                                            {{ $record->movement }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-slate-700">{{ $record->material?->name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-slate-700">{{ $record->container?->name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-slate-700">{{ $record->zone?->name ?? $record->zone?->nom ?? '-' }}</td>
                                    <td class="px-6 py-4 text-slate-700">{{ $record->created_at?->format('d/m/Y H:i') ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-8 text-center text-slate-500">Encara no hi ha registres disponibles.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
