<?php
namespace console\controllers;

use privateapi\modules\v1\controllers\NasledController;
use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
       $auth->removeAll();





        $user = $auth->createRole('user');
        $author = $auth->createRole('author');
        $admin = $auth->createRole('admin');

        $auth->add($user);
        $auth->add($author);
        $auth->add($admin);



        //PR-manager работа с людьми
       /* $workPeople = $auth->createPermission('Workig with people');
        $workPeople->description = 'Working with people';
        $auth->add($workPeople);*/


        $admin_permission = $auth->createPermission('admin');
        $admin_permission->description = 'admin';
        $auth->add($admin_permission);




       //создание постов - автор
        $createPost = $auth->createPermission('Create Post');
        $createPost->description = 'Create a post';
        $auth->add($createPost);

        //добавляем разрешение "редактирование"  - админ
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        $auth->add($updatePost);


        //назначение ролей

        $auth->addChild($admin, $admin_permission);
        $auth->addChild($author, $createPost);
        $auth->addChild($user, $updatePost);


        // Назначение ролей пользователям. 1 и 2 и 3 это IDs возвращаемые IdentityInterface::getId()

        $auth->assign($user, 3);
        $auth->assign($author, 2);
        $auth->assign($admin, 1);
    }


    public function Delete()
    {


    }



    public function actionAdd($roul, $id)
    {
        if(!empty(Yii::$app->authManager)){

            $auth = Yii::$app->authManager;

            $roulnew= $auth->getRole($roul);
            $auth->assign($roulnew, 3);
            echo 'Role assigned successful';
        }
        else echo 'PIZDA!!!';
    }


}