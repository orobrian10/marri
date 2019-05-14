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
                'value' => 'localidades.nom_loc'
            ],
            'stock',
            'stock_info',
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
