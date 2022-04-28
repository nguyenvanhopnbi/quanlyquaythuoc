<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use Laratrust\Models\LaratrustRole;

/**
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Role extends LaratrustRole
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        $flushCache = function ($user) {

            $user->flushCache();
        };

        static::permissionSynced($flushCache);
    }

    public $guarded = ['id'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return Carbon::createFromTimeString($date)->format('d-m-Y H:i:s');
    }
}
