<?php

use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AcopiosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Acopios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acopios-index">

    <?= $this->render('/common/_index', [
        'entity' => 'Acopios',
        'entitySing' => 'Acopio',
        'controller' => 'acopios',
        'columns' => [
            'nom_aco',
            [
                'attribute' => 'ubi_aco',
                'value' => 'lugares.nom_lug'
            ],
            [
                'attribute' => 'cer_aco',
                'value' => 'cereales.nom_cer'
            ],
            'lot_aco',
            [
                'attribute' => 'sil_aco',
                'value' => function ($model) {
                    if ($model->sil_aco == '1'):
                        return 'Silos Bolsa';
                    elseif ($model->sil_aco):
                        return 'Silos Propio';
                    else:
                        return '';
                    endif;
                },
                'filter' => ['1' => 'Silo en bolsa', '2' => 'Silo Propio'],
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'options' => ['prompt' => ''],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'width' => '250px'
                    ],
                ],
            ],
            'stock',
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function () {
                        return false;
                    },
                ]],
        ],
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel,
    ]) ?>

</div>
