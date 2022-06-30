<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class UsersComponent extends Component
{
    use WithPagination;

    protected $queryString =['search' => ['except' => '']];
    public $search = '';
    public $perPage = '10';
    public $roles;

    protected $listeners = ['delete'];

    public $createForm = [
        'name' => null,
        'apellido' => null,
        'identificacion' => null,
        'email' => null,
        'password' => null,
        'grado_id' => null,
        'roles' => [],
    ];

    public $rulesCrate = [
        'createForm.name' => 'required|string|max:255',
        'createForm.apellido' => 'required|string|max:255',
        'createForm.identificacion' => 'required|string|max:255|unique:users,identificacion',
        'createForm.email' => 'required|string|email|max:255|unique:users,email',
        'createForm.password' => 'required',
        'createForm.roles' => 'required',
    ];


    protected $validationAttributes = [
        'createForm.name' => 'nombre',
        'createForm.apellido' => 'apellido',
        'createForm.identificacion' => 'identificacion',
        'createForm.email' => 'correo electronico',
        'createForm.password' => 'contraseña',
        'createForm.roles' => 'rol',
    ];

    public function mount()
    {
        $this->roles = Role::all();
    }

    public function save()
    {
        $this->validate($this->rulesCrate);       
        $this->createForm['password'] = bcrypt($this->createForm['password']);
        
        User::create($this->createForm)->syncRoles($this->createForm['roles']);
        $this->reset('createForm');
        $this->emit('saved');
    }


    public function render()
    {
        return view('livewire.admin.users-component', ['users' => User::where('name', 'LIKE', "%{$this->search}%" )
        ->orWhere('email', 'LIKE', "%{$this->search}%")->orWhere('identificacion', 'LIKE', "%{$this->search}%")
        ->orderBy('name')
        ->paginate($this->perPage)]);
    }
}
