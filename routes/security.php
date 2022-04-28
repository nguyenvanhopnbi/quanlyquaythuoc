<?php

use Illuminate\Support\Facades\Route;

Route::get('permissions', \App\Http\Livewire\Permission\Index::class)->name('permissions');
Route::get('permissions-user-am-manage', \App\Http\Livewire\Permission\UserAM::class)->name('user-am-manage');

Route::get('permissions-group', \App\Http\Livewire\Permission\GroupPermission::class)->name('group-permissions');

Route::prefix('permissions-roles')->as('roles.')->group(function () {
    Route::get('', \App\Http\Livewire\Role\Index::class)
        ->name('index')
        ->middleware('can:viewAny,' . \App\Models\Role::class);
    Route::get('create', \App\Http\Livewire\Role\Create::class)
        ->name('create');
    Route::get('{role}/edit', \App\Http\Livewire\Role\Edit::class)
        ->name('edit');
});

Route::prefix('permissions-users')->as('users.')->group(function () {
    Route::get('', \App\Http\Livewire\User\Index::class)
        ->name('index')
        ->middleware('can:viewAny,' . \App\Models\User::class);
    Route::get('{user}/edit', \App\Http\Livewire\User\Edit::class)
        ->name('edit');
});
