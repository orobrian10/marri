<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\VariedadesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Variedades');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="variedades-index">

    <?= $this->render('/common/_index', [
        'entity' => 'Variedades',
        'entitySing' => 'Variedad',
        'controller' => 'variedades',
        'columns' => [
            'des_var',
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel,
    ]) ?>

</div>
