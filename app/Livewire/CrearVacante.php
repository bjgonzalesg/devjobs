<?php

namespace App\Livewire;

use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use App\Models\Categoria;
use Livewire\WithFileUploads;

class CrearVacante extends Component
{

    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;

    use WithFileUploads;

    protected $rules = [
        'titulo' => ['required', 'string'],
        'salario' => ['required'],
        'categoria' => ['required'],
        'empresa' => ['required', 'string'],
        'ultimo_dia' => ['required', 'date'],
        'descripcion' => ['required', 'string', 'min:15', 'max:155'],
        'imagen' => ['required', 'image', 'max:1024'],
    ];

    public function crearVacante()
    {
        $datos = $this->validate();

        // ALMACENAR LA IMAGEN
        $imagen = $this->imagen->store('public/vacantes');
        // REEMPLAZA UN STRING POR OTRO ('currentlyString','newString',string)
        $nombre_imagen = str_replace('public/vacantes/', '', $imagen);

        // CREAR LA VACANTE
        Vacante::create([
            'titulo' => $datos['titulo'],
            'salario_id'  => $datos['salario'],
            'categoria_id'  => $datos['categoria'],
            'empresa' => $datos['empresa'],
            'ultimo_dia' => $datos['ultimo_dia'],
            'descripcion' => $datos['descripcion'],
            'imagen' => $nombre_imagen,
            'user_id' => auth()->user()->id,
        ]);

        // CREANDO UN MENSAJE
        session()->flash('mensaje', 'La vacante se publico correctamente');

        

        // REDIRECCIONANDO
        return redirect()->route('vacantes.index');
    }

    public function render()
    {
        // CONSULTAR BASE DE DATOS
        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.crear-vacante', ['salarios' => $salarios, 'categorias' => $categorias]);
    }
}
