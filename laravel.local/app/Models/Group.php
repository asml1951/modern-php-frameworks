<?php
/**
 * Created by : alex
 * Date: 17.09.2019
 * Time: 14:43
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'group';

    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany(MyUser::class, 'user_group');
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUsersValidBefore(Builder $query)
    {
       return $query->whereHas('users', function ($query) {
            $query->where('valid_before', '<', date('Y-m-d'));
        });
    }
}
