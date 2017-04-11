



<?php
/* @var $model common\models\Messages */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use common\models\User;

$auth = Yii::$app->authManager;
//$authorRole = $auth->getRole('admin');
//var_dump($authorRole->name);
//$authorRole = $auth->getRole($value->authAssignments->auth_item);
//var_dump($authorRole->name);

?>


<div class="chatbox">
    <div class="chatlogs">
        <?php Pjax::begin(); ?>
        <?= Html::a("Обновить", ['site/messager'], ['id' => 'refrash']);?>

       <?php foreach ($post as  $value)
        {
            $session = Yii::$app->session;
            if($value->user->id != $session->get('id'))
            {?>

                <div class="chat friend">
                    <div class="user-photo"><?php   echo '<img src="data:image/png;base64,'.base64_encode($value->fotos->name).'">';?></div>
                        <?php if($value->authAssignments->item_name == 'admin'){ ?>
                            <p class="chat-admin"><?php  echo $value->user->username;?>
                                <o class="left"><?php echo ":   ".$value->mess; ?></o></p>
                       <?php }else{?>
                           <p class="chat-message"><?php  echo $value->user->username;?>
                            <o class="left"><?php echo ":   ".$value->mess; ?></o></p>
                        <?php } ?>

                </div>
            <?php }else{  ?>



                <div class="chat self">
                <div class="user-photo"><?php   echo '<img src="data:image/png;base64,'.base64_encode($value->fotos->name).'">';?></div>
                <?php  if($value->authAssignments->item_name == 'admin'){ ?>
                    <p class="chat-admin"><?php echo $value->user->username; ?>
                        <o class="left"><?php echo ":   ".$value->mess; ?></o></p>
                   <?php }else{?>

                    <p class="chat-message"><?php echo $value->user->username; ?>
                        <o class="left"><?php echo ":   ".$value->mess; ?></o></p>

                    <?php } ?>
                </div>
            <?php }
        }?>
        <?php Pjax::end(); ?>
      <!--  <div class="chat friend">
            <div class="user-photo"></div>
            <p class="chat-message">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
        </div>
        <div class="chat friend">
            <div class="user-photo"></div>
            <p class="chat-message">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
        </div>-->
        
        
        
    </div>

    <div class="chat-form">

        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'mess')->textArea(['autofocus' => true, 'class' => 'textArea'])->label(' ') ?>
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        <?php ActiveForm::end(); ?>

    </div>

</div>



<?php
$script = <<< JS
$(document).ready(function() {
    
            setInterval(function(){ $("#refrash").click(); }, 1000);
          
        
            
            
            
            
          /*  $('.textArea').bind("change keyup input click", function() {
            if (this.value.match(/[^a-zA-Zа-яА-Я ]/g)) {
                this.value = this.value.replace(/[^a-zA-Zа-яА-Я ]/g, '');
            }
        });
            */
          
          
           var $window = $(window)
            window.scroll(0, localStorage.getItem('scrollPosition')|0)
            $window.scroll(function () {
                localStorage.setItem('scrollPosition', $window.scrollTop())
            })
            
            
            
              /*   addEventListener("keydown", function(event) {
                    if (event.keyCode == 13)
                      console.log = "violet";
                  });*/
         
            
            
            
});
JS;
$this->registerJs($script);
?>
