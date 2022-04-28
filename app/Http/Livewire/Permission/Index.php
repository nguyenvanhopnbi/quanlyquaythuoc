<?php

namespace App\Http\Livewire\Permission;

use App\Models\Permission;
use App\Models\group_permission;
use App\Repositories\Contracts\PermissionRepository;
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


        $listPermission = Permission::query()
                ->when(
                    $this->search ?? null,
                    fn ($query) => $query
                        ->where('name', 'like', "%{$this->search}")
                        ->orWhere('display_name', 'like', "%{$this->search}")
                        ->orWhere('description', 'like', "%{$this->search}")
                )
                ->latest('id')
                ->simplePaginate($this->perPage);

        foreach($listPermission as $listPer){
            if($this->getGroupName($listPer->id_group_permission) != null and $this->getGroupName($listPer->id_group_permission) != '0'){
                $listPer->id_group_permission = $this->getGroupName($listPer->id_group_permission);
            }else{
                $listPer->id_group_permission = 'Chưa phân nhóm quyền';
            }

        }


        $this->authorize('viewAny', Permission::class);
        return view('livewire.permission.index', [
            'permissions' => $listPermission
        ])->extends('index');
    }

    public function getGroupName($id){
        $groupName = group_permission::find($id);
        if(isset($groupName->group_name)){
            return $groupName->group_name;
        }

        return '0';

    }

    // public function render()
    // {
    //     $this->authorize('viewAny', Permission::class);
    //     return view('livewire.permission.index', [
    //         'permissions' => Permission::query()
    //             ->when(
    //                 $this->search ?? null,
    //                 fn ($query) => $query
    //                     ->where('name', 'like', "%{$this->search}")
    //                     ->orWhere('display_name', 'like', "%{$this->search}")
    //                     ->orWhere('description', 'like', "%{$this->search}")
    //             )
    //             ->latest('id')
    //             ->simplePaginate($this->perPage)
    //     ])->extends('index');
    // }

    public function delete($itemToDelete)
    {
        $this->authorize('delete', $permission = Permission::findOrFail($itemToDelete));
        $permission->delete();
        event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SECURITY_PERMISSION, "Xóa Quyền hạn #" . $itemToDelete));
        $this->emit('$refresh');
        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => __('Deleted.')]);
    }
}
