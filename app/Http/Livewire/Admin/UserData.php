<?php

namespace App\Http\Livewire\Admin;

use App\Models\Genero;
use App\Models\TipoSangre;
use App\Models\TipoVivienda;
use App\Models\User;
use App\Models\UserData as ModelsUserData;
use Livewire\Component;

class UserData extends Component
{
    public $user, $generos, $tiposrh, $tiposvivienda;

    public $data=[
        'user_id' => null,
        'fecha_nacimiento' => null,
        'lugar_nacimiento' => null,
        'telefono' => null,
        'eps' => null,
        'religion' => null,
        'cant_personas_viven' => null,
        'cant_year_repetidos' => null,
        'cant_year_preescolar' => null,
        'cant_year_antes_preescolar' => null,
        'cant_hijos' => null,
        'cant_ant_disciplinarios' => null,
        'cant_hermanos' => null,
        'caja_comp_familiar' => null,
        'grupo_afro' => null,
        'tabajo_actual' => null,
        'genero_id' => '',
        'tipo_sangre_id' => '',
        'tipo_vivienda_id' => '',    
    ];

    protected function rules()
    {
        return [
        'data.fecha_nacimiento' => 'required|date|min:0|max:100',
        'data.lugar_nacimiento' => 'required|string|max:255',
        'data.telefono' => 'required|numeric',
        'data.eps' => 'required|string|max:255',
        'data.religion' => 'required|string|max:255',
        'data.cant_personas_viven' => 'required|numeric|min:0|max:100',
        'data.cant_year_repetidos' => 'required|numeric|min:0|max:100',
        'data.cant_year_preescolar' => 'required|numeric|min:0|max:100',
        'data.cant_year_antes_preescolar' => 'required|numeric|min:0|max:100',
        'data.cant_hijos' => 'required|numeric|min:0|max:100',
        'data.cant_ant_disciplinarios' => 'required|numeric|min:0|max:100',
        'data.cant_hermanos' => 'required|numeric|min:0|max:100',
        'data.caja_comp_familiar' => 'required|string|max:255',
        'data.grupo_afro' => 'required|string|max:255',
        'data.tabajo_actual' => 'required|string|max:255',
        'data.genero_id' => 'required',
        'data.tipo_sangre_id' => 'required',
        'data.tipo_vivienda_id' => 'required', 
        ];
    }

    public function mount(User $user)
    {
        $this->user = User::find($user->id);     
        if ($this->user->data) {
            $this->data = $user->data;
        }
        $this->generos = Genero::all();
        $this->tiposrh = TipoSangre::all();
        $this->tiposvivienda = TipoVivienda::all();
    }

    public function saveData()
    {
        $this->validate();

        if($this->user->data){ 
            $this->user->data = $this->data;
            $data = $this->user->data;
            $data->update();
            $this->user = $this->user->fresh();
        }else{
            $userdata = new ModelsUserData($this->data);    
            $user = $this->user;
            $user->data()->save($userdata);
            $this->user = $this->user->fresh();
            $this->reset('data');
            $this->data = $this->user->data;
        }
        $this->emit('saved');
    }

    public function render()
    {
        return view('livewire.admin.user-data');
    }
}
