<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use Laratrust\Models\LaratrustPermission;

/**
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @method static Builder search(string|int $search)
 */
class Permission extends LaratrustPermission
{
    use HasFactory;

    public $guarded = ['id'];

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */

    protected function serializeDate(DateTimeInterface $date)
    {
        return Carbon::createFromTimeString($date)->format('d-m-Y H:i:s');
    }

    public function scopeSearch(Builder $query, $search): Builder
    {
        return $query->where('id', $search)
            ->orWhere('name', 'like', "%$search%")
            ->orWhere('display_name', 'like', "%$search%")
            ->orWhere('description', 'like', "%$search%");
    }

    /**
     * Permission belongs to Group_permission.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group_permission()
    {
        // belongsTo(RelatedModel, foreignKey = group_permission_id, keyOnRelatedModel = id)
        return $this->belongsTo(group_permission::class, 'id_group_permission', 'id');
    }
}
