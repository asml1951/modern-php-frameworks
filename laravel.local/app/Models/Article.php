<?php

namespace App\Models;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

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
 * @property string $rubric_id
 */

class Article extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'article';

    public $timestamps = false;

    /**
     * @return mixed
     */

    public static function getLatestNews()
    {
        return static::whereRaw('DATEDIFF(NOW(), published) < 7 AND ISNULL(arch)')
            ->orderByRaw('DAYOFWEEK(published) Desc, rubric_id ASC')->get();
    }

    /**
     * @param string $date
     * @param array $rubrics
     * @return mixed
     */

    public static function getByDateAndRubric(string $date, array $rubrics)
    {
      return static ::whereRaw('published < ?  AND ISNULL(arch)',[ $date])
                      ->whereIn('rubric_id', $rubrics)
                      ->get();
    }

    public function rubric() {
        return $this->belongsTo('App\Models\Rubric');
    }
}


