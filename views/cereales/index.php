<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CerealesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cereales');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cereales-index">

    <?= $this->render('/common/_index', [
        'entity' => 'Cereales',
        'entitySing' => 'Cereal',
        'controller' => 'cereales',
        'columns' => [
            'nom_cer',
            'var_cer',
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel,
    ]) ?>

</div>
