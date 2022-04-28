<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group_permission extends Model
{
    use HasFactory;
    protected $table = 'group_permissions';

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['id', 'group_name'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = false;

    public function permissions()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = group_permission_id, localKey = id)
        return $this->hasMany(Permission::class, 'id_group_permission', 'id');
    }
}
