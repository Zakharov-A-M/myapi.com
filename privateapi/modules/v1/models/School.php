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
class School extends \yii\db\ActiveRecord
{

   // const SCENARIO_CREATE = 'create';


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
            'name' => 'Name',
            'kol' => 'Kol',
        ];
    }


    public function getIdCity()
    {
        return $this->hasOne(City::className(), ['id' => 'id_city']);
    }
}
