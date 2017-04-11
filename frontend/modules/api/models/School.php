<?php

namespace frontend\modules\api\models;

use Yii;

/**
 * This is the model class for table "school".
 *
 * @property integer $id
 * @property integer $id_city
 * @property string $name
 * @property integer $kol
 *
 * @property City $idCity
 */
class School extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'school';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_city', 'name', 'kol'], 'required'],
            [['id_city', 'kol'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['id_city'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['id_city' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_city' => 'Id City',
            'name' => 'Name',
            'kol' => 'Kol',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCity()
    {
        return $this->hasOne(City::className(), ['id' => 'id_city']);
    }
}
