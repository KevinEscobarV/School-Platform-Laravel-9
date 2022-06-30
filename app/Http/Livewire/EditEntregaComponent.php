<?php

namespace App\Http\Livewire;

use App\Models\Entrega;
use App\Models\EntregaFile;
use App\Models\EntregaImage;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class EditEntregaComponent extends Component
{
    use Actions;
    use WithFileUploads;

    public $entrega;
    public $open = false;
    public $form = [];
    public $urls = [];
    public $files_paths = [];
    public $archivos;

    public $rules = [
        'form.titulo' => 'required|string|min:3|max:255',
        'form.contenido' => 'min:30',
        'files_paths.*' => 'required|mimes:doc,docx,pdf,txt,jpeg,png,jpg,gif,svg,xls,xlsx,ppt,pptx,zip,rar|max:10240',
    ];

    public $validationAttributes = [
        'form.titulo' => 'Título',
        'form.contenido' => 'Contenido',
        'files_paths.*' => 'Archivos',
    ];

    public function mount(Entrega $entrega)
    {
        $this->entrega = $entrega;
        $this->form = $entrega->withoutRelations()->only(['titulo', 'contenido']);
    }

    public function edit()
    {
        $this->open = true;
    }

    public function update()
    {
        $this->validate();
        if ($this->entrega->contenido != $this->form['contenido']) {
            $this->syncUsedImagesEntrega($this->entrega);
            $this->deleteUnusedImages();
        }
        if ($this->files_paths) {
            $this->uploadFilesEntrega($this->entrega);
        }
        $this->entrega->update($this->form);
        $this->reset('form', 'urls', 'files_paths', 'open');
        session()->flash('flash.banner', '¡Entrega actualizada!');
        session()->flash('flash.bannerStyle', 'success');
        $route = url()->previous();
        return redirect($route);
    }

    public function syncUsedImagesEntrega($entrega){
        $images_uploads_unused = EntregaImage::where('entrega_id', $entrega->id)->where('user_id', auth()->user()->id)->get();
        $paths = str_replace(Storage::url(''), '' , $this->urls);
        foreach ($paths as $path) {
            EntregaImage::where('url', $path)
            ->where('entrega_id', null)
            ->where('user_id', auth()->user()->id)
            ->update(['entrega_id' => $entrega->id]);
        }
        foreach ($images_uploads_unused as $image) {
            if (!in_array($image->url, $paths)) {
                Storage::delete($image->url);
                $image->delete();
            }
        }
    }

    public function deleteUnusedImages(){
        $images = EntregaImage::where('entrega_id', null)->where('user_id', auth()->user()->id)->get();
        foreach ($images as $image) {
            Storage::delete($image->url);
            $image->delete();
        }
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

    public function deleteFile($id)
    {
        $file = EntregaFile::find($id);
        Storage::delete($file->path);
        $file->delete();
        $this->notification()->success(
            $title = 'Archivo eliminado',
            $description = 'El archivo se ha eliminado correctamente'
        );
        $this->entrega->refresh();
    }

    public function delete()
    {
        $this->entrega->entrega_files()->each(function ($file) {
            Storage::delete($file->path);
        });
        $this->entrega->entrega_images()->each(function ($image) {
            Storage::delete($image->url);
        });
        $this->entrega->delete();
        session()->flash('flash.banner', '¡Entrega eliminada!');
        session()->flash('flash.bannerStyle', 'danger');
        $route = url()->previous();
        return redirect($route);
    }

    public function render()
    {
        return view('livewire.edit-entrega-component');
    }
}
