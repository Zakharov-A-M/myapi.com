<?php

namespace api\modules\v1\controllers;



use common\models\User;
//use api\modules\v1\models\User;
use api\modules\v1\exception\SingException;
use common\models\Userinfo;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\FormatConverter;
use yii\web\ForbiddenHttpException;
use yii\web\Response;
use yii\rest\ActiveController;
use yii\db\ActiveRecord;
use yii\web\Controller;
use yii\filters\VerbFilter;


class  SearchController extends ActiveController
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }


    public function actionSearch(){
        $username = Yii::$app->request->get('username');
        $model = User::find()->where(['like','username',$username])->all();
        if(empty($model)){
            return $model;
        }
        else {
            throw new SingException('Dont user in BD');
        }

    }




}