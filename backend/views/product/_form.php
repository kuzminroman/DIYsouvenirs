<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php /*$form->field($model, 'imageFile[]')->widget(FileInput::classname(), [
        'options' => ['multiple' => true, 'accept' => 'img/product/*'],
    ]);*/?>

    <?= $form->field($model, 'cathegory_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Category::find()->all(), 'id', 'view')) ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
