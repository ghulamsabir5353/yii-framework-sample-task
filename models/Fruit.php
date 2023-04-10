<?php

namespace app\models;

use yii\db\ActiveRecord;

class Fruit extends ActiveRecord
{
    public static function tableName()
    {
        return 'fruits';
    }

    public function rules()
    {
        return [
            [['name', 'family', 'genus', 'order'], 'required'],
            [['created_at'], 'integer'],
            [['name', 'family', 'genus', 'order'], 'string', 'max' => 255],
        ];
    }

    public function getFavorites()
    {
        return $this->hasMany(Favorite::class, ['fruit_id' => 'id']);
    }
}
