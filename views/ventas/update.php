<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ventas */

$this->title = Yii::t('app', 'Modificar Venta', [
    'name' => $model->id_ven,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ventas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_ven, 'url' => ['view', 'id' => $model->id_ven]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ventas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
