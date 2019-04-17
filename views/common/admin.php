<?php

use kartik\grid\GridView;
use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\bootstrap\Modal;
use kartik\form\ActiveForm;

$searchModel = $genericSearchModel->getSearchModel();
$dataProvider = $genericSearchModel->search();
$dataProviderExport = $genericSearchModel->search();
$dataProviderExport->setPagination(false);
$filtersModels = $genericSearchModel->getFiltersForm();
$customizeGridModel = $genericSearchModel->getCustomGridForm();
$metrics = $genericSearchModel->getFiltersMetrics();
$columns = $customizeGridModel->columns;
$columnsWithFormats = $customizeGridModel->columnsWithFormats;
$columnsWithExportFormats = $customizeGridModel->columnsWithExportFormats;

$metrics_customize = $metrics;
?>

    <div class="row hidden-sm hidden-md hidden-lg hidden-xl">
        <div class="col-md-12">
            <br>
            <br>
            <p>ABM solo disponible en Desktop</p>
        </div>
    </div>

    <div class="hidden-xs">
        <h1><?= ucfirst($entity) ?></h1>


        <?php $form = ActiveForm::begin([
            'id' => 'form-abm',
            'type' => ActiveForm::TYPE_VERTICAL,
            'formConfig' => ['labelSpan' => 2],
            'method' => 'GET',
            'action' => Url::to([$controller . '/admin']),
            'options' => ['class' => 'abm-form'],
            'fieldConfig' => [
                'showLabels' => false,
            ],
        ]); ?>

        <div class="row">
            <div class="col-md-12">
                <?= $this->render('_filters', [
                    'models' => $filtersModels,
                    'metrics' => $metrics,
                    'form' => $form,
                ]) ?>
            </div>
        </div>
        <br>
        <br>

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'options' => ['class' => 'custom-grid'],
            'headerRowOptions' => ['class' => 'custom-grid-header'],
            'rowOptions' => ['class' => 'custom-grid-row'],
            'columns' => array_merge($columnsWithFormats, [
                [
                    'class' => '\kartik\grid\ActionColumn',
                    'hiddenFromExport' => true,
                    'visible' => $controller != 'suscripcion',
                    'template' => '{ver} ' . ($controller == 'tiposdebecas' ? '{up} {down}' : '') . ' {editar} ' . ($controller == 'becas' && $es_superadmin ? '{aprobar} {rechazar}' : '') . ($controller == 'becas' ? '' : '{eliminar}') . ($controller == 'becas' ? '{archivar} {desarchivar}' : ''),
                    'buttons' => [
                        'up' => function ($url, $model) {
                            if ($model->posicion == 1) {
                                return;
                            }
                            return Html::a('<i id="fa fa-eye" class="fa fa-arrow-up icono-4x text-gray" data-clipboard-text="fa-eye"></i>', Url::to(['up', 'id' => $model->id]), ['title' => 'Subir posición', 'class' => 'action-view']);
                        },
                        'down' => function ($url, $model) {
                            if ($model->getUltimaPosicion() == $model->posicion) {
                                return;
                            }
                            return Html::a('<i id="fa fa-eye" class="fa fa-arrow-down icono-4x text-gray" data-clipboard-text="fa-eye"></i>', Url::to(['down', 'id' => $model->id]), ['title' => 'Subir posición', 'class' => 'action-view']);
                        },
                        'ver' => function ($url, $model) {
                            return Html::a('<i id="fa fa-eye" class="fa fa-eye icono-4x text-gray" data-clipboard-text="fa-eye"></i>', $url, ['title' => 'Ver', 'class' => 'action-view']);
                        },
                        'editar' => function ($url, $model) {
                            return Html::a('<i id="fa fa-pencil" class="fa fa-pencil icono-4x text-gray" data-clipboard-text="fa-pencil"></i>', Url::to(['editar', 'id' => $model->id]), ['title' => 'Editar', 'class' => 'action-update']);
                        },
                        'aprobar' => function ($url, $model) {
                            if ($model->estado != 'En revisión') {
                                return null;
                            }
                            return Html::a('<i id="fa fa-check" class="fa fa-check icono-4x text-gray" data-clipboard-text="fa-check"></i>', Url::to(['cambiardeestado', 'id' => $model->id, 'accion' => 'aprobar']), ['title' => 'Aprobar', 'class' => 'action-approved action-open-modal']);
                        },
                        'rechazar' => function ($url, $model) {
                            if ($model->estado != 'En revisión') {
                                return null;
                            }
                            return Html::a('<i id="fa fa-remove" class="fa fa-remove icono-4x text-gray" data-clipboard-text="fa-remove"></i>', Url::to(['cambiardeestado', 'id' => $model->id, 'accion' => 'rechazar']), ['title' => 'Rechazar', 'class' => 'action-rejected action-open-modal']);
                        },
                        'archivar' => function ($url, $model) {
                            if ($model->estado == 'Archivada') {
                                return null;
                            }
                            return Html::a('<i id="fa fa-trash-o" class="fa fa-trash-o icono-4x text-gray" data-clipboard-text="fa-trash-o"></i>', Url::to(['cambiardeestado', 'id' => $model->id, 'accion' => 'archivar']), ['title' => 'Archivar', 'class' => 'action-archive action-open-modal']);
                        },
                        'desarchivar' => function ($url, $model) {
                            if ($model->estado != 'Archivada') {
                                return null;
                            }
                            return Html::a('<i id="fa fa-rotate-left" class="fa fa-rotate-left icono-4x text-gray" data-clipboard-text="fa-rotate-left"></i>', Url::to(['cambiardeestado', 'id' => $model->id, 'accion' => 'desarchivar']), ['title' => 'Desarchivar', 'class' => 'action-unarchive action-open-modal']);
                        },
                        'eliminar' => function ($url, $model) {
                            return Html::a('<i id="fa fa-trash-o" class="fa fa-trash-o icono-4x text-gray" data-clipboard-text="fa-trash-o"></i>', Url::to(['eliminar', 'id' => $model->id]), ['title' => 'Eliminar', 'class' => 'action-eliminar action-open-modal']);
                        },
                    ],
                ],
            ]),
            'panel' => [
                'before' => $this->render('_customize_grid', [
                    'model' => $customizeGridModel,
                    'columns' => $metrics_customize,
                    'dataProvider' => $dataProvider,
                    'form' => $form,
                    'showStatus' => $controller == 'becas',
                ]),
                'after' => false,
                'heading' => false,
                'footer' => false,
            ],
            'export' => false,
            'toolbar' => [
                [
                    'content' => Html::a('Actualizar', Url::to(['admin']), ['class' => 'btn btn-sm btn-link btn-gridview-menu showLoading']),
                ],
                [
                    'content' => '<div class="export-source">' . ExportMenu::widget([
                            'emptyText' => 'No results',
                            'clearBuffers' => true,
                            'dataProvider' => $dataProviderExport,
                            'columns' => $columnsWithExportFormats,
                            'target' => ExportMenu::TARGET_BLANK,
                            'showConfirmAlert' => false,
                            'showColumnSelector' => false,
                            'filename' => 'arg_' . str_replace(' ', '_', $entity),
                            'exportConfig' => [
                                ExportMenu::FORMAT_HTML => false,
                                ExportMenu::FORMAT_TEXT => false,
                                ExportMenu::FORMAT_PDF => false,
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
                    'content' => $controller == 'suscripcion' ? null : Html::a('Ingresar ' . $entity, Url::to(['create']), ['class' => 'btn btn-sm btn-primary btn-gridview-menu']),
                ],
            ],
            'responsive' => true,
            'floatHeader' => false,
        ]);

        ?>

        <?php ActiveForm::end(); ?>
    </div>


<?php $script = "

$('.export-source .export-full-csv').click(function(e) {
    $('.export-target .export-full-csv').click();
});

$('.export-source .export-full-excel5').click(function(e) {
    $('.export-target .export-full-excel5').click();
});

";

$this->registerJs($script, View::POS_READY); ?>