<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use App\Repositories\Contracts\UserRepository;
use Livewire\Component;

class Index extends Component
{
    public $search = '';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function render()
    {
        return view('livewire.user.index', [
            'users' => User::query()
                ->when(
                    $this->search ?? null,
                    fn ($query) => $query
                        ->where('name', 'like', "%{$this->search}")
                        ->orWhere('phone', 'like', "%{$this->search}")
                        ->orWhere('email', 'like', "%{$this->search}")
                )
                ->latest('id')
                ->simplePaginate($this->perPage)
        ])->extends('index');
    }
}
