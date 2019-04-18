<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AcopiosLugares */

$this->title = Yii::t('app', 'Update Acopios Lugares: {name}', [
    'name' => $model->id_lug,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Acopios Lugares'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_lug, 'url' => ['view', 'id' => $model->id_lug]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="acopios-lugares-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
