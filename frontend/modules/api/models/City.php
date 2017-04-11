<?php

namespace frontend\modules\api\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property integer $id
 * @property string $region
 * @property string $description
 *
 * @property School[] $schools
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region', 'description'], 'required'],
            [['region', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'region' => 'Region',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchools()
    {
        return $this->hasMany(School::className(), ['id_city' => 'id']);
    }
}
