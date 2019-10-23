<?php

namespace app\models;

use yii\db\ActiveRecord;

class Group extends ActiveRecord
{
    public static function tableName()
    {
        return '{{group}}';
    }

    public function getMyUsers()
    {
        return $this->hasMany(MyUser::class, ['id' => 'user_id'])
            ->viaTable('user_group', ['group_id' => 'id']);
    }

}