<?php
namespace common\models;

use common\service\UserService;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class  User extends ActiveRecord implements IdentityInterface
{
    public $name;
    public $lastname;
    public $surname;
    public $city;
    public $phone;
    public $email;
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    public $password;
    public $container = [];

    /**@var UserService*/
    public $userService;

//   public function __construct(/*UserService $username,*/array $config = [])
//    {
//        parent::__construct($config);
//       // $this->userService = $username;
//    }*/


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'id',
            'username',
            'auth_key',
            'email',
            'password',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['email', 'password', 'username'], 'required'],//,  ,
            [['email'], 'string'],
            [['password_hash', 'auth_key'], 'string'],
            [['surname'], 'string'],
            [['name'], 'string'],
            [['lastname'], 'string'],
            [['city'], 'string'],
            [['phone'], 'string'],
            [['email'], 'string'],
        //   [['username'], 'validateUser'],// 'skipOnEmpty' => false],

            //[['auth_key'], 'string'],

        ];
    }

   /* public function validateUser($attribute, $params)
    {
        if ($this -> userService -> isEmpty($this->username))
        {
            $this-> addError($attribute, 'Поле пустое!!');
        }
        else  $this-> addError($attribute, 'Поле пустое!!');
    }*/


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public static function setPasswordd($password)
    {
         return  hash('sha256',$password);
    }

    public static function Isseting($user, $password_hash){
        $count = User::find()
            ->where(['username' => $user, 'password_hash' => $password_hash])
            ->count();
        if($count > 0){
            return true;
        }

        return false;
    }

    public function Username(){

        return $this->username;
    }


    public function getIduserout()
    {
        return $this->hasOne(Message::className(), ['id_user_out' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */


    public function getFotos()
    {
        return $this->hasOne(Foto::className(), ['id_user' => 'id']);
    }

    public function getMessage()
    {
        return $this->hasOne(Message::className(), ['id_user_in' => 'id']);
    }




    public function getUserinfo()
    {
        return $this->hasOne(Userinfo::className(), ['id_user' => 'id']);
    }



    public function getStatuss()
    {
        return $this->hasOne(Status::className(), ['id_user' => 'id']);
    }


}
