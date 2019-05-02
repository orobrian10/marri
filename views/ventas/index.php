<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VentasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ventas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ventas-index">

    <?= $this->render('/common/_index', [
        'entity' => 'Ventas',
        'entitySing' => 'Venta',
        'controller' => 'ventas',
        'columns' => [
            'id_ven',
            'fec_ven',
            [
                'attribute' => 'cer_ven',
                'value' => 'cerVen.nom_cer'
            ],
            'kgs_ven',
            'pkg_ven',
            'pto_ven',
            [
                'attribute' => 'des_ven',
                'value' => 'desVen.nom_aco'
            ],
            'obs_ven',
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
