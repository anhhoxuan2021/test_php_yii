<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
/**
 * This is the model class for table "launch".
 *
 * @property integer $id
 * @property string $username
 * @property string $fullname
 * @property integer $password_hash
 */
class RegisterActiveRecord extends \yii\db\ActiveRecord
{
    const STATUS_REQUEST =0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }
}
