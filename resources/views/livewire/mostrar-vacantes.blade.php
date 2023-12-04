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
                </div>
                <div class="flex flex-col items-stretch gap-3 md:flex-row text-center md:items-center mt-5 md:mt-0">
                    <a href=""
                        class="bg-slate-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase">Candidatos</a>
                    <a href=""
                        class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase">Editar</a>
                    <a href=""
                        class="bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase">Eliminar</a>
                </div>

            </div>
        @empty
            <p class="p-3 text-center text-sm text-gray-600">No hay vacantes</p>
        @endforelse
    </div>
    {{-- PAGINACION --}}
    <div class="flex justify-center mt-10">
        {{ $vacantes->links() }}
    </div>
</div>
