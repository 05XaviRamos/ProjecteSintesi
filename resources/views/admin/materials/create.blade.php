<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2">
            <p class="text-sm font-semibold uppercase tracking-[0.32em] text-emerald-700">Administració</p>
            <h2 class="text-3xl font-black tracking-tight text-slate-900">Nou Material</h2>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm sm:p-7">
                <form method="POST" action="{{ route('materials.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="text-sm font-black uppercase tracking-[0.18em] text-slate-800">Nom del material</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" class="mt-3 w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100">
                        @error('name')
                            <p class="mt-2 text-sm font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <label class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-4 font-semibold text-slate-700">
                            <input type="checkbox" name="input" value="1" {{ old('input') ? 'checked' : '' }} class="h-5 w-5 rounded border-slate-300 text-emerald-700 focus:ring-emerald-500">
                            Entrada
                        </label>

                        <label class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-4 font-semibold text-slate-700">
                            <input type="checkbox" name="output" value="1" {{ old('output') ? 'checked' : '' }} class="h-5 w-5 rounded border-slate-300 text-emerald-700 focus:ring-emerald-500">
                            Sortida
                        </label>
                    </div>

                    <div class="rounded-[1.6rem] border border-slate-200 bg-white p-5 shadow-sm">
                        <div class="mb-4">
                            <h3 class="text-sm font-black uppercase tracking-[0.18em] text-slate-800">Zones assignades</h3>
                            <p class="mt-1 text-sm text-slate-500">Selecciona una o més zones on aquest material estarà disponible.</p>
                        </div>

                        <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-4">
                            @foreach ($zones as $zone)
                                <label class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 font-semibold text-slate-700 transition hover:border-emerald-300 hover:bg-emerald-50">
                                    <input
                                        type="checkbox"
                                        name="zones[]"
                                        value="{{ $zone->id }}"
                                        {{ in_array($zone->id, old('zones', []), true) ? 'checked' : '' }}
                                        class="h-5 w-5 rounded border-slate-300 text-emerald-700 focus:ring-emerald-500"
                                    >
                                    <span>{{ $zone->name ?? $zone->nom }}</span>
                                </label>
                            @endforeach
                        </div>

                        @error('zones')
                            <p class="mt-3 text-sm font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                        @error('zones.*')
                            <p class="mt-3 text-sm font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('materials.index') }}" class="inline-flex items-center rounded-2xl border border-slate-300 px-5 py-3 text-sm font-black uppercase tracking-[0.14em] text-slate-700 transition hover:bg-slate-50">
                            Cancel·lar
                        </a>
                        <button type="submit" class="inline-flex items-center rounded-2xl bg-emerald-700 px-5 py-3 text-sm font-black uppercase tracking-[0.14em] text-white transition hover:bg-emerald-800">
                            Guardar material
                        </button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-app-layout>
