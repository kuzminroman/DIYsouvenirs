<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ClaimSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Html::encode(Yii::t('app','Claims'));
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="claim-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app','Create Claim'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'advert_id',
            [
                'attribute' => 'status',
                'content' => function($data){
                    return $data->getStatusName();
                }
            ],
            'date_claim',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
