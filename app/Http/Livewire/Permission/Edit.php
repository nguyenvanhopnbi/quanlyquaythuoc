<?php

namespace App\Http\Livewire\Permission;

use App\Models\Permission;
use App\Models\group_permission;

use App\Repositories\Contracts\PermissionRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesRequests;

    public $permission = null;
    protected $listeners = [
        'edit' => 'edit'
    ];

    protected function rules()
    {
        return [
            'permission.name' => "required|unique:permissions,name,{$this->permission->id}",
            'permission.display_name' => 'required',
            'permission.description' => 'nullable',
            'permission.id_group_permission' => 'required',
        ];
    }

    public function render()
    {
        return view('livewire.permission.edit', [
            'getGroupName' => $this->getGroupName()
        ]);
    }

    public function getGroupName(){
        $groupName = group_permission::all();
        return $groupName;
    }

    public function getGroupNameCurrent($id){
        $groupName = group_permission::find($id);
        if(isset($groupName->id)){
            return $groupName->id;
        }

        return '0';

    }

    public $groupCurrentID;

    public function edit($permissionId)
    {
        $this->permission = Permission::findOrFail($permissionId);
        $this->groupCurrentID = $this->permission->id_group_permission;
    }

    public function save()
    {
        $this->authorize('update', $this->permission);
        $this->validate();
        if(empty($this->permission->getDirty())){
            $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => __('Không có bất cứ sự thay đổi nào!.')]);
            return;
        }
        $this->permission->update($this->permission->getDirty());
        event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SECURITY_PERMISSION, "Sửa Quyền hạn #" . $this->permission->id));
        $this->reset('permission');
        $this->emit('saved');
        $this->dispatchBrowserEvent('saved');
        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => __('Saved.')]);
    }
}
