<?php

namespace App\Http\Livewire\Role;

use App\Models\Role;
use App\Models\User;
use App\Repositories\Contracts\UserRepository;
use Livewire\Component;

class EditUser extends Component
{
    public $role;
    public $perPage = 15;
    public $search = '';

    public function mount(Role $role)
    {
        $this->role = $role;
    }

    public function render()
    {
        return view('livewire.role.edit-user', [
            'users' => User::query()
                ->whereRoleIs($this->role->name)
                ->when($this->search ?? null, function ($query) {
                    $query->where(fn ($sub) => $sub
                        ->where('name', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%")
                    );
                })
                ->paginate($this->perPage)
        ]);
    }
}
