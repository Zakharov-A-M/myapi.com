<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property integer $id
 * @property integer $id_user_out
 * @property string $messages
 * @property integer $id_user_in
 * @property string $date
 *
 * @property User $idUserOut
 * @property User $idUserIn
 */
class Message extends \yii\db\ActiveRecord
{

   public $count;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           [['count'],'integer'],
            [['messages'], 'required'],
            [['status'],'string'],

            [['messages'], 'string', 'max' => 255],
            [['id_user_out'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user_out' => 'id']],
            [['id_user_in'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user_in' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user_out' => 'Id User Out',
            'messages' => 'Messages',
            'id_user_in' => 'Id User In',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUserOut()
    {
        return $this->hasOne(Messages::className(), ['id_user' => 'id_user_out']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUserIn()
    {
        return $this->hasOne(User::className(), ['id_user' => 'id_user_in']);
    }

    public function getFotos()
    {
        return $this->hasOne(Foto::className(), ['id_user' => 'id_user_in']);
    }

    public function getFotos1()
    {
        return $this->hasOne(Foto::className(), ['id_user' => 'id_user_out']);
    }

    public function getUserinfo()
    {
        return $this->hasOne(Userinfo::className(), ['id_user' => 'id_user_in']);
    }
    public function getUserinfo1()
    {
        return $this->hasOne(Userinfo::className(), ['id_user' => 'id_user_out']);
    }


}
