<?php

namespace common\service;
use yii\di\Container;
use common\models\User;

class UserService
{

    public function isEmpty($string)
    {
        if (empty($string)){
            return true;
        }
        return false;
    }



}