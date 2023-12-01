<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Ingresa tu email y te enviaremos un correo de recuperacion') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex justify-between my-4">
            <x-link :href="route('login')">
                {{ __('Iniciar sesion') }}
            </x-link>
            <x-link :href="route('register')">
                {{ __('Crear cuenta') }}
            </x-link>
        </div>

        <x-primary-button class="w-full justify-center">
            {{ __('Enviar correo de recuperacion') }}
        </x-primary-button>

    </form>
</x-guest-layout>
