<x-app-layout>
    <div class="min-h-[calc(100vh-3.5rem)] bg-[radial-gradient(circle_at_top_left,_rgba(74,222,128,0.12),_transparent_22%),linear-gradient(180deg,_#f5f7f1_0%,_#f0f2ec_100%)] px-3 py-3 sm:px-5">
        <div class="mx-auto flex min-h-[calc(100vh-4.5rem)] max-w-7xl flex-col">
            <header class="flex min-h-[3rem] items-center justify-between gap-3">
                <div class="inline-flex items-center gap-2 text-sm font-black uppercase tracking-[0.08em] text-[#234c36]">
                    <i class="ti ti-recycle text-base" aria-hidden="true"></i>
                    <span>ELECTRO RECYCLING</span>
                </div>

                <div class="rounded-full border border-[#bdd2c0] bg-white/85 px-4 py-2 text-xs font-black uppercase tracking-[0.08em] text-[#234c36]">
                    EcoMetal
                </div>
            </header>

            <section class="mb-3 mt-3 text-center">
                <h1 class="text-2xl font-black tracking-[0.22em] text-[#234c36] sm:text-[1.8rem]">ZONA</h1>
                <div class="mx-auto mt-2 h-[3px] w-10 rounded-full bg-[#2a5c3f]"></div>
            </section>

            <section class="grid flex-1 grid-cols-2 gap-3 md:grid-cols-4 md:grid-rows-2">
                @foreach ($zones as $zone)
                    @php
                        $zoneName = $zone->nom ?? $zone->name ?? '';
                        $length = strlen($zoneName);
                        $fontSize = $length > 12 ? '1.3rem' : '1.9rem';
                        $zoneHref = auth()->user()->is_admin ? '#' : route('worker.send-record', ['zone' => $zone->id]);
                    @endphp
                    <a
                        href="{{ $zoneHref }}"
                        class="flex min-h-[120px] items-center justify-center rounded-[1.1rem] border-2 border-[#1a1a1a] bg-white px-4 py-4 text-center text-[#2a5c3f] shadow-sm transition duration-200 ease-out hover:-translate-y-0.5 hover:border-[#2a5c3f] hover:bg-[#2a5c3f] hover:text-white hover:shadow-lg hover:shadow-emerald-900/15 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-300 md:min-h-[155px]"
                    >
                        <span class="block break-words px-2 font-extrabold uppercase leading-[1.22] tracking-[0.08em]" style="font-size: {{ $fontSize }}">
                            {{ $zoneName }}
                        </span>
                    </a>
                @endforeach
            </section>
        </div>
    </div>
</x-app-layout>
