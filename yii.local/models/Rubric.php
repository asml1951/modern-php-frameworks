<?php
/**
 * Created by : alex
 * Date: 06.09.2019
 * Time: 11:12
 */

namespace app\models;


use yii\db\ActiveRecord;

/**
 * class Rubric
 * @package app/models
 *
 * @property int $id
 * @property string $name
 */

class Rubric extends ActiveRecord
{
    public static function tableName()
    {
        return '{{rubric}}';
    }

    public function getArticles()
    {
        return $this->hasMany(Article::class,['rubric' => 'id']);
    }
}