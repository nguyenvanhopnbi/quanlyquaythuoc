<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

/**
 * @property int $id
 * @property string name
 * @property string email
 */
class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable, HasFactory;

    protected static function boot()
    {
        parent::boot();

        $flushCache = function ($user) {

            $user->flushCache();
        };

        static::roleSynced($flushCache);

        static::permissionSynced($flushCache);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
