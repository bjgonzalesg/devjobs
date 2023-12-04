<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis vacantes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- CUANDO SE HAYA CREADO UNA VACANTE --}}
                @if (session()->has('mensaje'))
                    <p>{{ session('mensaje') }}</p>
                @endif
                <livewire:mostrar-vacantes />
            </div>
        </div>
    </div>
</x-app-layout>
