<x-app-layout>
    <x-slot name="header">
        <div class="flex items-start justify-between gap-4">
            <div class="flex flex-col gap-2">
                <p class="text-sm font-semibold uppercase tracking-[0.32em] text-emerald-700">Administració</p>
                <h2 class="text-3xl font-black tracking-tight text-slate-900">Gestió de Zones</h2>
            </div>

            <a
                href="{{ route('zones.create') }}"
                class="inline-flex items-center rounded-2xl bg-emerald-700 px-5 py-3 text-sm font-black uppercase tracking-[0.14em] text-white shadow-lg shadow-emerald-900/20 transition hover:bg-emerald-800"
            >
                Nova Zona
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-5">
                <a
                    href="{{ route('dashboard') }}"
                    class="inline-flex items-center rounded-2xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-bold text-slate-700 shadow-sm transition hover:bg-slate-50"
                >
                    ← Tornar al menú
                </a>
            </div>

            @if (session('success'))
                <div class="mb-5 rounded-[1.4rem] border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-bold text-emerald-800">
                    {{ session('success') }}
                </div>
            @endif

            <section class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-6 py-5">
                    <p class="text-sm font-semibold uppercase tracking-[0.28em] text-slate-500">Llistat</p>
                    <h3 class="mt-2 text-2xl font-black tracking-tight text-slate-900">Zones registrades</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-sm">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-4 text-left font-black uppercase tracking-[0.14em] text-slate-600">ID</th>
                                <th class="px-6 py-4 text-left font-black uppercase tracking-[0.14em] text-slate-600">Nom</th>
                                <th class="px-6 py-4 text-right font-black uppercase tracking-[0.14em] text-slate-600">Accions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse ($zones as $zone)
                                <tr class="hover:bg-slate-50">
                                    <td class="px-6 py-4 font-semibold text-slate-900">{{ $zone->id }}</td>
                                    <td class="px-6 py-4 text-slate-700">{{ $zone->name ?? $zone->nom }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('zones.edit', $zone) }}" class="inline-flex items-center rounded-xl bg-sky-100 px-4 py-2 text-xs font-black uppercase tracking-[0.12em] text-sky-700 transition hover:bg-sky-200">
                                                Editar
                                            </a>

                                            <form method="POST" action="{{ route('zones.destroy', $zone) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center rounded-xl bg-rose-100 px-4 py-2 text-xs font-black uppercase tracking-[0.12em] text-rose-700 transition hover:bg-rose-200">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-10 text-center text-slate-500">Encara no hi ha registres disponibles.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
