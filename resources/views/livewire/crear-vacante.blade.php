<form class="md:w-1/2" action="" wire:submit.prevent='crearVacante'>
    {{-- TITULO DE VACANTE --}}
    <div>
        <x-input-label for="titulo" :value="__('Titulo vacante')" />
        <x-text-input id="titulo" class="block mt-1 w-full" type="text" wire:model="titulo" :value="old('titulo')" />
        @error('titulo')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    {{-- SALARIO DE LA VACANTE --}}
    <div class="mt-4">
        <x-input-label for="salario" :value="__('Salario Mensual')" />
        <select class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
            wire:model="salario" id="salario">
            <option value="0">{{ __('-- Seleccione --') }}</option>
            @foreach ($salarios as $salario)
                <option value="{{ $salario->id }}">{{ $salario->salario }}</option>
            @endforeach
        </select>
        @error('salario')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    {{-- CATEGORIA --}}
    <div class="mt-4">
        <x-input-label for="categoria" :value="__('Categoria')" />
        <select class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
            wire:model="categoria" id="categoria">
            <option value="0">{{ __('-- Seleccione una categoria') }}</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
            @endforeach
        </select>
        @error('categoria')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    {{-- EMPRESA --}}
    <div class="mt-4">
        <x-input-label for="empresa" :value="__('Nombre de la Empresa')" />
        <x-text-input id="empresa" class="block mt-1 w-full" type="text" wire:model="empresa"
            placeholder="Ejm. Uber, Netflix, etc" :value="old('empresa')" />
        @error('empresa')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    {{-- FECHA FINAL --}}
    <div class="mt-4">
        <x-input-label for="ultimo_dia" :value="__('Ultimo dia de postulacion')" />
        <x-text-input id="ultimo_dia" class="block mt-1 w-full" type="date" wire:model="ultimo_dia"
            :value="old('ultimo_dia')" />
        @error('ultimo_dia')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    {{-- DESCRIPCION --}}
    <div class="mt-4">
        <x-input-label for="descripcion" :value="__('Descripcion del puesto')" />
        <textarea wire:model="descripcion" id="descripcion" rows="5"
            class="w-full mt-1 resize-none rounded-md shadow-sm border-gray-300"></textarea>
        @error('descripcion')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    {{-- IMAGEN DE LA VACANTE --}}
    <div class="mt-4">
        <x-input-label for="imagen" :value="__('Foto')" />
        <x-text-input id="imagen" class="block mt-1 w-full p-3" type="file" wire:model="imagen"
            accept="image/*" />
        @if ($imagen)
            <div class="my-5 w-full flex justify-center">
                <img src="{{ $imagen->temporaryUrl() }}" alt="preview_image" class="w-96">
            </div>
        @endif

        @error('imagen')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    {{-- BOTON DE ENVIO --}}
    <div class="mt-4">
        <x-primary-button class="w-full justify-center">
            {{ __('Crear vacante') }}
        </x-primary-button>
    </div>
</form>
