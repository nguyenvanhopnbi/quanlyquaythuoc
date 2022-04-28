<?php

namespace App\Http\Livewire\Role;

use App\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesRequests;

    public Role $role;

    public function render()
    {
        $this->authorize('update', $this->role);
        return view('livewire.role.edit')
            ->extends('index');
    }
}
