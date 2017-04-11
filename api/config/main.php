<?php
/**
 * Created by PhpStorm.
 * User: Ilya
 * Date: 22.03.2017
 * Time: 11:41
 */

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'),
        require(__DIR__ . '/../../common/config/params-local.php')
        //require(__DIR__ . '/params.php'),
        //require(__DIR__ . '/params-local.php')
 );

 return [
     'id' => 'app-api',
     'basePath' => dirname(__DIR__),
     'bootstrap' => ['log'],
     'modules' => [
             'v1' => [
                 'basePath' => '@app/modules/v1',
                 'class' => 'api\modules\v1\Api'
             ]
     ],
     'components' => [
             'user' => [
                 'identityClass' => 'common\models\User',
             'enableAutoLogin' => false,
         ],
         'log' => [
                 'traceLevel' => YII_DEBUG ? 3 : 0,
             'targets' => [
                     [
                     'class' => 'yii\log\FileTarget',
                     'levels' => ['error', 'warning'],
                 ],
             ],
         ],
         'urlManager' => [
                 'enablePrettyUrl' => true,
             'enableStrictParsing' => true,
             'showScriptName' => false,
             'rules' => [
                     [
                         'class' => 'yii\rest\UrlRule',
                         'controller' => 'v1/city',
                         /*'except' => [
                             'create',
                             'update',
                             'delete'
                         ],*/
                         'extraPatterns' => [
                             'GET test-show' => 'test-show',
                             'POST test' => 'test'
                         ],
                    ],

                    [
                         'class' => 'yii\rest\UrlRule',
                        'controller' => 'v1/school'
                    ],

                    [
                         'class' => 'yii\rest\UrlRule',
                         'controller' => 'v1/user',
                         'extraPatterns' =>[
                             'POST sing' => 'sing',
                             'POST login' => 'login',
                             'GET search' => 'search'
                         ],

                    ],

                             [
                                 'class' => 'yii\rest\UrlRule',
                                 'controller' => 'v1/search',
                                 'extraPatterns' =>[
                                        'POST search' => 'search'
                                    ],
                             ],



             ],
         ]
     ],
    'params' => $params,
];
