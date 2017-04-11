<?php

namespace privateapi\modules\v1;

/**
 * api module definition class
 */

use yii\filters\auth\HttpBasicAuth;
class Privateapi extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'privateapi\modules\v1\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }



}
