<?php
namespace common\models;
use Yii;
use webzop\notifications\Notification;

class Noty extends Notification
{
    const KEY_NEW_ACCOUNT = 'new_account';
    const KEY_RESET_PASSWORD = 'reset_password';
    /**
     * @var \yii\web\User the user object
     */
    public $user;
    public $string;

    /**
     * @inheritdoc
     */
    public function stringUs()
    {

        if ($this->user->email !== NULL) {

            $this->string = Yii::t('app', 'New callback created');

        } else {

            $this->string = Yii::t('app', 'New customer created');
        }
        return $this->string;
    }

    public function getTitle()
    {

        switch ($this->key) {
            case self::KEY_NEW_ACCOUNT:
                return Yii::t('app', '{user} <br/> {string}', ['user' => $this->user->name, 'string' => $this->stringUs()]);
            case self::KEY_RESET_PASSWORD:
                return Yii::t('app', 'Instructions to reset the password');
        }
    }

    /**
     * @inheritdoc
     */
    public function toEmail($channel)
    {

        if ($channel->id == 'email') {
            if (!in_array($this->key, [self::KEY_NEW_ACCOUNT])) {
                return false;
            }
        }


        switch ($this->key) {
            case self::KEY_NEW_ACCOUNT:
                $subject = 'Welcome to MySite';
                $template = 'newAccount';
                break;
            case self::KEY_RESET_PASSWORD:
                $subject = 'Password reset for MySite';
                $template = 'resetPassword';
                break;
        }
        $message = $channel->mailer->compose($template, [
            'user' => $this->user,
            'notification' => $this,
        ]);
        Yii::configure($message, $channel->message);
        $message->setTo($this->user->email);
        $message->setSubject($subject);
        $message->send($channel->mailer);
    }

    public function shouldSend($channel)
    {
        if ($channel->id == 'screen') {
            if (!in_array($this->key, [self::KEY_NEW_ACCOUNT])) {
                return false;
            }
        }
        if ($channel->id == 'email') {
            if (!in_array($this->key, [self::KEY_NEW_ACCOUNT])) {
                return false;
            }
        }
        return true;
    }

    public function getRoute(){
        return ['/users/edit', 'id' => $this->user->id];
    }

    public function getRoute2()
    {
        return ['partner/callback/view', 'id' => $this->user->id];
    }
}