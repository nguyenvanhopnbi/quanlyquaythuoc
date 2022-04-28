<?php

namespace Tests\Feature;

use App\Models\{Permission, Role, User};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_access_list_role()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $user->attachPermissions([
            Permission::factory()->create(['name' => 'role-browse']),
            Permission::factory()->create(['name' => 'role-add']),
            Permission::factory()->create(['name' => 'role-edit']),
        ]);

        $this->actingAs($user)
            ->get(route('roles.index'))
            ->assertOk();
    }

    public function test_cant_access_list_role()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('roles.index'))
            ->assertForbidden();
    }

    public function test_create_a_role()
    {
        $user = User::factory()->create();
        $user->attachPermission(Permission::factory()->create(['name' => 'role-add']));
        $this->actingAs($user);
        Livewire::test('role.create')
            ->set('role.name', '::role.name::')
            ->set('role.display_name', '::role.display_name::')
            ->set('role.description', '::role.description::')
            ->call('save');
        $this->assertDatabaseCount('roles', 1)
            ->assertDatabaseHas('roles', [
                'name' => '::role.name::',
                'display_name' => '::role.display_name::',
                'display_name' => '::role.display_name::',
                'description' => '::role.description::',
            ]);
    }

    public function test_edit_a_role()
    {
        $user = User::factory()->create();
        $user->attachPermission(Permission::factory()->create(['name' => 'role-edit']));
        $this->actingAs($user);
        $role = Role::create([
            'name' => '::role.name::',
            'display_name' => '::role.display_name::',
            'description' => '::role.description::',
        ]);
        Livewire::test('role.edit-info', ['role' => $role])
            ->assertSet('role.name', '::role.name::')
            ->assertSet('role.display_name', '::role.display_name::')
            ->assertSet('role.description', '::role.description::')
            ->set('role.name', '::role.new-name::')
            ->set('role.display_name', '::role.new-display_name::')
            ->set('role.description', '::role.new-description::')
            ->call('save')
            ->assertDispatchedBrowserEvent('notify');
        $this->assertDatabaseCount('roles', 1)
            ->assertDatabaseHas('roles', [
                'name' => '::role.new-name::',
                'display_name' => '::role.new-display_name::',
                'description' => '::role.new-description::',
            ]);
    }

    public function test_delete_a_role()
    {
        $user = User::factory()->create();
        $user->attachPermissions([
            Permission::factory()->create(['name' => 'role-browse']),
            Permission::factory()->create(['name' => 'role-delete']),
        ]);
        $this->actingAs($user);
        $role = Role::factory()->create();
        Livewire::test('role.index')
            ->call('delete', $role->id)
            ->assertDispatchedBrowserEvent('notify');
        $this->assertDeleted($role);
    }
}
