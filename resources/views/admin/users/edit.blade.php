<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2">
            <p class="text-sm font-semibold uppercase tracking-[0.32em] text-emerald-700">Administració</p>
            <h2 class="text-3xl font-black tracking-tight text-slate-900">Editar Usuari</h2>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm sm:p-7">
                <form method="POST" action="{{ route('users.update', $user) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name" class="text-sm font-black uppercase tracking-[0.18em] text-slate-800">Nom</label>
                        <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" class="mt-3 w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100">
                        @error('name')
                            <p class="mt-2 text-sm font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="text-sm font-black uppercase tracking-[0.18em] text-slate-800">Correu electrònic</label>
                        <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" class="mt-3 w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100">
                        @error('email')
                            <p class="mt-2 text-sm font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-6 sm:grid-cols-2">
                        <div>
                            <label for="password" class="text-sm font-black uppercase tracking-[0.18em] text-slate-800">Nova contrasenya (opcional)</label>
                            <input id="password" name="password" type="password" class="mt-3 w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100">
                            <p class="mt-2 text-sm text-slate-500">Deixa aquest camp buit per mantenir la contrasenya actual.</p>
                            @error('password')
                                <p class="mt-2 text-sm font-semibold text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="text-sm font-black uppercase tracking-[0.18em] text-slate-800">Confirmar nova contrasenya</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" class="mt-3 w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900 focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100">
                        </div>
                    </div>

                    <div>
                        <p class="text-sm font-black uppercase tracking-[0.18em] text-slate-800">Rol</p>
                        <div class="mt-3 grid gap-3 sm:grid-cols-2">
                            <label class="flex cursor-pointer items-center justify-center gap-3 rounded-[1.2rem] border-2 border-emerald-200 bg-white px-4 py-3 text-sm font-black uppercase tracking-[0.12em] text-emerald-800 shadow-sm transition hover:border-emerald-400 hover:bg-emerald-50 sm:text-base">
                                <input
                                    type="radio"
                                    name="is_admin"
                                    value="0"
                                    class="h-4 w-4 border-slate-300 text-emerald-700 focus:ring-emerald-500 sm:h-5 sm:w-5"
                                    {{ (string) old('is_admin', $user->is_admin ? '1' : '0') === '0' ? 'checked' : '' }}
                                >
                                <span>Treballador</span>
                            </label>

                            <label class="flex cursor-pointer items-center justify-center gap-3 rounded-[1.2rem] border-2 border-emerald-200 bg-white px-4 py-3 text-sm font-black uppercase tracking-[0.12em] text-emerald-800 shadow-sm transition hover:border-emerald-400 hover:bg-emerald-50 sm:text-base">
                                <input
                                    type="radio"
                                    name="is_admin"
                                    value="1"
                                    class="h-4 w-4 border-slate-300 text-emerald-700 focus:ring-emerald-500 sm:h-5 sm:w-5"
                                    {{ (string) old('is_admin', $user->is_admin ? '1' : '0') === '1' ? 'checked' : '' }}
                                >
                                <span>Administrador</span>
                            </label>
                        </div>
                        @error('is_admin')
                            <p class="mt-2 text-sm font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('users.index') }}" class="inline-flex items-center rounded-2xl border border-slate-300 px-5 py-3 text-sm font-black uppercase tracking-[0.14em] text-slate-700 transition hover:bg-slate-50">
                            Cancel·lar
                        </a>
                        <button type="submit" class="inline-flex items-center rounded-2xl bg-emerald-700 px-5 py-3 text-sm font-black uppercase tracking-[0.14em] text-white transition hover:bg-emerald-800">
                            Guardar canvis
                        </button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-app-layout>
