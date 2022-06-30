<?php

namespace App\Http\Livewire;

use App\Models\Entrega;
use App\Models\EntregaImage;
use App\Models\SchoolWork;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EntregaComponent extends Component
{
    use WithFileUploads;

    public SchoolWork $school_work;

    public $input = [
        'titulo',
        'contenido',
        'school_work_id',
        'student_id',
    ];

    public $rand;

    public $urls=[];

    public $files_paths=[];

    public $rules = [
        'input.titulo' => 'required|string|min:3|max:255',
        'input.contenido' => 'min:30',
        'files_paths.*' => 'required|mimes:doc,docx,pdf,txt,jpeg,png,jpg,gif,svg,xls,xlsx,ppt,pptx,zip,rar|max:10240',
    ];

    public $validationAttributes = [
        'input.titulo' => 'Título',
        'input.contenido' => 'Contenido',
        'files_paths.*' => 'Archivos',
    ];

    public function save(){

        if ($this->school_work->fecha_fin < now()) {
            session()->flash('flash.banner', '¡No intentes jugar con el sistema, no puedes entregar trabajos despues de la fecha limite!');
            session()->flash('flash.bannerStyle', 'danger');
            $route = url()->previous();
            return redirect($route);
        }

        $this->validate();
        $this->input['student_id'] = auth()->user()->id;
        $this->input['school_work_id'] = $this->school_work->id;
        $entrega = Entrega::create($this->input);
        $this->syncUsedImagesEntrega($entrega);
        $this->deleteUnusedImages();
        if ($this->school_work->files) {
            $this->uploadFilesEntrega($entrega);
        }
        $this->reset('input');
        session()->flash('flash.banner', '¡Se ha realizado la entrega con éxito!');
        session()->flash('flash.bannerStyle', 'success');
        $route = url()->previous();
        return redirect($route);
    }

    public function uploadFilesEntrega($entrega){
        foreach ($this->files_paths as $file){
            $name = $file->getClientOriginalName();
            $path = $file->store('files_entregas');
            $entrega->entrega_files()->create([
                'name' => $name,
                'path' => $path,
            ]);
        }
        $this->reset('files_paths');
    }

    public function syncUsedImagesEntrega($entrega){
        foreach ($this->urls as $url) {
            $path = str_replace (Storage::url(''), '' , $url);
            EntregaImage::where('url', $path)
            ->where('entrega_id', null)
            ->where('user_id', auth()->user()->id)
            ->update(['entrega_id' => $entrega->id]);
        }
    }

    public function deleteUnusedImages(){
        $images = EntregaImage::where('entrega_id', null)->where('user_id', auth()->user()->id)->get();
        foreach ($images as $image) {
            Storage::delete($image->url);
            $image->delete();
        }
    }

    public function render()
    {
        return view('livewire.entrega-component');
    }
}
