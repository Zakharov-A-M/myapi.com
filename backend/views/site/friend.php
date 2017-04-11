<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use common\models\Status;
use yii\widgets\Pjax;
$session = Yii::$app->session;
?>




<?php
   // foreach ($mess as $mes)
    Pjax::begin();?>

<?= Html::a('Обновить', ['site/friend'], ['id' => 'refresh1']); ?>
<?php
    foreach ($post as $value) {

        if ($value->id != $session->get('id'))
             foreach ($mess as $mes) {
                 if ($value->id == $mes["id_user_out"]) {

                     ?>

                         <div class="message">
                             <a href="profile?id=<?php echo $value->id ?>">

                                 <div class="message-picture">
                                     <?php echo '<img src="data:image/png;base64,' . base64_encode($value->fotos->name) . '" alt="user" class="img-circle img-responsive" width="80" height="80">'; ?>
                                 </div>
                             </a>
                             <div class="message-top-container">
                                 <div class="message-top">
                                     <div class="message-author">
                                         <?= Html::a($value->userinfo->surname . ' ' . $value->userinfo->name, ['site/profile', 'id' => $value->id]) ?>
                                         <div class="kol-message"><?= $mes["COUNT(*)"] ?></div>
                                     </div>

                                     <div class="timeago">
                                         <?= Html::a('Написать сообщение', ['site/newmessage', 'id' => $value->id], ['class' => 'btn btn-info']) ?>
                                     </div>
                                 </div>
                             </div>
                             <div class="message-container">
                                 <div class="message-message">
                                     <?php echo $value->userinfo->city;  ?>
                                     <?php echo Status::Comparison($value->statuss->date);?>
                                 </div>
                             </div>
                         </div>

                     <?php
                  break;
                 } else { ?>
                             <div class="message">
                                 <a href="profile?id=<?php echo $value->id ?>">
                                     <div class="message-picture">
                                         <?php echo '<img src="data:image/png;base64,' . base64_encode($value->fotos->name) . '" alt="user" class="img-circle img-responsive" width="80" height="80">'; ?>
                                     </div>
                                 </a>
                                 <div class="message-top-container">
                                     <div class="message-top">
                                         <div class="message-author">
                                             <?= Html::a($value->userinfo->surname . ' ' . $value->userinfo->name, ['site/profile', 'id' => $value->id]) ?>

                                         </div>

                                         <div class="timeago">
                                             <?= Html::a('Написать сообщение', ['site/newmessage', 'id' => $value->id], ['class' => 'btn btn-info']) ?>
                                             <?php echo Status::Comparison($value->statuss->date);?>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="message-container">
                                     <div class="message-message">
                                         <?php echo $value->userinfo->city; ?>

                                     </div>
                                 </div>
                             </div>

                     <?php break;
                 }
             }
    }

        Pjax::end();
?>



<style>
    #refresh1{
        visibility: hidden;
    }
</style>



<?php
$script = <<< JS
$(document).ready(function() {
    setInterval(function(){ $("#refresh1").click(); }, 1000);
});
JS;
$this->registerJs($script);
?>
