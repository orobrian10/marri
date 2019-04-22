<?php

use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MovimientosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Movimientos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="movimientos-index">

    <?= $this->render('/common/_index', [
        'entity' => 'Movimientos',
        'entitySing' => 'Movimiento',
        'controller' => 'movimientos',
        'columns' => [
            'cod_mov',
            'var_mov',
            'cos_mov',
            'fec_cos',
            'can_mov',
            'ori_mov',
            'des_mov',
            'car_mov',
            [
                'attribute' => 'cer_mov',
                'value' => 'cereales.nom_cer'
            ],
            [
                'attribute' => 'tip_mov',
                'value' => function ($model) {
                    if ($model->tip_mov == '1'):
                        return 'Ingresos';
                    elseif ($model->tip_mov):
                        return 'Retiros';
                    else:
                        return 'Traslados';
                    endif;
                },
                'filter' => ['1' => 'Ingresos', '2' => 'Retiros', '3' => 'Traslados'],
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'options' => ['prompt' => ''],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'width'=>'150px'
                    ],
                ],
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel,
    ]) ?>

</div>
