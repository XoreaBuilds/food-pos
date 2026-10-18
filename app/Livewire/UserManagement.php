<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Spatie\Permission\Models\Role;

#[Layout('layouts.app')]
class UserManagement extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $selectedRole = '';

    public function render()
    {
        return view('livewire.user-management', [
            'users' => User::with('roles')->get(),
            'roles' => Role::all(),
        ]);
    }

    public function createUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'selectedRole' => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        $user->assignRole($this->selectedRole);

        $this->reset(['name', 'email', 'password', 'selectedRole']);
    }

    public function deleteUser($userId)
    {
        User::findOrFail($userId)->delete();
    }
}
