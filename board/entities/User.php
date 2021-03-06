<?php
namespace board\entities;

use phpDocumentor\Reflection\Types\Integer;
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
 * @property string $email_confirm_token
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $last_name
 * @property string $phone
 * @property string $phone_verified
 * @property string $phone_verified_token
 * @property string $phone_verified_token_expire
 * @property string $code
 * @property string $role
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_WAIT = 0;
    const STATUS_ACTIVE = 10;
    const STATUS_NOT_PHONE_VERIFIED = 0;
    const STATUS_SUCCESS_PHONE_VERIFIED = 1;
    const EMPTY_CODE = null;

    public static function signup($username, $email, $password, $role)
    {
        $user = new static();
        $user->username = $username;
        $user->email = $email;
        $user->setPassword($password);
        $user->created_at = time();
        $user->status = self::STATUS_WAIT;
        $user->generateEmailConfirmToken();
        $user->generateAuthKey();
        $user->role = $role;
        return $user;
    }

    public function edit(string $username, string $email, $status, $role): void
    {
        $this->username = $username;
        $this->email = $email;
        $this->status = $status;
        $this->role = $role;
        $this->updated_at = time();
    }

    public function editUsername(string $username, string $last_name)
    {
        $this->username = $username;
        $this->last_name = $last_name;
    }

    public function editPhone($phone)
    {
        $this->phone = $phone;
    }

    public function clearPhoneVerification()
    {
        $this->phone_verified = self::STATUS_NOT_PHONE_VERIFIED;
    }

    public function phoneVerification()
    {
        $this->phone_verified = self::STATUS_SUCCESS_PHONE_VERIFIED;
    }

    public function clearCode()
    {
        $this->code = self::EMPTY_CODE;
        $this->phone_verified_token = self::EMPTY_CODE;
        $this->phone_verified_token = self::EMPTY_CODE;
    }

    public static function guestOrOther($id)
    {
        if(Yii::$app->user->isGuest || Yii::$app->user->identity->id != $id){
            return false;
        }else{
            return true;
        }
    }

    public function generatePhoneVerifiedCode($code)
    {
        $this->code = $code;
        if($this->code != null){
            $this->phone_verified_token = time();
            $this->phone_verified_token_expire = time() + 600;
        }
    }

    //For admin generate user
    public static function create($username, $email, $password)
    {
        $user = new static();
        $user->username = $username;
        $user->email = $email;
        $user->setPassword($password);
        $user->created_at = time();
        $user->status = self::STATUS_ACTIVE;
        $user->generateAuthKey();
        return $user;
    }

    public static function fakerCreate($username, $email, $password, $status)
    {
        $user = new static();
        $user->username = $username;
        $user->email = $email;
        $user->setPassword($password);
        $user->created_at = time();
        $user->status = $status;
        $user->generateAuthKey();
        return $user;
    }

    public function confirmSignup()
    {
        if (!$this->isWait()) {
            throw new \DomainException('Пользователь уже активирован.');
        }
        $this->status = self::STATUS_ACTIVE;
        $this->email_confirm_token = null;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isWait(): bool
    {
        return $this->status === self::STATUS_WAIT;
    }

    public function isPhoneVerified()
    {
        if($this->phone && $this->phone_verified == 0){
            return false;
        } else {
            return true;
        }
    }

    public function isCodeExpier()
    {
        if (time() > $this->phone_verified_token_expire) {
            return true;
        } else {
            return false;
        }
    }

    public function requestPasswordReset()
    {
        if (!empty($this->password_reset_token) && self::isPasswordResetTokenValid($this->password_reset_token)) {
            throw new \DomainException('Сброс пароля уже запрошен.');
        }
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function resetPassword($password)
    {
        if (empty($this->password_reset_token)) {
            throw new \DomainException('Сброс пароля ещё не запрошен.');
        }
        $this->setPassword($password);
        $this->password_reset_token = null;
    }


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
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

    private function generateEmailConfirmToken()
    {
        $this->email_confirm_token = Yii::$app->security->generateRandomString();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
