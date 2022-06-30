<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class UserEdit extends Component
{
    use WithFileUploads;

    public $user, $roles; 
    
    public $user_roles=[];

    public $photo;

    protected function rules()
    {
        return [
            'photo' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'user.name' => 'required|string|max:255',
            'user.apellido' => 'required|string|max:255',
            'user_roles' => 'required',
            'user.identificacion' => 'required|string|max:255|unique:users,identificacion,' . $this->user->id,
            'user.email' => 'required|string|email|max:255|unique:users,email,' . $this->user->id
        ];
    }

    public function mount(User $user)
    {
        $this->user = $user;
        $this->roles = Role::all();
        $this->user_roles = $user->roles->pluck('id');
    }

    public function save()
    {
        $this->validate();

        if (isset($this->photo)) {
            $this->user->updateProfilePhoto($this->photo);
            $this->photo->store('profile-photos');
        }

        $this->user->save();   
        $this->user->syncRoles($this->user_roles);
        $this->emit('saved');
    }

    public function deleteProfilePhoto(User $user)
    {
        $user->deleteProfilePhoto();
        $this->user = $this->user->fresh();   
    }

    public function render()
    {
        return view('livewire.admin.user-edit');
    }
}
