<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use App\Repositories\Contracts\RoleRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesRequests;

    public User $user;

    public function render()
    {
        $this->authorize('update', $this->user);
        return view('livewire.user.edit')
            ->extends('index');
    }
}
