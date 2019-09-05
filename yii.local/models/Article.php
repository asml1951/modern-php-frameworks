<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class Article
 * @package app\models
 *
 * @property int $id
 * @property string $title
 * @property string $subtitle
 * @property string $content
 * @property int $author_id
 */

class Article extends ActiveRecord
{
    public static function tableName()
    {
        return 'news';
    }

    public function getAuthor()
    {
        return $this->hasOne(Author::class,['id' => 'author_id']);
    }


}