<?php
namespace common\models;

use common\validators\UsernameValidator;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $email
 * @property string $username
 * @property string $name
 * @property int $type
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 *
 * @property boolean $isAdmin
 */
class User extends ActiveRecord implements IdentityInterface
{
    public const SCENARIO_CREATE = 'create';
    public const SCENARIO_UPDATE = 'update';

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    const TYPE_ADMIN = 1;
    const TYPE_COMMON = 2;

    /**
     * @var $password_user string
     */
    public $password_user;

    /**
     * @var $confirm_password string
     */
    public $confirm_password;

    /**
     * @see \m130524_201442_create_user_table
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
            TimestampBehavior::class,
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //email
            ['email', 'required'],
            ['email', 'string'],
            ['email', 'unique'],
            ['email', 'email'],
            //username
            ['username', 'string'],
            ['username', 'unique'],
            ['username', UsernameValidator::class],
            //name
            ['name', 'required'],
            ['name', 'string'],
            //type
            ['type', 'required'],
//            ['type', 'in', 'range' => array_keys($this->typeValues())],
            //password
            ['password_hash', 'required', 'on' => self::SCENARIO_CREATE],
            ['password_hash', 'string'],
            //password_reset_token
            ['password_reset_token', 'string'],
            //password_user
            ['password_user', 'required', 'on' => self::SCENARIO_CREATE],
            ['password_user', 'string', 'min' => 6],
            //confirm_password
            ['confirm_password', 'required', 'on' => self::SCENARIO_CREATE],
            ['confirm_password', 'compare', 'compareAttribute' => 'password_user', 'message' => 'As senhas não correspondem.'],
            //auth_key
            ['auth_key', 'string'],
            //status
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * @return string
     */
    public static function typeValues($value = null)
    {
        $values = [
            self::TYPE_ADMIN => 'Administrador',
            self::TYPE_COMMON => 'Comum',
        ];

        if ($value !== null) {
            return $values[$value];
        }

        return $values;
    }

    /**
     * @return string[]
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'username' => 'Usuário',
            'name' => 'Nome',
            'type' => 'Tipo de usuário',
            'password' => 'Senha',
            'password_user' => 'Senha',
            'confirm_password' => 'Confirmar Senha',
            'status' => 'Status',
            'created_at' => 'Cadastrado em',
            'updated_at' => 'Atualizado em',
        ];
    }

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
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
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
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
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
     * @return boolean if password provided is valid for current user
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

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    /**
     * @return bool
     */
    public function getIsAdmin()
    {
        return $this->type == self::TYPE_ADMIN;
    }
}
