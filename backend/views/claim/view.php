<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Claim */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Claims', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="claim-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app','Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app','Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            [
                'label' => Yii::t('app', Yii::t('app', 'Advert')),
                'format' => 'raw',
                'value' => function($data){
                    return Html::a(
                            $data->id, \yii\helpers\Url::to(['advert/view', 'id' => $data->advert->id]),
                        [
                            'style'=>'text-decoration: underline;',
                            'class' => 'profile-link',
                            'target' => '_blank',
                        ]
                    );
                }
            ],
            [
                'label' => Yii::t('app','Status'),
                'value' => function($data) {
                    return $data->getStatusName();
                }
            ],

            'date_claim',
        ],
    ]) ?>

</div>
