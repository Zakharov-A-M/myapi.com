<?php

namespace api\controllers;

use yii\rest\ActiveController;


class CityController extends ActiveController
{
    public $modelClass = 'api\models\City';

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        echo $action;
        return false;
    }
}