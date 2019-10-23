<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MyUser extends Model
{
    protected $table = 'myuser';

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'user_group')
            ->using(UserGroup::class)
            ->withPivot('added_to_group', 'valid_before');

    }

    public function scopeUsersValidBefore(Builder $query)
    {
        return $query->whereHas('groups', function ($query) {
            $query->where('valid_before', '<', date('Y-m-d'));
        }
        );
    }
}
