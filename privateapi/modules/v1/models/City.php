<?php

namespace privateapi\modules\v1\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property integer $id
 * @property string $region
 * @property string $description
 */
class City extends \yii\db\ActiveRecord
{

   // const SCENARIO_CREATE = 'create';


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


   /* public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['region', 'description'];

        return $scenarios;
    }*/


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


    public function getSchools()
    {
        return $this->hasMany(School::className(), ['id_city' => 'id']);
    }
}
