<?php

namespace App\Livewire;

use App\Models\Vacante;
use Livewire\Component;
use Livewire\Attributes\On;

class MostrarVacantes extends Component
{
    // protected $listeners = ['eliminarVacante'];

    #[On('eliminarVacante')]
    public function eliminarVacante(Vacante $vacante)
    {
       $vacante->delete();
    }

    public function render()
    {
        $vacantes = Vacante::where('user_id', auth()->user()->id)->latest()->paginate($_ENV['PAGINATION_DEFAULT']);
        return view('livewire.mostrar-vacantes', ['vacantes' => $vacantes]);
    }
}
