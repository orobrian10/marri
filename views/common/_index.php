<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CerealesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Listado');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cereales-index">

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'custom-grid'],
        'headerRowOptions' => ['class' => 'custom-grid-header'],
        'rowOptions' => ['class' => 'custom-grid-row'],
        'columns' => $columns,
        'panel' => [
            'before' => '',
            'after' => false,
            'heading' => false,
            'footer' => '',
        ],
        'toolbar' => [
            [
                'content' => Html::a('Actualizar', './index', ['class' => 'btn btn-sm btn-link btn-gridview-menu showLoading']),
            ],
            [
                'content' => '<div class="export-source">' . ExportMenu::widget([
                        'emptyText' => 'No results',
                        'clearBuffers' => true,
                        'dataProvider' => $dataProvider,
                        'columns' => $columns,
                        'target' => ExportMenu::TARGET_BLANK,
                        'showConfirmAlert' => false,
                        'showColumnSelector' => false,
                        'filename' => 'arg_' . str_replace(' ', '_', $entity),
                        'exportConfig' => [
                            ExportMenu::FORMAT_HTML => false,
                            ExportMenu::FORMAT_TEXT => false,
                            ExportMenu::FORMAT_CSV => false,
                            ExportMenu::FORMAT_PDF => [
                                'label' => 'PDF',
                            ],
                            ExportMenu::FORMAT_EXCEL_X => false,
                            ExportMenu::FORMAT_EXCEL => [
                                'label' => 'Excel',
                            ],
                        ],
                        'dropdownOptions' => [
                            'icon' => 'Exportar',
                            'class' => 'btn-sm btn-link btn-gridview-menu',
                        ],
                    ]) . '</div>',
            ],
            [
                'content' => Html::a('Ingresar ' . $entitySing, Url::to(['create']), ['class' => 'btn btn-sm btn-success btn-gridview-menu'])
            ],
        ],
        'pjax' => true,
        'responsive' => true,
        'panel' => [
            'type' => GridView::TYPE_SUCCESS,
            'heading' => 'Listado de ' . $entity,
            'after' => false,
        ],
        'striped' => true,
        'hover' => true,
    ]); ?>

    <?php Pjax::end(); ?>

</div>
