<?php

use kartik\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MovimientosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Movimientos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="movimientos-index">

    <?php if (Yii::$app->session->hasFlash('success')) { ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('success'); ?>
        </div>
    <?php } ?>

    <?php if (Yii::$app->session->hasFlash('error')) { ?>
        <div class="alert alert-danger">
            <!-- flash message -->
            <?= Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php } ?>

    <?= $this->render('/common/_index', [
        'entity' => 'Movimientos',
        'entitySing' => 'Movimiento',
        'controller' => 'movimientos',
        'columns' => [
            [
                'attribute' => 'tip_mov',
                'value' => function ($model) {
                    if ($model->tip_mov == '1'):
                        return 'Ingresos';
                    elseif ($model->tip_mov == '2'):
                        return 'Retiros';
                    else:
                        return 'Traslados';
                    endif;
                },
                'filter' => ['1' => 'Ingresos', '2' => 'Retiros', '3' => 'Traslados'],
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'options' => ['prompt' => ''],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'width' => '150px'
                    ],
                ],
            ],
            'cod_mov',
            [
                'attribute' => 'cer_mov',
                'value' => 'cereales.nom_cer'
            ],

            [
                'attribute' => 'var_mov',
                'value' => function ($model) {
                    if ($model->variedades['des_var'] != ''):
                        return $model->variedades['des_var'];
                    else:
                        return '';
                    endif;
                }
            ],

            'cos_mov',
            'fec_cos',
            'can_mov',
            [
                'attribute' => 'ori_mov',
                'value' => function ($model) {
                    if ($model->tor_mov == 1):
                        $txt = \app\models\Campos::findOne(['campos.id' => $model->ori_mov]);
                        return $txt->nom_campos . ' (c)';
                    else:
                        $txt = \app\models\Acopios::findOne(['acopios.id_aco' => $model->ori_mov]);
                        return $txt->nom_aco . ' (a)';
                    endif;
                }
            ],
            [
                'attribute' => 'des_mov',
                'value' => function ($model) {
                    if ($model->tde_mov == 1):
                        $txt = \app\models\Campos::findOne(['campos.id' => $model->des_mov]);
                        return $txt->nom_campos . ' (c)';
                    else:
                        $txt = \app\models\Acopios::findOne(['acopios.id_aco' => $model->des_mov]);
                        return $txt->nom_aco . ' (a)';
                    endif;
                }
            ],
            [
                'attribute' => 'car_mov',
                'value' => function ($model) {
                    if (!$model->car_mov):
                        return '';
                    else:
                        return $model->car_mov;
                    endif;
                }
            ],
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
