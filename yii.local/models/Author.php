<?php

namespace app\models;


use yii\db\ActiveRecord;

/**
 * Class Author
 * @package app\models
 *
 * @property int $id
 * @property string $name
 * @property string $email
 */

class Author extends ActiveRecord
{
    public static function tableName()
    {
        return 'author';
    }

    public function getNews()
    {
        return $this->hasMany(Article::class,['author_id' => 'id']);
    }
}