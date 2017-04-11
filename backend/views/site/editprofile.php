<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$session = Yii::$app->session;
?>


<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model_one, 'surname')->textInput(['autofocus' => true, 'value' => $model->userinfo->surname ])->label('Фамилия') ?>

    <?= $form->field($model_one, 'name')->textInput(['value' => $model->userinfo->name])->label('Имя')  ?>

    <?= $form->field($model_one, 'lastname')->textInput(['value' => $model->userinfo->lastname])->label('Отчество')  ?>

    <?= $form->field($model_one, 'city')->textInput(['value' => $model->userinfo->city])->label('Город')  ?>

    <?= $form->field($model_one, 'phone')->textInput(['value' => $model->userinfo->phone])->label('Телефон')  ?>





    <div class="form-group">
        <?= Html::submitButton('Update', ['class' =>  'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
