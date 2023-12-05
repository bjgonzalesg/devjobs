<?php

namespace App\Livewire;

use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use App\Models\Categoria;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class EditarVacante extends Component
{
    public $vacante_id;
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;
    public $imagen_nueva;

    use WithFileUploads;

    protected $rules = [
        'titulo' => ['required', 'string'],
        'salario' => ['required'],
        'categoria' => ['required'],
        'empresa' => ['required', 'string'],
        'ultimo_dia' => ['required', 'date'],
        'descripcion' => ['required', 'string', 'min:15', 'max:155'],
        'imagen_nueva' => ['nullable', 'image', 'max:1024'],
    ];


    public function mount(Vacante $vacante)
    {
        $this->vacante_id = $vacante->id;
        $this->titulo = $vacante->titulo;
        $this->salario = $vacante->salario_id;
        $this->categoria = $vacante->categoria_id;
        // DE d-m-Y TO Y-m-d
        $this->ultimo_dia = Carbon::parse($vacante->uktimo_dia)->format('Y-m-d');
        $this->empresa = $vacante->empresa;
        $this->descripcion = $vacante->descripcion;
        $this->imagen = $vacante->imagen;
    }

    public function editarVacante()
    {
        // VALIDAR LOS DATOS
        $datos = $this->validate();

        // SI HAY NUEVA IMAGEN
        if ($this->imagen_nueva) {
            $imagen = $this->imagen_nueva->store('public/vacantes');
            $datos['imagen'] = str_replace('public/vacantes/', '', $imagen);
        }

        // ENCONTRAR VACANTE A EDITAR
        $vacante = Vacante::find($this->vacante_id);

        // ASIGNAR LOS VALORES
        $vacante->titulo = $datos['titulo'];
        $vacante->salario_id = $datos['salario'];
        $vacante->categoria_id = $datos['categoria'];
        $vacante->empresa = $datos['empresa'];
        $vacante->descripcion = $datos['descripcion'];
        $vacante->imagen = $datos['imagen'] ?? $vacante->imagen;

        // GUARDAR LA VACANTE
        $vacante->save();

        // REDIRECCIONAR
        session()->flash('mensaje', 'La vacante se actualizo correctamente');
        return redirect()->route('vacantes.index');
    }

    public function render()
    {
        // CONSULTAR BASE DE DATOS
        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.editar-vacante', ['salarios' => $salarios, 'categorias' => $categorias]);
    }
}
