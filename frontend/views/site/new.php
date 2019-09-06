<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<?php
$this->title = 'New';
$this->params['breadcrumbs'][] = $this->title;

$field = ActiveForm::begin(['id' => 'pop']);
?>
<div class="site-login">
    <h1><?=Html::encode($this->title)?></h1>
    <?=$field->field()?>
</div>