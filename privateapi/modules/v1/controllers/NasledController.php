<?php
/**
 * Created by PhpStorm.
 * User: Александр Захаров
 * Date: 24.03.2017
 * Time: 16:17
 */

namespace privateapi\modules\v1\controllers;


use yii\filters\AccessControl;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use common\models\User;

class NasledController extends ActiveController
{

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['class'] = HttpBasicAuth::className();
        $behaviors[ 'access'] = [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'allow' => true,
                    'actions'=>['sing'],
                    'roles' => ['admin'],
                ],
                [
                    'allow' => true,
                    'actions'=>['login'],
                    'roles' => ['user'],
                ],
            ],
        ];
        $behaviors['authenticator']['auth'] = function ($authKey, $password) {
            $user =  User::findOne([
                'auth_key' => $authKey,
                'password_hash' => User::setPasswordd($password),
            ]);

            if(!$user){
                throw new SingException('ERROR!!!');
            }


            return $user;
        };


        return $behaviors;
    }

}