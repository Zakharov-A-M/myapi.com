<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
use yii\grid\Column ;
use yii\widgets\BaseListView;
use yii\data\Pagination;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' => [


            'id',
            'username',
            'auth_key',
           // 'password_hash',
           // 'password_reset_token',
             'email:email',
             'status',
            // 'created_at',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Действия',
                'headerOptions' => ['width' => '80'],
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url,$model) {
                        return Html::a(
                            '<span class="fa fa-id-card"></span>',
                            $url);
                    },
                    'delete' => function ($url,$model) {
                        return Html::a(
                            '<i class="fa fa-trash"></i>',
                            $url);
                    },
                    'update' => function ($url,$model,$key) {
                        return Html::a(
                            '<i class="fa fa-pencil-square" aria-hidden="true"></i>',
                            $url);
                    },
                ],
            ],
        ],
    ]); ?>

<?php Pjax::end(); ?></div>
