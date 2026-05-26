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

            <!-- Name -->
            <div class="mt-4">
                <x-input-label for="name" :value="__('Nom')" class="text-xl font-bold text-gray-700" />
                <x-text-input
                    id="name"
                    class="block mt-3 w-full text-lg py-4 px-5"
                    type="text"
                    name="name"
                    :value="old('name')"
                    required
                    autofocus
                    autocomplete="username"
                />
                <x-input-error :messages="$errors->get('name')" class="mt-3 text-sm" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Contrasenya')" class="text-xl font-bold text-gray-700" />

                <x-text-input
                    id="password"
                    class="block mt-3 w-full text-lg py-4 px-5"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                />

                <x-input-error :messages="$errors->get('password')" class="mt-3 text-sm" />
            </div>

            <!-- Button -->
            <div class="mt-6">
                <x-primary-button class="w-full justify-center py-5 text-2xl font-bold">
                    {{ __('Iniciar sessió') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
