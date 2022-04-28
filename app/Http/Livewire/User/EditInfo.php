<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class EditInfo extends Component
{
    use AuthorizesRequests;

    public User $user;

    protected $rules = [
        'user.name' => 'required',
        'user.phone' => 'nullable',
        'user.is_active' => 'required|boolean',
    ];

    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.user.edit-info');
    }

    public function save()
    {
        $this->authorize('update', $this->user);
        $this->validate();
        $this->user->update($this->user->getDirty());
        event(new \App\Events\ActivityOccur(\App\Enums\LogCategoryEnum::SECURITY_USER, "Sửa Thông tin Thành viên #" . $this->user->id));
        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => __('Saved.')]);
    }
}
