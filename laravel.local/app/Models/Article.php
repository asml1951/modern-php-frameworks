<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Article
 * @package App\Models
 *
 * @property int $id
 * @property string $title
 * @property string $subtitle
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 * @property string $arch
 * @property string $rubric
 */

class Article extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news';

    public function author() {
        return $this->belongsTo('App\Models\Author');
    }
}


