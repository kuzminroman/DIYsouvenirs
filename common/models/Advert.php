<?php

namespace common\models;

use Yii;

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
}
