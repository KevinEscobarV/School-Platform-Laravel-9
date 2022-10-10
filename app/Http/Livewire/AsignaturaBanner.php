<?php

namespace App\Http\Livewire;

use App\Models\Asignatura;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use WireUi\Traits\Actions;

class AsignaturaBanner extends Component
{
    use WithFileUploads;
    use Actions;

    public Asignatura $asignatura;
    public $input = [];
    public $photo;

    protected function rules()
    {
        return [
            'input.nombre' => 'required|string|max:255',
            // 'input.codigo' => 'required|string|max:255|unique:asignaturas,codigo,' . $this->asignatura->id,
            'input.descripcion' => 'required|string|max:600',
            'photo' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    protected $validationAttributes = [
        'input.nombre' => 'Nombre',
        // 'input.codigo' => 'Código',
        'input.descripcion' => 'Descripción',
        'photo' => 'Banner',
    ];

    // protected $messages = [
    //     'input.codigo.unique' => 'Este código le pertenece a otra asignatura, por favor ingrese un nombre diferente.',
    // ];

    // public function updatingInputNombre($value)
    // {
    //     $this->input['codigo'] = Str::slug($value . $this->asignatura->curso->id . $this->asignatura->curso->seccion);
    //     $this->validateOnly('input.codigo');
    // }

    public function updatedPhoto()
    {
        $this->validateOnly('photo');
    }

    public function mount()
    {
        $this->input = $this->asignatura->withoutRelations()->toArray();
    }

    public function save()
    {
        if ($this->asignatura->codigo != $this->input['codigo']) {
            $this->notification()->error(
                $title = 'Error',
                $description = 'No se puede cambiar el código de la asignatura.'
            );
            return;
        }

        $this->validate();

        if ($this->photo) {
            if ($this->asignatura->photo) {
                Storage::delete($this->asignatura->photo);
            }
            $path = $this->photo->store('asignaturas');
            $this->input['banner_path'] = $path;
        }

        $this->asignatura->update($this->input);

        $this->notification()->success(
            $title = 'Asignatura actualizada',
            $description = 'La asignatura ha sido actualizada con éxito.'
        );

    }

    public function cancel()
    {
        return redirect()->route('profesor.asignatura', $this->asignatura);
    }

    public function render()
    {
        return view('livewire.asignatura-banner');
    }
}
