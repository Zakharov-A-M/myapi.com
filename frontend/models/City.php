<?php

namespace app\models;

use \yii\db\ActiveRecord;

class City extends ActiveRecord
{

    public static function tableName()
    {
        return 'city';
    }


    public static function primaryKey()
    {
        return ['id'];
    }


    public function rules()
    {
        return [
            [['id', 'region', 'description'], 'required']
        ];
    }
}