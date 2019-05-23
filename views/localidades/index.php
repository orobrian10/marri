<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\LocalidadesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Localidades');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="localidades-index">

    <?= $this->render('/common/_index', [
        'entity' => 'Localidades',
        'entitySing' => 'Localidad',
        'controller' => 'localidades',
        'columns' => [
            'nom_loc',
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