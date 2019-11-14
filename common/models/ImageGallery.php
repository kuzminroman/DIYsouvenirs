<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "image_gallery".
 *
 * @property int $id
 * @property string $title
 * @property string $alt
 * @property string $filePath
 * @property string $modelName
 * @property string $description
 * @property string $gallery_name
 *
 * @property Product[] $products
 */
class ImageGallery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image_gallery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['filePath', 'modelName'], 'required'],
            [['description'], 'string'],
            [['title', 'alt'], 'string', 'max' => 255],
            [['filePath'], 'string', 'max' => 400],
            [['modelName', 'gallery_name'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'alt' => 'Alt',
            'filePath' => 'File Path',
            'modelName' => 'Model Name',
            'description' => 'Description',
            'gallery_name' => 'Gallery Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['image_id' => 'id']);
    }
}
