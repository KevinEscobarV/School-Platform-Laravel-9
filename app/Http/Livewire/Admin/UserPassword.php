<?php

namespace App\Http\Livewire\Admin;

use App\Actions\Fortify\PasswordValidationRules;
use App\Actions\Fortify\UpdateClientPassword;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class UserPassword extends Component
{
    use PasswordValidationRules;

    public $user;
    public $state = [
        'password' => '',
        'password_confirmation' => '',
    ];

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function updatePassword(UpdateClientPassword $updater)
    {
        $this->resetErrorBag();

        $updater->update($this->user, $this->state);

        $this->state = [
            'password' => '',
            'password_confirmation' => '',
        ];

        $this->emit('saved');
    }

    public function render()
    {
        return view('livewire.admin.user-password');
    }
}
