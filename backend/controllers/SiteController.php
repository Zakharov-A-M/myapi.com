<?php
namespace backend\controllers;

use common\models\AuthItem;
use phpDocumentor\Reflection\Types\Null_;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;
use yii\web\UploadedFile;
use common\models\Foto;
use yii\web\NotFoundHttpException;
use common\models\Messages;
use common\models\Message;
use yii\db\Command;
use DateTime;
use DateInterval;
use common\models\Status;
$session = Yii::$app->session;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */




    public function behaviors()
    {
        return [
           /* 'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'logout', 'index', 'logout', 'foto', 'messager', 'profile'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['foto'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],*/
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }



    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;
        if ($session->has('username')){
            $model = Status::find()->where(['id_user' => $session->get('id')])->one();
            $model->id_user = $session->get('id');
            $model->action = Yii::$app->controller->action->id;
            $model->status = 'online';
            $model->date = Status::getDate();
            if($model->save()){
                return $this->render('index',[
                    'date' => Status::getDate(),
                ]);
            }
            else print_r($model->errors);
            die;

        }
        return $this->redirect(['login']);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {

        $session = Yii::$app->session;
        if ($session->has('username')){
            return $this->render('index');
        }

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            $user = $model->username;
            $pass_hash = User::setPasswordd($model->password);
            if(User::Isseting($user, $pass_hash)){
                $user = $model->username;
                $session->set('username', $user);
                $idi = User::find()->where(['username' => $model->username])->one();
                $session->set('id', $idi->id);
                return $this->redirect(['index']);
            }
            else {
                return $this->render('login', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        $session = Yii::$app->session;
        $session->remove('username');
        Yii::$app->user->logout();
      return $this->redirect(['login']);
    }



    public function actionFoto()
    {

        $session = Yii::$app->session;
        $model = Status::find()->where(['id_user' => $session->get('id')])->one();
        $model->id_user = $session->get('id');
        $model->action = Yii::$app->controller->action->id;
        $model->status = 'online';
        $model->date = Status::getDate();
        if($model->save()) {
            $model = new Foto();

            if (!empty($_FILES)) {
                if (Foto::findModel($session->get('id'))) {
                    $model = Foto::findModel($session->get('id'));
                }
                $post = file_get_contents($_FILES['Foto']['tmp_name']['name']);
                $model->id_user = $session->get('id');
                $model->name = $post;
                if ($model->save()) {

                    return $this->render('index', [
                        'post' => $post,
                    ]);
                } else {
                    return $this->render('foto', [
                        'model' => $model,
                    ]);
                }
            } else {
                return $this->render('foto', [
                    'model' => $model,
                ]);
            }
        }

    }




    public function actionMessager(){
        $session = Yii::$app->session;
        $model = Status::find()->where(['id_user' => $session->get('id')])->one();
        $model->id_user = $session->get('id');
        $model->action = Yii::$app->controller->action->id;
        $model->status = 'online';
        $model->date = Status::getDate();
            if($model->save()) {
                $model = Status::find()->where(['id_user' => $session->get('id')])->one();
                $model->id_user = $session->get('id');
                $model->action = Yii::$app->controller->action->id;
                $model->status = 'online';
                $model->date = Status::getDate();
                $model = new Messages();
                $a = new User();
                $post = Messages::find()->all();

                if ($model->load(Yii::$app->request->post())) {
                    $model->id_user = $session->get('id');
                    $model->save();
                    $model = new Messages();

                    return $this->render('messager', [
                        'post' => $post,
                        'model' => $model,
                        'a' => $a,
                    ]);
                }
                return $this->render('messager', [
                    'post' => $post,
                    'model' => $model,
                    'a' => $a,
                ]);
            }
    }



    public function actionProfile($id){
        $session = Yii::$app->session;
        $model = Status::find()->where(['id_user' => $session->get('id')])->one();
        $model->id_user = $session->get('id');
        $model->action = Yii::$app->controller->action->id;
        $model->status = 'online';
        $model->date = Status::getDate();
        if($model->save()) {
            $model = new Message();
            if (User::find()->where(['id' => $id])->one()) {
                $post = User::find()->where(['id' => $id])->one();
            } else {
                $post = User::find()->where(['id' => $session->get('id')])->one();
            }

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->id_user_out = $session->get('id');
                $model->id_user_in = $id;
                $model->save();
                $model = new Message();
                return $this->redirect(['profile',
                    'id' => $id,
                    'post' => $post,
                    'model' => $model,
                ]);

            } else
                return $this->render('profile', [
                    'id' => $id,
                    'post' => $post,
                    'model' => $model,
                ]);
        }

    }


    public function actionEditprofile($id){
        $session = Yii::$app->session;
        $model = Status::find()->where(['id_user' => $session->get('id')])->one();
        $model->id_user = $session->get('id');
        $model->action = Yii::$app->controller->action->id;
        $model->status = 'online';
        $model->date = Status::getDate();
        if($model->save()) {
            $model_one = new User();
            $session = Yii::$app->session;
            if ($id != $session->get('id')) {
                $id = $session->get('id');
                $model = User::find()->where(['id' => $id])->one();
                return $this->redirect(['editprofile', 'id' => $model->id]);
            }
            $model = User::find()->where(['id' => $id])->one();
            if ($model_one->load(Yii::$app->request->post()) && $model_one->validate()) {

                // $session->set('lolo',  $model->user->email);
                $model->userinfo->surname = $model_one->surname;
                $model->userinfo->name = $model_one->name;
                $model->userinfo->lastname = $model_one->lastname;
                $model->userinfo->city = $model_one->city;
                $model->userinfo->phone = $model_one->phone;
                if ($model->userinfo->save()) {
                    return $this->redirect('profile');
                }
            } else {
                if ($session->has('username')) {
                    return $this->render('editprofile', [
                        'model_one' => $model_one,
                        'model' => $model
                    ]);
                }
                return $this->redirect(['login']);
            }
        }
    }





    public function actionFriend(){
        $time = date('H:i:s');
        $session = Yii::$app->session;
        $model = Status::find()->where(['id_user' => $session->get('id')])->one();
        $model->id_user = $session->get('id');
        $model->action = Yii::$app->controller->action->id;
        $model->status = 'online';
        $model->date = Status::getDate();
            if($model->save()) {
                $post = User::find()->all();
                $params = [':id' => $session->get('id'), ':status' => 'unread'];
                $mess = Yii::$app->db->createCommand('SELECT  COUNT(*), id_user_out, messages, id_user_in   FROM Message  WHERE status = :status and id_user_in = :id GROUP BY(id_user_out) ')->bindValues($params)->queryAll(); //Message::find()->select("")->where(['status' => 'unread', 'id_user_in' => $session->get('id')])->groupBy('id_user_out')->all();

                $model = new Message();
                if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                    $model->id_user_out = $session->get('id');
                    $model->save();
                    $model = new Message();
                    return $this->redirect(['friend',
                        'post' => $post,
                        'model' => $model,
                        'mess' => $mess
                    ]);
                } else   return $this->render('friend', [
                    'post' => $post,
                    'model' => $model,
                    'mess' => $mess,
                    'time' => $time,
                ]);
        }
    }




    public function actionNewmessage(){
        $session = Yii::$app->session;
        $model = Status::find()->where(['id_user' => $session->get('id')])->one();
        $model->id_user = $session->get('id');
        $model->action = Yii::$app->controller->action->id;
        $model->status = 'online';
        $model->date = Status::getDate();
        if($model->save()) {
            $id = Yii::$app->request->get('id');


            $time = date('H:i:s');
            Yii::$app->controller->layout = 'index';
            $post = Message::find()->Orwhere(['id_user_in' => $session->get('id'), 'id_user_out' => $id])->Orwhere(['id_user_in' => $id, 'id_user_out' => $session->get('id')])->OrderBy(['date' => SORT_ASC])->all();
            $model = new Message();

            if (Yii::$app->request->post()) {
                if (Yii::$app->request->post('message')) {
                    $message = Yii::$app->request->post('message');
                    $model->messages = $message;
                    $session->set('messages', $model->messages);
                    $model->id_user_out = $session->get('id');
                    $model->id_user_in = Yii::$app->request->post('id'); //Yii::$app->request->get('id');
                    if ($model->save()) {
                        /* $model = new Message();
                         $post = Message::find()->Orwhere(['id_user_in' => $session->get('id'), 'id_user_out' => $id])->Orwhere(['id_user_in' => $id,'id_user_out' => $session->get('id')])->all();
                         return $this->render('newmessage',[
                             'post' => $post,
                             'model' => $model,
                             'time' => $time,
                             ]);*/
                        return $message;
                    }
                }
                if (Yii::$app->request->post('id')) {
                    $kol_unread = Message::find()->where(['id_user_in' => $session->get('id'), 'id_user_out' => Yii::$app->request->post('id'), 'status' => 'unread'])->all();
                    foreach ($kol_unread as $posts) {
                        $posts->status = 'read';
                    }
                    if ($posts->save()) {
                        return $message;
                    }

                }

            }

            return $this->render('newmessage', [
                'post' => $post,
                'model' => $model,
                'time' => $time,
            ]);
        }
    }




    public function actionSearch(){
        $session = Yii::$app->session;
        $model = Status::find()->where(['id_user' => $session->get('id')])->one();
        $model->id_user = $session->get('id');
        $model->action = Yii::$app->controller->action->id;
        $model->status = 'online';
        $model->date = Status::getDate();
        if($model->save()) {
            $model = new User();
            return $this->render('search', [
                'model' => $model,
            ]);
        }
    }



}
