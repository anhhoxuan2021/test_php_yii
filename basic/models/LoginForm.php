<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\RegisterActiveRecord;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class LoginForm extends Model
{
    public $userName;
    public $password1;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['userName', 'password1'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password1', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (empty($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
//            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
            $get= RegisterActiveRecord::model()->find(array(
                'select'=>'id',
                'condition'=>'postID=:postID',
                'params'=>array(':postID'=>10),
            ));

        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
//    public function getUser()
//    {
//        if ($this->_user === false) {
//            $this->_user = User::findByUsername($this->userName);
//        }
//
//        return $this->_user;
//    }
}
