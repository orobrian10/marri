<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Proveedores */

$this->title = Yii::t('app', 'Modificar Proveedor: ' . $model->nom_pro, [
    'name' => $model->id_pro,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Proveedores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nom_pro, 'url' => ['view', 'id' => $model->id_pro]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modificar');
?>
<div class="proveedores-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'localidades' => $localidades
    ]) ?>

</div>
