<?php

namespace app\models;

use yii\db\ActiveRecord;

class Favorite extends ActiveRecord
{
    public static function tableName()
    {
        return 'favorites';
    }

    public function rules()
    {
        return [
            [['user_id', 'fruit_id'], 'required'],
            [['user_id', 'fruit_id'], 'integer'],
        ];
    }

    public function getFruit()
    {
        return $this->hasOne(Fruit::class, ['id' => 'fruit_id']);
    }
}
