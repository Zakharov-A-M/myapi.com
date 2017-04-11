<?php

namespace api\modules\v1\controllers;



use common\models\Foto;
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

class UserController extends ActiveController
{
    public $modelClass = User::class;


       public function actionSing()
       {
           $model = new User();
           //if ($model->validate())
           // {


           $model->username = Yii::$app->request->post('username');
           $count = User::find()->where(['username' => $model->username])->count();
           if ($count >= 1) {
               throw new SingException('Exception!! User has many in BD');
           }
           $model->password_hash = User::setPasswordd(Yii::$app->request->post('password'));
           $model->auth_key = Yii::$app->security->generateRandomString();
          // $post =  $model->auth_key;
           $post =  $model->email = Yii::$app->request->post('email');
           if ($model->save()) {
               echo 'We save data in DB';
           } else  {
               return $post;
           }

               //throw new SingException('Dont save yous date in BD!');

      // }
          // else throw new SingException('Dont save yous date in BD');

       }



    public function actionLogin()
    {
        $model = new User();
        $pass = User::setPasswordd(Yii::$app->request->post('password'));

        $model->username = Yii::$app->request->post('username');

        $post = User::find()->where(['username' =>  $model->username])->one();
        if($post['password_hash'] == $pass)
        {
            return $post;
        }
        else {
                throw new SingException('Dont login in BD');
             }
    }


    public function actionSearch(){
        $username = Yii::$app->request->GET('username');
        $user = User::find()->where(['like','username',$username])->all();

        foreach ($user as $value)
        {
            $userid[] = $value->id;
            $usernames[] = $value->username;
            $surname[] = $value->userinfo->surname;
            $name[] = $value->userinfo->name;
            $lastname[] = $value->userinfo->lastname;
        }

        return [$userid, $usernames, $surname, $name, $lastname];

        /*for($i = 0; $i<count($user); ++$i){
            $userinfo[] = Userinfo::find()->where(['id_user' => $user[$i]->id])->all();
            $userfoto[$i] = Foto::find()->where(['id_user' => $user[$i]->id])->all();
        }*/

            return $userinfo;


    }



}