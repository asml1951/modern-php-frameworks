<?php

namespace app\models;


use yii\db\ActiveRecord;

/**
 * Class Article
 * @package app\models
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property datetime $publshed
 * @property datetime $modified
 * @property string $rubric
 * @property bool $arch
 */

class Article extends ActiveRecord
{
    public static function tableName()
    {
        return '{{article}}';
    }

    public function getArticlerubric()
    {
        return $this->hasOne(Rubric::class,['id' => 'rubric']);
    }

    public static function getLatestArticles()
    {
        return static::find()->where( 'DATEDIFF(NOW(), published) <= 7 
                            AND ISNULL(arch)')
                           ->orderBy(
                               ['DAYOFWEEK(published)' => SORT_DESC,
                                'rubric' => SORT_ASC,
                               ])->all();
    }
    public static function getByDateAndRubric(string $date, array $rubrics)
    {
        return static::find()->where('published < :date', [':date' => $date])
            ->andWhere(['in', 'rubric', $rubrics])
            ->andWhere('ISNULL(arch)')->all();
    }
}