<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Claim */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="claim-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'advert_id')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([1 => 'Новая', 2 => 'В процессе', 3 => 'Продано']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
