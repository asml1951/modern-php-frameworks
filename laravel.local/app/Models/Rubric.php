<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rubric extends Model
{
    protected $table = 'rubric';

    public $timestamps = false;

    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }

}

