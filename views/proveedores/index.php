<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProveedoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Proveedores');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proveedores-index">

    <?= $this->render('/common/_index', [
        'entity' => 'Proveedores',
        'entitySing' => 'Proveedor',
        'controller' => 'acopioslugares',
        'columns' => [
            'nom_pro',
            'tel_pro',
            [
                'attribute' => 'loc_pro',
                'value' => 'localidades.nom_loc',
                'filter' => ArrayHelper::map(\app\models\Localidades::find()->all(),'id_loc','nom_loc'),
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'options' => ['prompt' => ''],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'width'=>'auto'
                    ],
                ],
            ],
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