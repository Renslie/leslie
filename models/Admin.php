<?php

namespace app\models;
use Yii;

class Admin extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $verifyCode;
    public $roles;
    public $newPassword;
    public $verifyNewPassword;

    public static function tableName() {
        return 'hl_admin';
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->password     = Yii::$app->security->generatePasswordHash($this->password);
                $this->create_time  = time();
                $this->login_time   = time();
            }
            
            return true;
        }
        return false;
    }

    public function attributeLabels() {
        return [
            'username' => '用户名',
            'password' => '密码',
            'phone'    => '手机号码',
            'newPassword'=>'新密码',
            'verifyNewPassword'=>'确认新密码',
            'roles' => '角色',
        ];
    }

    public function rules() {
        return [
            //通用
            [['username', 'password', 'phone'], 'trim'], //去两端空格
            //login
            [['username', 'password'], 'required'], //必填
            ['verifyCode', 'captcha', 'on'=>'login'], //验证码
            ['password', 'validatePassword','on'=>'login'], //调用validatePassword
            ['username', 'string', 'length' => [2, 10],'on'=>'login'], //长度验证
            ['password', 'string', 'length' => [4, 12],'on'=>'login'],

            ['username', 'string', 'length' => [2, 10],'on'=>'user'], //长度验证
            ['password', 'string', 'length' => [5, 12],'on'=>'user'],
            [['password', 'phone', 'roles'], 'required', 'on' => 'user'], //必填

            //修改密码
            [['password', 'newPassword', 'verifyNewPassword'], 'required', 'on' => 'edit'], //必填
            [['password', 'newPassword', 'verifyNewPassword'], 'string', 'length' => [4, 12], 'on' => 'edit'], 
            ['verifyNewPassword', 'compare', 'compareAttribute' => 'newPassword', 'message' => '请输入相同新密码', 'on' => 'edit'], //newPassword与verifyNewPassword是否相同
        ];
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['login'] = ['username', 'password', 'verifyCode'];
        $scenarios['user']  = ['username', 'password', 'roles', 'phone'];
        $scenarios['edit']  = ['password', 'newPassword', 'verifyNewPassword'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
       return static::findOne(['username' => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->admin_id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = static::findByUsername($this->username);

            if (!$user || !\Yii::$app->security->validatePassword($this->password, $user->password)) {
                $this->addError($attribute, '用户名或密码错误');
            }
        }
    }

    public function login() {
        if($this->validate()){
            Yii::$app->user->login(static::findByUsername($this->username));
            return 1;
        }
        return false;
    }

    public function fields() {
        $fields = parent::fields();
        $fields['password'] = function() {
            return '******';
        };
        $fields['roles'] = function() {
            return \yii\helpers\ArrayHelper::getColumn(Yii::$app->authManager->getRolesByUser($this->id), 'name');
        };
        //unset($fields['auth_key'], $fields['access_token']);  //不使用记录登录
        return $fields;
    }

    public function editProfile($id) {
        $user = Admin::findIdentity($id);
        if ($user) {
            if ($this->validate()) {
                if (\Yii::$app->security->validatePassword($this->password, $user->password)) {
                    $user->password = Yii::$app->security->generatePasswordHash($this->newPassword);
                    if ($user->save()) {
                        return true;
                    } else {
                        $this->addError('username', '更新数据出错');
                        return false;
                    }
                } else {
                    $this->addError('password', '旧密码错误');
                    return false;
                }
            } else {
                $this->addError('password', '验证失败');
                return false;
            }
        } else {
            $this->addError('username', '未找到该用户');
            return false;
        }
    }
}
