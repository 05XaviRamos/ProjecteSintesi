<x-app-layout>
    <x-slot name="header">
        <div class="flex items-start justify-between gap-4">
            <div class="flex flex-col gap-2">
                <p class="text-sm font-semibold uppercase tracking-[0.32em] text-emerald-700">Administració</p>
                <h2 class="text-3xl font-black tracking-tight text-slate-900">Gestió d'Usuaris</h2>
            </div>

            <a
                href="{{ route('users.create') }}"
                class="inline-flex items-center rounded-2xl bg-emerald-700 px-5 py-3 text-sm font-black uppercase tracking-[0.14em] text-white shadow-lg shadow-emerald-900/20 transition hover:bg-emerald-800"
            >
                Nou Usuari
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

            @if (session('error'))
                <div class="mb-5 rounded-[1.4rem] border border-rose-200 bg-rose-50 px-5 py-4 text-sm font-bold text-rose-700">
                    {{ session('error') }}
                </div>
            @endif

            <section class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-6 py-5">
                    <p class="text-sm font-semibold uppercase tracking-[0.28em] text-slate-500">Llistat</p>
                    <h3 class="mt-2 text-2xl font-black tracking-tight text-slate-900">Usuaris registrats</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-sm">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-4 text-left font-black uppercase tracking-[0.14em] text-slate-600">ID</th>
                                <th class="px-6 py-4 text-left font-black uppercase tracking-[0.14em] text-slate-600">Nom</th>
                                <th class="px-6 py-4 text-left font-black uppercase tracking-[0.14em] text-slate-600">Correu</th>
                                <th class="px-6 py-4 text-left font-black uppercase tracking-[0.14em] text-slate-600">Rol</th>
                                <th class="px-6 py-4 text-left font-black uppercase tracking-[0.14em] text-slate-600">Creat el</th>
                                <th class="px-6 py-4 text-right font-black uppercase tracking-[0.14em] text-slate-600">Accions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse ($users as $user)
                                <tr class="hover:bg-slate-50">
                                    <td class="px-6 py-4 font-semibold text-slate-900">{{ $user->id }}</td>
                                    <td class="px-6 py-4 text-slate-700">{{ $user->name }}</td>
                                    <td class="px-6 py-4 text-slate-700">{{ $user->email }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold uppercase tracking-[0.14em] {{ $user->is_admin ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-700' }}">
                                            {{ $user->is_admin ? 'Administrador' : 'Treballador' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-slate-700">{{ $user->created_at?->format('d/m/Y H:i') ?? '-' }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('users.edit', $user) }}" class="inline-flex items-center rounded-xl bg-sky-100 px-4 py-2 text-xs font-black uppercase tracking-[0.12em] text-sky-700 transition hover:bg-sky-200">
                                                Editar
                                            </a>

                                            @if ($user->id !== auth()->id())
                                                <form method="POST" action="{{ route('users.destroy', $user) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center rounded-xl bg-rose-100 px-4 py-2 text-xs font-black uppercase tracking-[0.12em] text-rose-700 transition hover:bg-rose-200">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            @else
                                                <span class="inline-flex items-center rounded-xl bg-slate-100 px-4 py-2 text-xs font-black uppercase tracking-[0.12em] text-slate-400">
                                                    Protegit
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-slate-500">Encara no hi ha registres disponibles.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
