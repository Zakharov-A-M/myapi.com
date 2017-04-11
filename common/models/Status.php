<?php

namespace common\models;

use Yii;
use DateTime;
use DateInterval;
use DateTimeInterface;

/**
 * This is the model class for table "status".
 *
 * @property integer $id
 * @property integer $id_user
 * @property string $status
 * @property string $action
 * @property string $date
 *
 * @property User $idUser
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'status', 'action'], 'required'],
            [['id_user'], 'integer'],
            [['date'], 'safe'],
            [['status', 'action'], 'string', 'max' => 255],
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
            'status' => 'Status',
            'action' => 'Action',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
   /* public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }*/


    public static function getDate(){
        $date = new DateTime();
        $current =  $date->modify('+1 hour');
        return $current->format('Y-m-d H:i:s');
    }


    public static function Comparison($date){
        $date = new DateTime($date);

        $date1 = new DateTime();
        $date1 =  $date1->modify('+1 hour');
        $date1 =  $date1->modify('-15 minutes');
        if($date < $date1){
            return 'ofline';
        }
        else return 'online';
      //  $date1 = $date1->format('Y-m-d H:i:s');
        //$interval = $date->diff($date1);
       // return $interval->i;
       // return $date1->format('Y-m-d H:i:s');
    }


}
