<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CamposSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Campos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="campos-index">

    <?= $this->render('/common/_index', [
        'entity' => 'Campos',
        'entitySing' => 'Campo',
        'controller' => 'campos',
        'columns' => [
            'nom_campos',
            [
                'attribute' => 'loc_campos',
                'value' => 'localidades.nom_loc',
                'filter' => ArrayHelper::map(\app\models\Localidades::find()->all(), 'id_loc', 'nom_loc'),
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'options' => ['prompt' => ''],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'width' => '250px'
                    ],
                ],
            ],
            'hec_tot_campos',
            'hec_sem_campos',
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel,
    ]) ?>

</div>
