<?php

namespace App\Http\Livewire\Role;

use App\Models\Permission;
use App\Models\Role;
use App\Repositories\Contracts\RoleRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Livewire\Component;

/**
 * @property Collection $assignedValue
 */
class Create extends Component
{
    use AuthorizesRequests;

    public $role;
    public $permissions;
    public $assignedPermissions = [];
    protected $rules = [
        'role.name' => 'required|unique:roles,name',
        'role.display_name' => 'required',
        'role.description' => 'nullable',
    ];

    public function mount()
    {
        $this->permissions = Permission::query()
            ->orderBy('name')->get(['id', 'name', 'display_name'])
            ->mapToGroups(function ($permission) {
                $arrName = explode('-', $permission->name);
                $key = $arrName[0];
                return [$key => $permission];
            });
        $this->role = new Role;
    }

    public function render()
    {
        return view('livewire.role.create')
            ->extends('index');
    }

    public function save()
    {
        $this->authorize('create', Role::class);
        $this->validate();
        $this->role = Role::create($this->role->toArray());
        $this->role->syncPermissions($this->assignedValue);
        event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SECURITY_ROLE, "Thêm Vai trò"));
        session()->flash('success', __('Created.'));
        return redirect()->route('roles.index');
    }

    public function groupSelect($group)
    {
        $group = collect($group);
        $appendValue = $group->pluck('id')->intersect($this->assignedValue)->count() < $group->count() ? true : false;
        $group->each(fn ($item) => $this->assignedPermissions = collect($this->assignedPermissions)->put($item['id'], $appendValue));
        $this->assignedPermissions = collect($this->assignedPermissions)->toArray();
        $this->assignedValue = $this->getAssignedValueProperty();
    }

    public function getAssignedValueProperty()
    {
        return collect($this->assignedPermissions)
            ->filter(fn ($item) => $item)
            ->map(fn ($item, $key) => $key);
    }
}
