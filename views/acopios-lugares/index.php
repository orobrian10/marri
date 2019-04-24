<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\AcopiosLugaresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ubicaciones de Acopios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acopios-lugares-index">

    <?= $this->render('/common/_index', [
        'entity' => 'Ubicaciones de Acopios',
        'entitySing' => 'Ubicación de Acopio',
        'controller' => 'acopioslugares',
        'columns' => [
            'nom_lug',
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
