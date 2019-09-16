<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Advert */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="advert-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_id')->textInput() ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <!--$form->field($model, 'date_created')->widget(\kartik\date\DatePicker::className(), [
        'name' => 'check_issue_date',
        'value' => date('d-M-Y h:i:s', strtotime('+2 days')),
        'options' => ['placeholder' => 'Select issue date ...'],
        'pluginOptions' => [
                'format' => 'yyyy-mm-dd ',
            'todayHighlight' => true
    ]])-->

    <?= $form->field($model, 'status')->dropDownList([1 => 'Модерация', 2 => 'На продаже', 3 => 'Продано']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
