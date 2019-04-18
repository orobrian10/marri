<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AcopiosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Acopios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acopios-index">

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
            'nom_aco',
            [
                'attribute' => 'ubi_aco',
                'value' => 'lugares.nom_lug'
            ],
            'cer_aco',
            'lot_aco',
            [
                'attribute' => 'sil_aco',
                'value' => function ($model) {
                    if ($model->sil_aco == '1'):
                        return 'Silos Bolsa';
                    elseif ($model->sil_aco):
                        return 'Silos Propio';
                    else:
                        return '';
                    endif;
                },
                'filter' => ['1' => 'Silo en bolsa', '2' => 'Silo Propio'],
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'options' => ['prompt' => ''],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'width'=>'250px'
                    ],
                ],
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'panel' => [
            'before' => '',
            'after' => false,
            'heading' => false,
            'footer' => '',
        ],
        'toolbar' => [
            ['content' =>
                '<div>' . Html::a('Nuevo Acopio', Url::to(['create']), ['class' => 'btn btn-sm btn-success btn-gridview-menu']) . '</div>'
            ],
        ],
        'pjax' => true,
        'responsive' => true,
        'floatHeader' => false,

    ]); ?>

    <?php Pjax::end(); ?>

</div>
