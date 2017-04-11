<?php

namespace common\models;
use yii\web\UploadedFile;

use Yii;

/**
 * This is the model class for table "foto".
 *
 * @property integer $id
 * @property integer $id_user
 * @property integer $name
 *
 * @property User $idUser
 */
class Foto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'foto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user'], 'integer'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
            [['name'], 'file'],
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
            'name' => 'Name',
            'file' => 'file',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */


    public static function findModel($id)
    {
        if (($model = Foto::find()->where(['id_user' => $id])->one()) !== null) {
            return $model;
        } else {
            return 0;
        }
    }





}
