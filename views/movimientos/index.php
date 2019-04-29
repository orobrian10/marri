<?php

use kartik\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MovimientosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ingresos de Cereal');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="movimientos-index">

    <?= $this->render('/common/_index', [
        'entity' => 'Ingresos de Cereal',
        'entitySing' => 'Cereal',
        'controller' => 'movimientos',
        'columns' => [
            'id_mov',
            [
                'attribute' => 'cer_mov',
                'value' => 'cereales.nom_cer'
            ],
            'fec_cos',
            'car_mov',
            [
                'attribute' => 'ori_mov',
                'value' => 'localidades.nom_loc'
            ],
            [
                'attribute' => 'des_mov',
                'value' => 'acopios.nom_aco'
            ],
            'can_mov',
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
