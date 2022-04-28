<?php

namespace App\Http\Livewire\Permission;

use Livewire\Component;
use App\Models\group_permission;
use Livewire\WithPagination;

class GroupPermission extends Component
{
     use WithPagination;
     protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'Addnew' => 'Addnew',
        'Edit' => 'Edit',
        'delete' => 'delete',
        'Search' => 'Search'
    ];

    public $groupNameSearch = '';

    public function render()
    {
        return view('livewire.permission.group-permission', [
            'getGroup' => $this->getGroup()
        ])->extends('index');
    }

    public function Search($groupName){
        $this->groupNameSearch = $groupName;
    }


    public function getGroup(){
        return group_permission::where('group_name', 'like', '%'.$this->groupNameSearch .'%')->paginate(20);
    }

    public function Addnew($groupName){

        $result =  group_permission::create([
            'group_name' => $groupName
        ]);


        if($result){
            $this->message = "Bạn thêm mới nhóm quyền thành công!";
            $this->warning = false;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SECURITY_GROUP_PERMISSION, "Thêm mới nhóm quyền thành công #" .$groupName, compact('groupName')));

        }else{
            $this->message = "Bạn thêm mới nhóm quyền thất bại!";
            $this->warning = true;
        }
    }

    public $message;
    public $warning = false;

    public function Edit($groupName, $id){
        $result = group_permission::where('ID', $id)->update(
            [
                'group_name' => $groupName
            ]
        );
        if($result == 1){
            $this->message = "Bạn cập nhật nhóm quyền thành công!";
            $this->warning = false;

            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SECURITY_GROUP_PERMISSION, "Sửa nhóm quyền thành công #". $id .$groupName, compact('groupName')));
        }else{
            $this->message = "Bạn cập nhật nhóm quyền thất bại!";
            $this->warning = true;
        }
    }

    public function delete($id){
        $rows = group_permission::where('id', $id)->delete();

        if($rows){
            event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SECURITY_GROUP_PERMISSION, "Xóa nhóm quyền thành công #" . $id, compact('id')));
        }


    }
}
