<?php

namespace common\models;

use Yii;
use common\models\Advert;
use common\models\User;
/**
 * This is the model class for table "claim".
 *
 * @property int $id
 * @property int $user_id
 * @property int $advert_id
 * @property int $status
 * @property string $date_claim
 *
 * @property Advert $advert
 * @property User $user
 */
class Claim extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'claim';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'advert_id'], 'required'],
            [['user_id', 'advert_id', 'status'], 'integer'],
            [['date_claim'], 'safe'],
            [['advert_id'], 'exist', 'skipOnError' => true, 'targetClass' => Advert::className(), 'targetAttribute' => ['advert_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => Yii::t('app', 'User ID'),
            'advert_id' => Yii::t('app','Advert ID'),
            'status' => Yii::t('app', 'Status'),
            'date_claim' => Yii::t('app','Date Claim'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvert()
    {
        return $this->hasOne(Advert::className(), ['id' => 'advert_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->date_claim = Yii::$app->formatter->asDate('now', 'php:Y-m-d H:i:s');
        }
        return true;
    }

    public function getStatusName()
    {
        $statusClaims = [
            1 => 'Новая',
            2 => 'В процессе',
            3 => 'Закрыта',
        ];
        return $statusClaims[$this->status];
    }
}
