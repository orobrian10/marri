<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\LocalidadesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Localidades');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="localidades-index">

    <?php if (Yii::$app->session->hasFlash('error')) { ?>
        <div class="alert alert-danger">
            <!-- flash message -->
            <?= Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php } ?>

    <?= $this->render('/common/_index', [
        'entity' => 'Localidades',
        'entitySing' => 'Localidad',
        'controller' => 'localidades',
        'columns' => [
            'nom_loc',
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel,
    ]) ?>

</div>