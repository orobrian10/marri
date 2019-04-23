<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Localidades */

$this->title = Yii::t('app', 'Modificar Localidad: {name}', [
    'name' => $model->id_loc,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Localidades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_loc, 'url' => ['view', 'id' => $model->id_loc]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modificar');
?>
<div class="localidades-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
