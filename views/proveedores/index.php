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
                '<div>' . Html::a('Nuevo Proveedor', Url::to(['create']), ['class' => 'btn btn-sm btn-success btn-gridview-menu']) . '</div>'
            ],
        ],
        'pjax' => true,
        'responsive' => true,
        'floatHeader' => false,

    ]); ?>

    <?php Pjax::end(); ?>

</div>
