<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Movimientos */

$this->title = Yii::t('app', 'Modificar Movimiento', [
    'name' => $model->id_mov,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Movimientos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_mov, 'url' => ['view', 'id' => $model->id_mov]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modificar');
?>
<div class="movimientos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
