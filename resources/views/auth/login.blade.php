<x-guest-layout>
    <div class="w-full">

        <!-- Title -->
         <div class="flex justify-center mb-4">
            <img
                src="{{ asset('logo_electroreciclying.png') }}"
                alt="ElectroReciclying Logo"
                class="w-35 h-35 object-contain"
            >
        </div>
        <div class="text-center mb-4">
            <p class="mt-3 text-lg text-slate-500">
                Inicia sessió per continuar
            </p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-6 text-base" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Correu electrònic')" class="text-lg font-semibold text-gray-700" />
                <x-text-input
                    id="email"
                    class="block mt-3 w-full text-base py-3 px-4"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="username"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-3 text-sm" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Contrasenya')" class="text-lg font-semibold text-gray-700" />

                <x-text-input
                    id="password"
                    class="block mt-3 w-full text-base py-3 px-4"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                />

                <x-input-error :messages="$errors->get('password')" class="mt-3 text-sm" />
            </div>

            <!-- Remember + Forgot -->
            <div class="mt-4 flex items-center justify-between gap-4">
                <label for="remember_me" class="inline-flex items-center gap-3 text-base text-gray-600 cursor-pointer">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span>Recorda'm</span>
                </label>

                @if (Route::has('password.request'))
                    <a
                        class="rounded-md text-base text-indigo-600 underline hover:text-indigo-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}"
                    >
                        Has oblidat la contrasenya?
                    </a>
                @endif
            </div>

            <!-- Button -->
            <div class="mt-6">
                <x-primary-button class="w-full justify-center py-4 text-xl font-bold">
                    {{ __('Iniciar sessió') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
