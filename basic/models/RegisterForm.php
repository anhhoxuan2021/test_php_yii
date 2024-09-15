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
class RegisterForm extends Model
{
    public $fullName;
    public $userNameOrEmail;
    public $password;
    public $confirmPassword;

    private $_register = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and userNameOrEmail are both required
            [['fullName', 'userNameOrEmail','password','confirmPassword'], 'required'],
            // password is validated by validatePassword()
            ['password', 'compare', 'compareAttribute'=>'confirmPassword', 'message'=>"Passwords don't match"],

        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
//    public function validatePassword($attribute, $params)
//    {
//        if (!$this->hasErrors()) {
//            $user = $this->getUser();
//
//            if (!$user || !$user->validatePassword($this->password)) {
//                $this->addError($attribute, 'Incorrect username or password.');
//            }
//        }
//    }

    public function createNewUser()
    {
        if ($this->validate()) {
            $username = $this->userNameOrEmail;
            $fullname = $this->fullName;
            $password = $this->password;
//            print_r($this->userNameOrEmail);
//            print_r($this->fullName); die();
//            $values = [
//                'username' => "test",
//                'fullname' => "test",
//                'password_hash'=>"test"];
            $user = new RegisterActiveRecord();
            $user->username = $username;
            $user->fullname = $fullname;
            $user->password_hash = $password;
            $user->save();

//            if (isset($_POST['FormName'])) {
//                $model->attributes = $_POST['FormName'];
//                if ($model->save()) {
//                    // handle success
//                }
//            }

            return true;
        }
        return false;
    }

}
