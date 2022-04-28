<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAMmodel extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'am_partner_matching';


    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['id', 'email', 'partner_code', 'created_at', 'updated_at'];


}
