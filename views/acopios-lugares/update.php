<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AcopiosLugares */

$this->title = Yii::t('app', 'Modificar Lugar de Acopio: {name}', [
    'name' => $model->id_lug,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Acopios Lugares'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nom_lug, 'url' => ['view', 'id' => $model->id_lug]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modificar');
?>
<div class="acopios-lugares-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
