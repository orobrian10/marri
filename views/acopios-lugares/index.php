<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AcopiosLugaresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Acopios Lugares');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acopios-lugares-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'custom-grid'],
        'headerRowOptions' => ['class' => 'custom-grid-header'],
        'rowOptions' => ['class' => 'custom-grid-row'],
        'columns' => [
            'nom_lug',
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
                '<div>'. Html::a('Nuevo Lugar de Acopio', Url::to(['create']), ['class' => 'btn btn-sm btn-success btn-gridview-menu']) .'</div>'
            ],
        ],
        'pjax'=>true,
        'responsive' => true,
        'floatHeader' => false,

    ]); ?>

    <?php Pjax::end(); ?>

</div>
