<?php

namespace App\Http\Livewire;

use App\Models\Asignatura;
use App\Models\Tema;
use App\Models\TemaFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;

class TemaComponent extends Component
{
    use Actions;

    use WithPagination;

    use WithFileUploads;

    public Asignatura $asignatura;

    public $files_paths = [];
    public $open = false;
    public $editInput = [];
    public $editFiles_paths;
    public $tema;

    public $input = [
        'titulo' => '',
        'contenido' => '',
        'slug' => '',
    ];

    public $input_rules = [
        'input.titulo' => 'required|string|max:255',
        'input.contenido' => 'required|string|min:10',
        'input.slug' => 'required|string|max:255|unique:temas,slug',
        'files_paths.*' => 'required|mimes:doc,docx,pdf,txt,jpeg,png,jpg,gif,svg,xls,xlsx,ppt,pptx,zip,rar|max:10240',
    ];

    public $edit_rules = [
        'editInput.titulo' => 'required|string|max:255',
        'editInput.contenido' => 'required|string|min:10',
        'editInput.slug' => 'required|string|max:255|unique:temas,slug',
        'files_paths.*' => 'required|mimes:doc,docx,pdf,txt,jpeg,png,jpg,gif,svg,xls,xlsx,ppt,pptx,zip,rar|max:10240',
    ];

    public function editRules($id)
    {
        $this->edit_rules['editInput.slug'] = 'required|string|max:255|unique:temas,slug,' . $id;
        return $this->edit_rules;
    }

    public $validationAttributes = [
        'input.titulo' => 'Título',
        'input.contenido' => 'Contenido',
        'files_paths.*' => 'Archivos',
        'editInput.titulo' => 'Título',
        'editInput.contenido' => 'Contenido',
    ];

    public function save()
    {
        $this->input['slug'] = Str::slug($this->input['titulo'].now()->format('h:i:s'));
        $this->validate($this->input_rules);
        $tema = $this->asignatura->temas()->create($this->input);
        $this->uploadFilesTema($tema);
        $this->reset('input');
        $this->resetValidation();
        $this->notification()->success(
            $title = 'Tema creado',
            $description = 'El tema se ha creado correctamente'
        );
    }

    public function editTema($id)
    {
        $this->open = true;
        $tema = Tema::find($id);
        $this->tema = $tema;
        $this->editRules($id);
        $this->editInput = $tema->withoutRelations()->toArray();
        $this->editFiles_paths = $tema->tema_files;
        $this->reset('files_paths');
    }

    public function update()
    {
        $this->validate($this->edit_rules);
        $tema = Tema::find($this->tema->id);
        $tema->update($this->editInput);
        $this->uploadFilesTema($tema);
        $this->reset('editInput', 'editFiles_paths', 'files_paths', 'open');
        $this->resetValidation();
        $this->notification()->success(
            $title = 'Tema actualizado',
            $description = 'El tema se ha actualizado correctamente'
        );
    }

    public function uploadFilesTema($tema){
        foreach ($this->files_paths as $file){
            $name = $file->getClientOriginalName();
            $path = $file->store('files_temas');
            $tema->tema_files()->create([
                'name' => $name,
                'file_path' => $path,
            ]);
        }
        $this->reset('files_paths');
    }

    public function delete($id)
    {
        $tema = Tema::find($id);
        foreach ($tema->tema_files as $file) {
            Storage::delete($file->file_path);
        }
        $tema->delete();
        $this->notification()->warning(
            $title = 'Tema eliminado',
            $description = 'El tema se ha eliminado correctamente'
        );
    }

    public function deleteFile($id)
    {
        $file = TemaFile::find($id);
        Storage::delete($file->file_path);
        $file->delete();
        $tema = Tema::find($this->tema->id);
        $this->editFiles_paths = $tema->tema_files;
        $this->notification()->success(
            $title = 'Archivo eliminado',
            $description = 'El archivo se ha eliminado correctamente'
        );
    }

    public function render()
    {
        $temas = Tema::where('asignatura_id', $this->asignatura->id)->orderByDesc('created_at')->paginate(6);
        return view('livewire.tema-component', compact('temas'));
    }
}
