<?php
namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class TestForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'name'),
        ];
    }
}
