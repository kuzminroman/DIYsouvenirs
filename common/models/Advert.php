<?php

namespace common\models;

use Yii;
use common\models\Claim;

/**
 * This is the model class for table "advert".
 *
 * @property int $id
 * @property int $product_id
 * @property string $price
 * @property string $date_created
 * @property string $date_updated
 * @property string $date_sale
 * @property int $status
 *
 * @property Product $product
 * @property Claim[] $claims
 */
class Advert extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'advert';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id'], 'required'],
            [['product_id', 'status'], 'integer'],
            [['date_created', 'date_updated', 'date_sale'], 'safe'],
            [['price'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'price' => 'Price',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'date_sale' => 'Date Sale',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClaims()
    {
        return $this->hasMany(Claim::className(), ['advert_id' => 'id']);
    }

    public function geProductName()
    {
        return $this->product ? $this->product->title : '';
    }

    public function beforeSave($insert)
    {
        $dateNow = Yii::$app->formatter->asDate('now', 'php:Y-m-d h:i:s');
        if (parent::beforeSave($insert)) {

            $this->date_created = $dateNow;
            if($this->status == 3) {
                $this->date_sale = $dateNow;
            } elseif($this->status == 1) {
                $this->date_created = $dateNow;
            } elseif($this->status == 2) {
                $this->date_updated = $dateNow;
            }

            return true;
        }
        return false;
    }

    public function getStatus()
    {
        $status = [
            1 => 'Модерация',
            2 => 'Продажа',
            3 => 'Продано',
        ];
        return $status[$this->status];
    }

}
