<?php
use yii\helpers\Html;
?>
<p>Вы ввели следующую информцию</p>
<ul>
    <li><label>Имя</label>: <?=Html::encode($test->name)?></li>
    <li><label>Почта</label>: <?=Html::encode($test->email)?></li>
</ul>
