<?php

namespace App\Http\Livewire\User;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class EditRole extends Component
{
    use AuthorizesRequests;

    public $roles;
    public $assignedRoles;
    public User $user;

    protected $rules = [
        'assignedRoles' => 'nullable|array'
    ];

    public function mount(User $user)
    {
        $this->roles = Role::get(['id', 'display_name']);
        $this->user = $user;
        $this->assignedRoles = $this->user->roles()->pluck('id');
    }

    public function render()
    {
        return view('livewire.user.edit-role');
    }

    public function save()
    {
        $this->authorize('update', $this->user);
        $this->user->syncRoles($this->assignedRoles);
        event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SECURITY_USER, "Cập nhật Vai trò cho Thành viên #" . $this->user->id));
        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => __('Saved.')]);
    }

    public function getUserPermissionsProperty()
    {
        return Role::find($this->assignedRoles)
            ->load('permissions:id,display_name')
            ->pluck('permissions')
            ->collapse()
            ->pluck('display_name');
    }
}
