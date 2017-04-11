<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$session = Yii::$app->session;
?>

<h1 align="center">Введите пользователя!</h1>
<div class="container" >




    <?= Html::input('text',null , null, ['id' =>'username','placeholder' => 'Введите пользователя', 'class' => "form-control"]) ?>


</div>

<div class="container">

</div>

