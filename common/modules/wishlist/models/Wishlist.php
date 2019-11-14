<?php

namespace common\modules\wishlist\models;

use Yii;

/**
 * This is the model class for table "wishlist".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $token
 * @property date $token_expire
 * @property string $model
 * @property string $action
 * @property integer $item_id
 */
class Wishlist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wishlist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['token', 'model', 'item_id'], 'required'],
            [['user_id', 'item_id','type_wish'], 'integer'],
            [['model', 'token'], 'string', 'max' => 255],
            [['token_expire'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'model' => 'Model',
            'item_id' => 'Item ID',
            'type_wish' => 'Type wish',
        ];
    }

    public function getItemModel()
    {

        $model = new $this->model;
        return $model::findOne($this->item_id);



    }


}
