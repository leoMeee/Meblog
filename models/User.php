<?php
namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\models\behaviors\TimestampBehavior;
use app\models\queries\UserQuery;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $is_email_verified
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email_confirmation_token
 * @property string $email
 * @property string $auth_key
 * @property integer $role
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    const ROLE_USER = 10;

    /**
     * @var string|null the current password value from form input
     */
    protected $_password;

    /**
     * @return UserQuery custom query class with user scopes
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return array_merge(
            parent::scenarios(),
            [
                'signup' => ['username', 'email', 'password'],
            ]
        );
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'email' => '邮箱',
            'password' => '密码',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'required', 'on' => 'signup'],

            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],

            ['role', 'default', 'value' => self::ROLE_USER],
            ['role', 'in', 'range' => [self::ROLE_USER]],

            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'unique'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'email'],
            ['email', 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * 注册之前
     * -----------
     * 生成"remember me"验证秘钥
     * 生成一个邮箱认证token
     * -----------
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->generateAuthKey();
            $this->generateEmailConfirmationToken();
        }

        return parent::beforeSave($insert);
    }


    /**
     * 注册之后
     * -----------
     * 给用户发送邮箱确认邮件
     * -----------
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            try {
                $params = Yii::$app->params;
                Yii::$app->mail->compose('confirmEmail', ['user' => $this])
                    ->setFrom([$params['support.email'] => $params['support.name']])
                    ->setTo($this->email)
                    ->setSubject('Complete registration with '.Yii::$app->name)
                    ->send();
            } catch (\Exception $e) {
                Yii::warning(
                    'Failed to send confirmation email to new user. No SMTP server configured?',
                    'app\models\User'
                );
            }
        }
        parent::afterSave($insert, $changedAttributes);
    }


    /**
     * 根据给定的ID查询身份
     * @param int|string $id
     * @return null|static
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * 根据token查询身份(未实现)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * 获取当前用户的id
     * @return int|string
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * 获取当前用户的(cookie)认证秘钥
     * @return string
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * 验证给定的(cookie)认证秘钥
     * @param string $authKey
     * @return bool
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * 验证给定的密码
     * @param $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * 设置当前的 password hash
     * @param $password
     * @throws \yii\base\Exception
     */
    public function setPassword($password)
    {
        $this->_password = $password;
        if (!empty($password)) {
            $this->password_hash = Yii::$app->security->generatePasswordHash($password);
        }
    }

    /**
     * 获取当前的用户密码
     * @return null|string
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * 生成cookie验证秘钥 for "remember me"
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * 生成一个邮箱认证token
     * @param bool $save
     * @return bool
     */
    public function generateEmailConfirmationToken($save = false)
    {
        $this->email_confirmation_token = Yii::$app->security->generateRandomString().'_'.time();
        if ($save) {
            return $this->save();
        }
    }

    /**
     * 生成一个密码重置token
     * @param bool $save
     * @return bool
     */
    public function generatePasswordResetToken($save = false)
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString().'_'.time();
        if ($save) {
            return $this->save();
        }
    }

    /**
     * 修改密码并且删除密码重置token
     * @param $password
     * @return bool
     */
    public function resetPassword($password)
    {
        $this->setPassword($password);
        $this->password_reset_token = null;

        return $this->save();
    }

    /**
     * 邮箱认证通过并且删除邮箱认证token
     * @return bool
     */
    public function confirmEmail()
    {
        $this->email_confirmation_token = null;
        $this->is_email_verified = 1;

        return $this->save();
    }
}
