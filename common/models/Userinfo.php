<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "userinfo".
 *
 * @property integer $id
 * @property integer $id_user
 * @property string $surname
 * @property string $name
 * @property string $lastname
 * @property string $city
 * @property string $phone
 *
 * @property User $idUser
 */
class Userinfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'userinfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'surname', 'name', 'lastname', 'city', 'phone'], 'required'],
            [['id_user'], 'integer'],
            [['surname', 'name', 'lastname', 'city', 'phone'], 'string', 'max' => 255],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'surname' => 'Surname',
            'name' => 'Name',
            'lastname' => 'Lastname',
            'city' => 'City',
            'phone' => 'Phone',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }*/
}
