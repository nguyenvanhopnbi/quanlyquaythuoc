<?php

namespace Tests\Feature;

use App\Models\{Permission, User};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_access_list_permission()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $user->attachPermissions([
            Permission::factory()->create(['name' => 'permission-browse']),
            Permission::factory()->create(['name' => 'permission-add']),
            Permission::factory()->create(['name' => 'permission-edit']),
        ]);

        $this->actingAs($user)
            ->get(route('permissions'))
            ->assertOk()
            ->assertSeeLivewire('permission.create')
            ->assertSeeLivewire('permission.edit');
    }

    public function test_cant_access_list_permission()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('permissions'))
            ->assertForbidden();
    }

    public function test_create_a_permission()
    {
        $user = User::factory()->create();
        $user->attachPermission(Permission::factory()->create(['name' => 'permission-add']));
        $this->actingAs($user);
        Livewire::test('permission.create')
            ->set('permission.name', '::permission.name::')
            ->set('permission.display_name', '::permission.display_name::')
            ->set('permission.description', '::permission.description::')
            ->call('save')
            ->assertDispatchedBrowserEvent('notify');
        $this->assertDatabaseCount('permissions', 2)
            ->assertDatabaseHas('permissions', [
                'name' => '::permission.name::',
                'display_name' => '::permission.display_name::',
                'display_name' => '::permission.display_name::',
                'description' => '::permission.description::',
            ]);
    }

    public function test_edit_a_permission()
    {
        $user = User::factory()->create();
        $user->attachPermission(Permission::factory()->create(['name' => 'permission-edit']));
        $this->actingAs($user);
        $permission = Permission::create([
            'name' => '::permission.name::',
            'display_name' => '::permission.display_name::',
            'description' => '::permission.description::',
        ]);
        Livewire::test('permission.edit')
            ->call('edit', $permission->id)
            ->assertSet('permission.name', '::permission.name::')
            ->assertSet('permission.display_name', '::permission.display_name::')
            ->assertSet('permission.description', '::permission.description::')
            ->set('permission.name', '::permission.new-name::')
            ->set('permission.display_name', '::permission.new-display_name::')
            ->set('permission.description', '::permission.new-description::')
            ->call('save')
            ->assertDispatchedBrowserEvent('notify');
        $this->assertDatabaseCount('permissions', 2)
            ->assertDatabaseHas('permissions', [
                'name' => '::permission.new-name::',
                'display_name' => '::permission.new-display_name::',
                'description' => '::permission.new-description::',
            ]);
    }

    public function test_delete_a_permission()
    {
        $user = User::factory()->create();
        $user->attachPermissions([
            Permission::factory()->create(['name' => 'permission-browse']),
            Permission::factory()->create(['name' => 'permission-delete']),
        ]);
        $this->actingAs($user);
        $permission = Permission::factory()->create();
        Livewire::test('permission.index')
            ->call('delete', $permission->id)
            ->assertDispatchedBrowserEvent('notify');
        $this->assertDeleted($permission);
    }
}
