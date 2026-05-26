<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2">
            <p class="text-sm font-semibold uppercase tracking-[0.32em] text-emerald-700">Administració</p>
            <h2 class="text-3xl font-black tracking-tight text-slate-900">Estadístiques generals</h2>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto flex max-w-7xl flex-col gap-8 px-4 sm:px-6 lg:px-8">
            <div>
                <a
                    href="{{ route('dashboard') }}"
                    class="inline-flex items-center rounded-2xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-bold text-slate-700 shadow-sm transition hover:bg-slate-50"
                >
                    ← Tornar al menú
                </a>
            </div>

            <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm sm:p-7">
                <div class="mb-6">
                    <p class="text-sm font-semibold uppercase tracking-[0.28em] text-slate-500">Filtres</p>
                    <h3 class="mt-2 text-2xl font-black tracking-tight text-slate-900">Refina les dades</h3>
                    <p class="mt-2 text-sm text-slate-500">Aplica filtres per veure només els registres que t'interessen.</p>
                </div>

                <form method="GET" action="{{ route('statistics.index') }}" class="space-y-6">
                    <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                        <div>
                            <label for="date_from" class="text-sm font-black uppercase tracking-[0.18em] text-slate-800">Data inici</label>
                            <input id="date_from" name="date_from" type="date" value="{{ request('date_from') }}" class="mt-3 w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100">
                            <p class="mt-2 text-sm text-slate-500">Filtra registres a partir d'aquesta data.</p>
                        </div>

                        <div>
                            <label for="date_to" class="text-sm font-black uppercase tracking-[0.18em] text-slate-800">Data fi</label>
                            <input id="date_to" name="date_to" type="date" value="{{ request('date_to') }}" class="mt-3 w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100">
                            <p class="mt-2 text-sm text-slate-500">Filtra registres fins a final d'aquest dia.</p>
                        </div>

                        <div>
                            <label for="zone_id" class="text-sm font-black uppercase tracking-[0.18em] text-slate-800">Zona</label>
                            <select id="zone_id" name="zone_id" class="mt-3 w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100">
                                <option value="">Totes les zones</option>
                                @foreach ($zones as $zone)
                                    <option value="{{ $zone->id }}" @selected((string) request('zone_id') === (string) $zone->id)>
                                        {{ $zone->name ?? $zone->nom }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-2 text-sm text-slate-500">Filtra per una zona concreta.</p>
                        </div>

                        <div>
                            <label for="material_id" class="text-sm font-black uppercase tracking-[0.18em] text-slate-800">Material</label>
                            <select id="material_id" name="material_id" class="mt-3 w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100">
                                <option value="">Tots els materials</option>
                                @foreach ($materials as $material)
                                    <option value="{{ $material->id }}" @selected((string) request('material_id') === (string) $material->id)>
                                        {{ $material->name }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-2 text-sm text-slate-500">Filtra per un material concret.</p>
                        </div>

                        <div>
                            <label for="container_id" class="text-sm font-black uppercase tracking-[0.18em] text-slate-800">Contenidor</label>
                            <select id="container_id" name="container_id" class="mt-3 w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100">
                                <option value="">Tots els contenidors</option>
                                @foreach ($containers as $container)
                                    <option value="{{ $container->id }}" @selected((string) request('container_id') === (string) $container->id)>
                                        {{ $container->name }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-2 text-sm text-slate-500">Filtra per un contenidor concret.</p>
                        </div>

                        <div>
                            <label for="movement_type" class="text-sm font-black uppercase tracking-[0.18em] text-slate-800">Tipus de moviment</label>
                            <select id="movement_type" name="movement_type" class="mt-3 w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100">
                                <option value="">Tots els moviments</option>
                                <option value="entrada" @selected(request('movement_type') === 'entrada')>Entrada</option>
                                <option value="sortida" @selected(request('movement_type') === 'sortida')>Sortida</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <button type="submit" class="inline-flex items-center rounded-2xl bg-emerald-700 px-5 py-3 text-sm font-black uppercase tracking-[0.14em] text-white transition hover:bg-emerald-800">
                            Aplicar filtres
                        </button>

                        <a href="{{ route('statistics.index') }}" class="inline-flex items-center rounded-2xl border border-slate-300 px-5 py-3 text-sm font-black uppercase tracking-[0.14em] text-slate-700 transition hover:bg-slate-50">
                            Netejar filtres
                        </a>
                    </div>
                </form>
            </section>

            <section class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">
                <article class="overflow-hidden rounded-[1.75rem] border border-emerald-100 bg-gradient-to-br from-emerald-500 via-emerald-600 to-teal-700 p-6 text-white shadow-xl shadow-emerald-900/20">
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-emerald-100">Total kilos entrada</p>
                    <p class="mt-4 text-4xl font-black tracking-tight">{{ number_format($totalInputWeight, 0, ',', '.') }}</p>
                </article>

                <article class="overflow-hidden rounded-[1.75rem] border border-cyan-100 bg-gradient-to-br from-cyan-500 via-sky-600 to-blue-700 p-6 text-white shadow-xl shadow-sky-900/20">
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-cyan-100">Total kilos sortida</p>
                    <p class="mt-4 text-4xl font-black tracking-tight">{{ number_format($totalOutputWeight, 0, ',', '.') }}</p>
                </article>

                <article class="overflow-hidden rounded-[1.75rem] border border-violet-100 bg-gradient-to-br from-violet-500 via-fuchsia-600 to-purple-700 p-6 text-white shadow-xl shadow-fuchsia-900/20">
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-violet-100">Total registres</p>
                    <p class="mt-4 text-4xl font-black tracking-tight">{{ number_format($totalRecords, 0, ',', '.') }}</p>
                </article>

                <article class="overflow-hidden rounded-[1.75rem] border border-amber-100 bg-gradient-to-br from-amber-500 via-orange-500 to-amber-700 p-6 text-white shadow-xl shadow-amber-900/20">
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-amber-100">Mitjana de pes per registre</p>
                    <p class="mt-4 text-4xl font-black tracking-tight">{{ number_format($averageWeight, 2, ',', '.') }}</p>
                </article>
            </section>

            <section>
                <article class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm sm:p-7">
                    <div class="mb-5">
                        <p class="text-sm font-semibold uppercase tracking-[0.28em] text-slate-500">Gràfic principal</p>
                        <h3 class="mt-2 text-2xl font-black tracking-tight text-slate-900">Pes per mes</h3>
                        <p class="mt-2 text-sm text-slate-500">Evolució del pes total per mes, diferenciant entrades i sortides.</p>
                    </div>
                    <div class="h-[280px] sm:h-[340px] lg:h-[420px]">
                        <canvas id="chart_weight_by_day"></canvas>
                    </div>
                </article>
            </section>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
    <script>
        const weightByMonth = @json($weightByMonth);

        Chart.defaults.font.family = 'Figtree, sans-serif';
        Chart.defaults.color = '#334155';

        const commonOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        usePointStyle: true,
                        boxWidth: 10,
                    },
                },
            },
            scales: {
                x: {
                    grid: {
                        display: false,
                    },
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(148, 163, 184, 0.15)',
                    },
                },
            },
        };

        new Chart(document.getElementById('chart_weight_by_day'), {
            type: 'line',
            data: {
                labels: weightByMonth.labels,
                datasets: [
                    {
                        label: 'Entrada',
                        data: weightByMonth.entrada,
                        borderColor: '#059669',
                        backgroundColor: 'rgba(5, 150, 105, 0.15)',
                        tension: 0.35,
                        fill: false,
                    },
                    {
                        label: 'Sortida',
                        data: weightByMonth.sortida,
                        borderColor: '#0284c7',
                        backgroundColor: 'rgba(2, 132, 199, 0.15)',
                        tension: 0.35,
                        fill: false,
                    },
                ],
            },
            options: commonOptions,
        });
    </script>
</x-app-layout>
