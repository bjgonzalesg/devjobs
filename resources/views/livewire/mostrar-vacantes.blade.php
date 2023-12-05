<div>
    <div>
        {{-- LISTAR VACANTES --}}
        @forelse ($vacantes as $vacante)
            <div class="p-6 md:flex md:justify-between items-center border-b-2">
                <div class="space-y-2">
                    <a href="" class="font-bold text-xl">
                        {{ $vacante->titulo }}
                    </a>
                    <p class="text-sm text-gray-600 font-bold">{{ $vacante->empresa }}</p>
                    <p class="text-sm text-gray-500">Ultimo dia: {{ $vacante->ultimo_dia->format('d/m/Y') }}</p>
                    <p class="text-xs text-gray-600">Agregado {{ $vacante->created_at->diffForHumans() }}</p>
                </div>
                <div class="flex flex-col items-stretch gap-3 md:flex-row text-center md:items-center mt-5 md:mt-0">
                    <a href="{{ route('vacantes.show', ['vacante' => $vacante]) }}"
                        class="bg-slate-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase">Candidatos</a>
                    <a href="{{ route('vacantes.edit', ['vacante' => $vacante]) }}"
                        class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase">Editar</a>
                    <button wire:click="$dispatch('delete', {{ $vacante }})"
                        class="bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase">Eliminar</button>
                </div>
            </div>
        @empty
            <p class="p-3 text-center text-sm text-gray-600">No hay vacantes</p>
        @endforelse
    </div>
    {{-- PAGINACION --}}
    @if ($vacantes->count() >= $_ENV['PAGINATION_DEFAULT'])
        <div class="mt-5">
            {{ $vacantes->links() }}
        </div>
    @endif
</div>
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Livewire.on('delete', (vacante) => {
            Swal.fire({
                title: "¿Eliminar vacante?",
                text: "Una vacante eliminada no se puede recuperar",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, ¡Eliminar!",
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('eliminarVacante', {
                        vacante
                    });
                    Swal.fire({
                        title: "¡Eliminado!",
                        text: "La vacante ha sido eliminada.",
                        icon: "success"
                    });
                }
            });
        })
    </script>
@endpush
