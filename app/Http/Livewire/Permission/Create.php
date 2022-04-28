<?php

namespace App\Http\Livewire\Permission;

use App\Models\Permission;
use App\Models\group_permission;
use App\Repositories\Contracts\PermissionRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;

    public $permission;
    protected $rules = [
        'permission.name' => 'required|unique:permissions,name',
        'permission.display_name' => 'required',
        'permission.description' => 'nullable',
        'permission.id_group_permission' => 'nullable',
    ];

    public function mount()
    {
        $this->permission = new Permission;
    }

    public function render()
    {
        $this->getGroupName();
        $this->authorize('create', Permission::class);
        return view('livewire.permission.create', [
            'getGroupName' => $this->getGroupName()
        ]);
    }

    public function getGroupName(){
        $groupName = group_permission::all();
        return $groupName;
    }


    public $id_group_permission_check;

    public function save()
    {
        $this->authorize('create', Permission::class);
        $this->validate();

        $params = $this->permission->toArray();
        if($params['id_group_permission'] == null){
            $this->id_group_permission_check = "Bạn cần chọn nhóm quyền, nếu chưa có hãy tạo nhóm quyền trước.";
            return;
        }else{
            unset($this->id_group_permission_check);
        }

        // dd($this->permission->toArray());

        Permission::create($this->permission->toArray());
        $this->permission = new Permission;
        event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SECURITY_PERMISSION, "Thêm Quyền hạn"));
        $this->emit('saved');
        $this->dispatchBrowserEvent('saved');
        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => __('Created.')]);
    }
}
