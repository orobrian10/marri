<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Proveedores */

$this->title = Yii::t('app', 'Update Proveedores: {name}', [
    'name' => $model->id_pro,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Proveedores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pro, 'url' => ['view', 'id' => $model->id_pro]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="proveedores-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'localidades' => $localidades
    ]) ?>

</div>
