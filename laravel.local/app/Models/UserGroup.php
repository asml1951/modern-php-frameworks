<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Relations\Pivot;

class UserGroup extends Pivot
{
    protected $table = 'user_group';
}
