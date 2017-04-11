<?php

namespace common\models;

use Yii;
use common\service\UserService;

/**
 * This is the model class for table "messages".
 *
 * @property integer $id
 * @property integer $id_user
 * @property string $mess
 */
class Messages extends \yii\db\ActiveRecord
{
    public $name;
    public $lastname;
    public $surname;
    public $city;
    public $phone;
    public $email;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user'], 'integer'],
            [['mess'], 'string', 'max' => 255],
            [['surname'], 'string'],
            [['name'], 'string'],
            [['lastname'], 'string'],
            [['city'], 'string'],
            [['phone'], 'string'],
            [['email'], 'string'],


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
            'mess' => 'Mess',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }


    public function getAuthAssignments()
    {
        return $this->hasOne(AuthAssignment::className(), ['user_id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemNames()
    {
        return $this->hasMany(AuthItem::className(), ['name' => 'item_name'])->viaTable('auth_assignment', ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFotos()
    {
        return $this->hasOne(Foto::className(), ['id_user' => 'id_user']);
    }

    public function getUserinfo()
    {
        return $this->hasOne(Userinfo::className(), ['id_user' => 'id_user']);
    }

    public function getIduserout()
    {
        return $this->hasOne(Message::className(), ['id_user_out' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIduserin()
    {
        return $this->hasOne(Message::className(), [ 'id_user_in' => 'id_user']);
    }

}
