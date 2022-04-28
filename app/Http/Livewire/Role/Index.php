<?php

namespace App\Http\Livewire\Role;

use App\Models\Role;
use App\Repositories\Contracts\RoleRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, AuthorizesRequests;

    public $search = '';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => '']
    ];
    protected $listeners = [
        'saved' => '$refresh',
    ];
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.role.index', [
            'roles' => Role::query()
                ->when(
                    $this->search ?? null,
                    fn ($query) => $query
                        ->where('name', 'like', "%{$this->search}")
                        ->orWhere('display_name', 'like', "%{$this->search}")
                        ->orWhere('description', 'like', "%{$this->search}")
                )
                ->latest('id')
                ->simplePaginate($this->perPage)
        ])->extends('index');
    }

    public function delete($itemToDelete)
    {
        $this->authorize('delete', $role = Role::findOrFail($itemToDelete));
        $role->delete();
        event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SECURITY_ROLE, "Xóa Vai trò #" . $itemToDelete));
        $this->emit('$refresh');
        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => __('Deleted.')]);
    }
}
