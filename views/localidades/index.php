<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\LocalidadesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Localidades');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="localidades-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('error')){ ?>
        <div class="alert alert-danger">
            <!-- flash message -->
            <?= Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php } ?>

    <?php if (Yii::$app->session->hasFlash('success')){ ?>
        <div class="alert alert-success">
            <!-- flash message -->
            <?= Yii::$app->session->getFlash('success'); ?>
        </div>
    <?php } ?>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'custom-grid'],
        'headerRowOptions' => ['class' => 'custom-grid-header'],
        'rowOptions' => ['class' => 'custom-grid-row'],
        'columns' => [
            'nom_loc',
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'panel' => [
            'before' => '',
            'after' => false,
            'heading' => false,
            'footer' => '',
        ],
        'toolbar' => [
            ['content'=>
                '<div>'. Html::a('Nueva Localidad', Url::to(['create']), ['class' => 'btn btn-sm btn-success btn-gridview-menu']) .'</div>'
            ],
        ],
        'pjax'=>true,
        'responsive' => true,
        'floatHeader' => false,

    ]); ?>

    <?php Pjax::end(); ?>

</div>

