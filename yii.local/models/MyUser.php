<?php


namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class MyUser
 * @package app\models
 */
class MyUser extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{myuser}}';
    }

    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getGroups()
    {
        return $this->hasMany(Group::class, ['id' => 'group_id'])
            ->viaTable('user_group', ['user_id' => 'id']);
    }
}