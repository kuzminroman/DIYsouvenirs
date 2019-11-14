<?php

namespace common\models;

use Yii;
use yii\db\Exception;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use bscheshirwork\yii2\galleryManager\GalleryBehavior;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $cathegory_id
 * @property string $image_id
 *
 * @property Advert[] $adverts
 * @property Category $cathegory
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    public $imageFile = [];

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['cathegory_id'], 'required'],
            [['cathegory_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['cathegory_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['cathegory_id' => 'id']],
            [['image_id'], 'integer'],
            [['imageFile'], 'file', 'maxFiles' => 4, 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'title' => Yii::t('app','Title'),
            'description' => Yii::t('app', 'Description'),
            'cathegory_id' => Yii::t('app', 'Category'),
            'imageFile' => Yii::t('app', 'Images'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdverts()
    {
        return $this->hasMany(Advert::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCathegory()
    {
        return $this->hasOne(Category::className(), ['id' => 'cathegory_id']);
    }

    public function getViewCategory()
    {
        return $this->cathegory ? $this->cathegory->view : '';
    }

    /*public function beforeSave($insert)
    {
       if (parent::beforeSave($insert)) {
           $this->image_id = $this->imageFile;
       }
       return true;
    }*/

    public function upload()
    {
        foreach ($this->imageFile as $file) {
            $file->saveAs('img/product/' . $file->baseName . '.' . $file->extension);
        }
        return true;
    }
}