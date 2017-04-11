<?php

namespace api\modules\v1\controllers;

use api\modules\v1\models\City;
use Yii;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\web\Response;
use api\modules\v1\models\School;
use yii\rest\ActiveController;

class SchoolController extends ActiveController
{

    /*public function ViewSchool(){
        $schools = School::find()->all();
        return $schools;
    }


    public function ViewCity(){
        $cities = City::find()->all();
        return $cities;
    }

    public function ech()
    {
        echo $this->ViewCity();
    }
*/

    public $modelClass = School::class;


    /*public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

//        switch ($action->id){
//            case 'test-show':
//                // проверка на пользователь
//                throw new ForbiddenHttpException('You have no permissions to access this action');
//                break;
//        }

        return true;
    }

    public function actionTestShow()
    {
        return 'hello world!';
    }

    public function actionTest()
    {
        $bodyParams = Yii::$app->request->getBodyParams();
        return $bodyParams;
    }

   // public $enableCsrfValidation = false;
   /* public function actionCities()
    {
       $modelClass = City::class;
    }*/



   /* public function actionCreateCity()
    {
       /* \Yii::$app->response->format=Response::FORMAT_JSON;
        $city = new City();
        $city->scenario = City::SCENARIO_CREATE;
        $city->attributes=\Yii::$app->request->post();


        if($city->validate()){
            $city->save();
            return ['status' => true, 'data' => 'City create successfully!'];
        }
        else{
            return ['status' => false,
            'data' => $city->getErrors(),
            ];
        }

         //return ['status' => true];
       // echo 'first create city in  my api!'; exit;
    }*/

}
