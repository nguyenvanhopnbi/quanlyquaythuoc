<?php

namespace Tests\Feature;

use App\Models\{Permission, Role, User};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_access_list_user()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $user->attachPermissions([
            Permission::factory()->create(['name' => 'user-browse']),
            Permission::factory()->create(['name' => 'user-add']),
            Permission::factory()->create(['name' => 'user-edit']),
        ]);

        $this->actingAs($user)
            ->get(route('users.index'))
            ->assertOk();
    }

    public function test_cant_access_list_user()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('users.index'))
            ->assertForbidden();
    }

    public function test_edit_a_user()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $user->attachPermission(Permission::factory()->create(['name' => 'user-edit']));
        $this->actingAs($user);
        $user = User::factory()->create([
            'name' => '::user.name::',
            'email' => '::user.email::',
            'phone' => '::user.phone::',
            'is_active' => false,
        ]);
        Livewire::test('user.edit-info', ['user' => $user])
            ->assertSet('user.name', '::user.name::')
            ->assertSet('user.phone', '::user.phone::')
            ->assertSet('user.is_active', false)
            ->set('user.name', '::user.new-name::')
            ->set('user.phone', '::user.new-phone::')
            ->set('user.is_active', true)
            ->call('save')
            ->assertDispatchedBrowserEvent('notify');
        $this->assertDatabaseCount('users', 2);
    }
}
