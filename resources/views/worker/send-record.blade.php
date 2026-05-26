<x-app-layout>
    <div class="min-h-[calc(100vh-3.5rem)] bg-[radial-gradient(circle_at_top_left,_rgba(34,197,94,0.15),_transparent_22%),linear-gradient(180deg,_#f8fafc_0%,_#edf5ef_100%)] px-3 py-3 sm:px-4 lg:px-5">
        <div class="mx-auto flex min-h-[calc(100vh-4.5rem)] max-w-[92rem] items-center justify-center">
            <div class="w-full overflow-hidden rounded-[1.75rem] border border-emerald-100 bg-white shadow-2xl shadow-emerald-950/10">
                <div class="border-b border-emerald-100 bg-emerald-700 px-4 py-3 text-white sm:px-6">
                    <div class="flex flex-col gap-2 lg:flex-row lg:items-end lg:justify-between">
                        <div>
                            <h1 class="text-2xl font-black tracking-tight sm:text-3xl">Enviar registre</h1>
                                <p class="mt-1 text-xs font-medium text-emerald-50 sm:text-sm">
                                Selecciona el material, el contenidor i el pes total del registre.
                            </p>
                        </div>

                        <div class="rounded-2xl border border-white/20 bg-white/15 px-4 py-2 text-center shadow-lg shadow-emerald-950/10">
                            <p class="text-[11px] font-semibold uppercase tracking-[0.3em] text-emerald-100">Zona seleccionada</p>
                            <p class="mt-1 text-lg font-black uppercase tracking-[0.14em] text-white sm:text-xl">
                                {{ $selectedZone->nom ?? $selectedZone->name }}
                            </p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('worker.send-record.store') }}" class="px-4 py-3 sm:px-6 sm:py-4">
                    @csrf
                    <input type="hidden" name="zone_id" value="{{ $selectedZone->id }}">
                    <input type="hidden" id="selected_material_id" name="material_id">
                    <input type="hidden" id="selected_container_id" name="container_id">

                    @if (session('status'))
                        <div class="mb-3 rounded-[1.25rem] border border-emerald-300 bg-emerald-100 px-4 py-3 text-center shadow-sm">
                                <p class="text-base font-black tracking-[0.06em] text-emerald-900 sm:text-lg">
                                {{ session('status') }}
                            </p>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-3 rounded-[1.25rem] border border-rose-300 bg-rose-50 px-5 py-4 text-center shadow-sm">
                            <p class="text-lg font-black uppercase tracking-[0.12em] text-rose-700 sm:text-xl">
                                Faltan dades o pes incorrecte
                            </p>
                        </div>
                    @endif

                    <div class="mb-3 rounded-[1.4rem] border border-emerald-200 bg-gradient-to-r from-emerald-50 via-white to-emerald-50 p-3 shadow-sm">
                        <div class="flex flex-col items-center gap-2.5">
                            <div class="text-center">
                                <p class="text-[11px] font-bold uppercase tracking-[0.3em] text-emerald-800">Tipus de moviment</p>
                            </div>

                            <div class="grid w-full max-w-xl gap-2.5 sm:grid-cols-2">
                                <label class="flex cursor-pointer items-center justify-center gap-3 rounded-[1.2rem] border-2 border-emerald-200 bg-white px-4 py-3 text-sm font-black uppercase tracking-[0.12em] text-emerald-800 shadow-sm transition hover:border-emerald-400 hover:bg-emerald-50 sm:text-base">
                                    <input
                                        type="radio"
                                        name="movement_type"
                                        value="entrada"
                                        class="h-4 w-4 border-slate-300 text-emerald-700 focus:ring-emerald-500 sm:h-5 sm:w-5"
                                        {{ old('movement_type', 'entrada') === 'entrada' ? 'checked' : '' }}
                                    >
                                    <span>Entrada</span>
                                </label>

                                <label class="flex cursor-pointer items-center justify-center gap-3 rounded-[1.2rem] border-2 border-emerald-200 bg-white px-4 py-3 text-sm font-black uppercase tracking-[0.12em] text-emerald-800 shadow-sm transition hover:border-emerald-400 hover:bg-emerald-50 sm:text-base">
                                    <input
                                        type="radio"
                                        name="movement_type"
                                        value="sortida"
                                        class="h-4 w-4 border-slate-300 text-emerald-700 focus:ring-emerald-500 sm:h-5 sm:w-5"
                                        {{ old('movement_type') === 'sortida' ? 'checked' : '' }}
                                    >
                                    <span>Sortida</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="grid gap-3 xl:grid-cols-[minmax(0,1.08fr)_17rem_minmax(0,1.08fr)] xl:items-start">
                        <section class="rounded-[1.4rem] border border-slate-200 bg-slate-50 p-3 shadow-sm">
                            <div class="mb-2">
                                    <h2 class="text-sm font-black uppercase tracking-[0.18em] text-slate-900 sm:text-base">Materials</h2>
                                    <p class="mt-1 text-[11px] font-medium text-slate-600 sm:text-xs">Filtra i selecciona un material de la zona.</p>
                            </div>

                            <div class="mb-2">
                                <input
                                    id="material-filter"
                                    type="text"
                                    placeholder="Filtrar material..."
                                    class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-800 shadow-sm transition focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100"
                                >
                            </div>

                            <div class="h-[15.5rem] overflow-y-auto rounded-2xl border border-slate-200 bg-white p-2">
                                <div id="materials-list" class="space-y-2">
                                    @forelse ($materials as $material)
                                        <button
                                            type="button"
                                            class="selectable-item material-item flex w-full items-center justify-between rounded-2xl border border-slate-200 bg-white px-4 py-3 text-left text-slate-800 transition hover:border-emerald-400 hover:bg-emerald-50 active:bg-emerald-100"
                                            data-id="{{ $material->id }}"
                                            data-name="{{ strtolower($material->name) }}"
                                            data-input="{{ $material->input ? '1' : '0' }}"
                                            data-output="{{ $material->output ? '1' : '0' }}"
                                        >
                                            <span class="item-label text-sm font-black uppercase tracking-[0.04em] text-slate-900 sm:text-base">{{ $material->name }}</span>
                                        </button>
                                    @empty
                                        <p class="px-3 py-4 text-sm text-slate-500">No hi ha materials assignats a aquesta zona.</p>
                                    @endforelse
                                </div>
                            </div>
                        </section>

                        <section class="rounded-[1.4rem] border border-emerald-100 bg-white p-3.5 shadow-lg shadow-emerald-950/5">
                            <div class="flex h-full flex-col justify-center">
                                    <label for="total_weight" class="text-center text-xs font-black uppercase tracking-[0.24em] text-slate-800 sm:text-sm">
                                    PES TOTAL
                                </label>
                                <input
                                    id="total_weight"
                                    name="total_weight"
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    placeholder="0.00"
                                    value="{{ old('total_weight') }}"
                                    class="mt-3 w-full rounded-[1.4rem] border border-slate-300 bg-slate-50 px-4 py-3 text-center text-xl font-black text-slate-800 shadow-inner shadow-slate-200 transition focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100 sm:text-2xl"
                                >

                                <div class="mt-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                                        <p class="text-[11px] font-black uppercase tracking-[0.16em] text-slate-900 sm:text-xs">
                                        Contenidors que s'estan utilitzant
                                    </p>

                                    <div class="mt-2.5 grid grid-cols-2 gap-2">
                                        @foreach ([1, 2, 3, 4] as $option)
                                            <label class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-white px-3 py-2.5 text-sm font-bold text-slate-700 transition hover:border-emerald-300 hover:bg-emerald-50">
                                                <input
                                                    type="radio"
                                                    name="active_containers"
                                                    value="{{ $option }}"
                                                    class="h-4 w-4 border-slate-300 text-emerald-700 focus:ring-emerald-500 sm:h-5 sm:w-5"
                                                    {{ (string) old('active_containers') === (string) $option ? 'checked' : '' }}
                                                >

                                                <span class="text-sm leading-none sm:text-base">{{ $option }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                <button
                                    type="submit"
                                    class="mt-3 inline-flex w-full items-center justify-center rounded-[1.4rem] bg-emerald-700 px-5 py-3 text-sm font-black uppercase tracking-[0.16em] text-white shadow-xl shadow-emerald-900/20 transition hover:-translate-y-0.5 hover:bg-emerald-800 hover:shadow-2xl hover:shadow-emerald-900/30 sm:text-base"
                                >
                                    Enviar registre
                                </button>
                            </div>
                        </section>

                        <section class="rounded-[1.4rem] border border-slate-200 bg-slate-50 p-3 shadow-sm">
                            <div class="mb-2">
                                    <h2 class="text-sm font-black uppercase tracking-[0.18em] text-slate-900 sm:text-base">Contenidors</h2>
                                    <p class="mt-1 text-[11px] font-medium text-slate-600 sm:text-xs">Filtra i selecciona un contenidor de la zona.</p>
                            </div>

                            <div class="mb-2">
                                <input
                                    id="container-filter"
                                    type="text"
                                    placeholder="Filtrar contenidor..."
                                    class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-800 shadow-sm transition focus:border-emerald-600 focus:outline-none focus:ring-4 focus:ring-emerald-100"
                                >
                            </div>

                            <div class="h-[15.5rem] overflow-y-auto rounded-2xl border border-slate-200 bg-white p-2">
                                <div id="containers-list" class="space-y-2">
                                    @forelse ($containers as $container)
                                        <button
                                            type="button"
                                            class="selectable-item container-item flex w-full items-center justify-between rounded-2xl border border-slate-200 bg-white px-4 py-3 text-left text-slate-800 transition hover:border-emerald-400 hover:bg-emerald-50"
                                            data-id="{{ $container->id }}"
                                            data-name="{{ strtolower($container->name) }}"
                                            data-input="{{ $container->input ? '1' : '0' }}"
                                            data-output="{{ $container->output ? '1' : '0' }}"
                                        >
                                            <span class="item-label text-sm font-black uppercase tracking-[0.04em] text-slate-900 sm:text-base">{{ $container->name }}</span>
                                        </button>
                                    @empty
                                        <p class="px-3 py-4 text-sm text-slate-500">No hi ha contenidors assignats a aquesta zona.</p>
                                    @endforelse
                                </div>
                            </div>
                        </section>
                    </div>
                </form>

                <form id="logout-after-success" method="POST" action="{{ route('logout') }}" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
    </div>

    <script>
        const selectedClasses = ['border-emerald-700', 'bg-emerald-200', 'ring-2', 'ring-emerald-300', 'shadow-md'];
        const selectedTextClasses = [];
        const defaultTextClasses = ['text-slate-900'];
        const oldMaterialId = @json(old('material_id'));
        const oldContainerId = @json(old('container_id'));

        function applyCombinedFilter(inputId, itemSelector) {
            const input = document.getElementById(inputId);
            const items = Array.from(document.querySelectorAll(itemSelector));
            const movementInputs = Array.from(document.querySelectorAll('input[name="movement_type"]'));

            if (!input) {
                return;
            }

            const runFilter = () => {
                const query = input.value.trim().toLowerCase();
                const selectedMovement = movementInputs.find((radio) => radio.checked)?.value ?? 'entrada';

                items.forEach((item) => {
                    const name = item.dataset.name || '';
                    const matchesText = name.includes(query);
                    const matchesMovement = selectedMovement === 'entrada'
                        ? item.dataset.input === '1'
                        : item.dataset.output === '1';

                    item.classList.toggle('hidden', !(matchesText && matchesMovement));
                });
            };

            input.addEventListener('input', runFilter);
            movementInputs.forEach((radio) => radio.addEventListener('change', runFilter));
            runFilter();
        }

        function setupSelection(itemSelector, hiddenInputId, initialValue = null) {
            const items = Array.from(document.querySelectorAll(itemSelector));
            const hiddenInput = document.getElementById(hiddenInputId);

            const selectItem = (item) => {
                items.forEach((otherItem) => {
                    otherItem.classList.remove(...selectedClasses);
                    const otherLabel = otherItem.querySelector('.item-label');

                    if (otherLabel) {
                        otherLabel.classList.remove(...selectedTextClasses);
                        otherLabel.classList.add(...defaultTextClasses);
                    }
                });

                item.classList.add(...selectedClasses);

                const itemLabel = item.querySelector('.item-label');

                if (itemLabel) {
                    itemLabel.classList.remove(...defaultTextClasses);
                    itemLabel.classList.add(...selectedTextClasses);
                }

                if (hiddenInput) {
                    hiddenInput.value = item.dataset.id || '';
                }
            };

            items.forEach((item) => {
                item.addEventListener('click', () => {
                    selectItem(item);
                });
            });

            if (initialValue) {
                const initialItem = items.find((item) => item.dataset.id === String(initialValue));

                if (initialItem) {
                    selectItem(initialItem);
                }
            }
        }

        applyCombinedFilter('material-filter', '.material-item');
        applyCombinedFilter('container-filter', '.container-item');
        setupSelection('.material-item', 'selected_material_id', oldMaterialId);
        setupSelection('.container-item', 'selected_container_id', oldContainerId);

        if (@json(session()->has('status'))) {
            window.setTimeout(() => {
                const logoutForm = document.getElementById('logout-after-success');

                if (logoutForm) {
                    logoutForm.submit();
                }
            }, 2000);
        }
    </script>
</x-app-layout>
