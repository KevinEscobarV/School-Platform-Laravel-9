<?php

namespace App\Http\Livewire;

use App\Models\SchoolWork;
use App\Models\Tema;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class SchoolWorkComponent extends Component
{
    use Actions;
    use WithPagination;

    public Tema $tema;

    public $editWork = [
        'nombre' => '',
        'contenido' => '',
        'fecha_inicio' => '',
        'fecha_fin' => '',
        'files',
        'edit',
    ];

    public $open = false;

    public $input = [
        'nombre' => '',
        'contenido' => '',
        'fecha_inicio' => '',
        'fecha_fin' => '',
        'files' => true,
        'edit' => true,
    ];

    public $rules = [
        'input.nombre' => 'required|string|max:255',
        'input.contenido' => 'required|string|min:10',
        'input.fecha_inicio' => 'required|date|after_or_equal:today',
        'input.fecha_fin' => 'required|date|after:input.fecha_inicio',
        'input.files' => 'required|boolean',
        'input.edit' => 'required|boolean',
    ];

    public $edit_rules = [
        'editWork.nombre' => 'required|string|max:255',
        'editWork.contenido' => 'required|string|min:10',
        'editWork.fecha_inicio' => 'required|date|after_or_equal:editWork.fecha_inicio',
        'editWork.fecha_fin' => 'required|date|after:editWork.fecha_inicio',
        'editWork.files' => 'required|boolean',
        'editWork.edit' => 'required|boolean',
    ];

    public $validationAttributes = [
        'input.nombre' => 'Nombre',
        'input.contenido' => 'Contenido',
        'input.fecha_inicio' => 'Fecha de inicio',
        'input.fecha_fin' => 'Fecha de finalización',
        'input.files' => 'Archivos',
        'input.edit' => 'Editar',
    ];

    protected $messages = [
        'input.fecha_inicio.after_or_equal' => 'La fecha de inicio debe ser posterior a la fecha actual',
        'editWork.fecha_inicio.after' => 'La fecha de inicio debe ser posterior a la fecha actual',
    ];

    public function mount()
    {
        $this->input['fecha_inicio'] = now()->format('Y-m-d H:i:s');
    }

    public function save()
    {
        $this->validate();
        $this->tema->school_works()->create($this->input);
        $this->resetValidation();
        $this->reset('input');
        $this->input['fecha_inicio'] = now()->format('Y-m-d H:i:s');
        $this->notification()->success(
            $title = 'Tarea creada',
            $description = 'La tarea ha sido creada correctamente'
        );
    }

    public function editWork($id)
    {
        $this->open = true;
        $work = SchoolWork::find($id);
        $this->editWork = $work->withoutRelations()->toArray();
        $this->resetValidation();
    }

    public function update()
    {
        $this->validate($this->edit_rules);
        SchoolWork::find($this->editWork['id'])->update($this->editWork);
        $this->resetValidation();
        $this->reset('editWork', 'open');
        $this->notification()->success(
            $title = 'Tarea actualizada',
            $description = 'La tarea ha sido actualizada correctamente',
        );
    }

    public function delete($id)
    {
        $school_work = SchoolWork::find($id);
        $school_work->delete();
        $this->notification()->success(
            $title = 'Tarea eliminada',
            $description = 'La tarea ha sido eliminada correctamente'
        );
    }

    public function render()
    {
        $works = SchoolWork::where('tema_id', $this->tema->id)->orderByDesc('created_at')->paginate(6);
        return view('livewire.school-work-component' , compact('works'));
    }
}
