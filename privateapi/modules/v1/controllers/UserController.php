<?php

namespace privateapi\modules\v1\controllers;


use common\models\User;
//use api\modules\v1\models\User;
use privateapi\modules\v1\exception\SingException;
use Yii;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBasicAuth;
use yii\web\ForbiddenHttpException;
use yii\web\Response;
use yii\rest\ActiveController;
use yii\db\ActiveRecord;
use privateapi\modules\v1\controllers\NasledController;

class UserController extends NasledController
{
    public $modelClass = User::class;


         /* public function behaviors(){
              //  $behaviors = parent::behaviors();
                $behaviors['authenticator']['class'] = HttpBasicAuth::className();
                $behaviors[ 'access'] = [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'actions'=>['sing'],
                            'roles' => ['Admin'],
                        ],
                        [
                            'allow' => true,
                            'actions'=>['login'],
                            'roles' => ['user'],
                        ],
                    ],
                ];
                $behaviors['authenticator']['auth'] = function ($username, $password) {
                    $user =  User::findOne([
                        'username' => $username,
                        'password_hash' => User::setPasswordd($password),
                    ]);

                    if(!$user){
                        throw new SingException('ERROR!!!');
                    }


                    return $user;
                };


                return $behaviors;
            }*/


        public function blabla()
        {
            parent::behaviors();
        }


    public function actionSing()
       {

           $model = new User();
           if ($model->validate())
           {
               $model->username = Yii::$app->request->post('username');
               $count = User::find()->where(['username' => $model->username])->count();
               if($count >= 1) {
                   throw new SingException('Exception!! User has many in BD');
               }
                   $model -> password_hash = User::setPasswordd(Yii::$app->request->post('password'));
                   $model->generateAuthKey();
                   $model->email = Yii::$app->request->post('email');
                   if ($model->save()) {
                       $auth = Yii::$app -> authManager;
                       $auth -> assign($auth -> getRole('user'), $model -> id);
                       echo 'We save data in DB';
                   } else  throw new SingException('Dont save yous date in BD');

           }
           else throw new SingException('Dont save yous date in BD');

       }



    public function actionLogin()
    {
        $model = new User();
        $pass = User::setPasswordd(Yii::$app->request->post('password'));

        $model->username = Yii::$app->request->post('username');

        $post = User::find()->where(['username' =>  $model->username])->one();
        if($post['password_hash'] == $pass)
        {
            echo 'You in company!<br>';
            echo 'Username : '.$post[username];
            echo '<br>';
            echo 'Email : '.$post['email'];
            echo '<br>Status :' .$post['status'];
        }
        else {
                throw new SingException('Dont login in BD');
             }
    }



}