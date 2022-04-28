<?php

namespace App\Http\Livewire\Role;

use App\Models\Permission;
use App\Models\group_permission;
use App\Models\Role;
use App\Repositories\Contracts\PermissionRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Component;

/**
 * @property Collection $assignedValue
 */
class EditPermission extends Component
{
    use AuthorizesRequests;

    public $role;
    // public $permissions;
    public $assignedPermissions;
    public $search = '';

    public function mount(Role $role)
    {
        $this->assignedPermissions = $role
            ->permissions()
            ->pluck('id')
            ->flip()
            ->map(fn () => true)
            ->toArray();
        $this->role = $role;
        // dump($this->assignedPermissions);
    }


    public function render()
    {

        $dataPermission = Permission::query()
                ->when($this->search ?? null, fn ($query, $search) => $query->search($search))
                ->orderBy('name')->get(['id', 'name', 'display_name', 'id_group_permission'])
                ->mapToGroups(function ($permission) {
                    $arrName = explode('-', $permission->name);
                    $arrName = collect($arrName);
                    $arrName->pop();
                    $key = $arrName->implode(' ');
                    $key = Str::title($key);
                    if($this->getNameGroup($permission->id_group_permission) != '0'){
                        $keyName = $this->getNameGroup($permission->id_group_permission);
                    }else{
                        $keyName = $key;
                    }


                    return [$keyName => $permission];
                });




        return view('livewire.role.edit-permission', [
            'permissions' => $dataPermission
        ]);
    }

    public function getNameGroup($id){
        $nameGroup = group_permission::find($id);
        if(isset($nameGroup->group_name)){
            return $nameGroup->group_name;
        }
        return '0';

    }



    // public function render()
    // {
    //     return view('livewire.role.edit-permission', [
    //         'permissions' => Permission::query()
    //             ->when($this->search ?? null, fn ($query, $search) => $query->search($search))
    //             ->orderBy('name')->get(['id', 'name', 'display_name', 'ID_group_permission'])
    //             ->mapToGroups(function ($permission) {
    //                 $arrName = explode('-', $permission->name);
    //                 $arrName = collect($arrName);
    //                 $arrName->pop();
    //                 $key = $arrName->implode(' ');
    //                 $key = Str::title($key);
    //                 return [$key => $permission];
    //             })
    //     ]);
    // }

    public function save()
    {
        $this->authorize('update', $this->role);
        $this->role->syncPermissions($this->assignedValue);
        event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SECURITY_ROLE, "Cập nhật Quyền hạn cho Vai trò #" . $this->role->id));
        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => __('Saved.')]);
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
