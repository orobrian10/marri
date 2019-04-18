<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cereales */

$this->title = Yii::t('app', 'Modificar Cereal: ' . $model->nom_cer, [
    'name' => $model->id_cer,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cereales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nom_cer, 'url' => ['view', 'id' => $model->id_cer]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modificar');
?>
<div class="cereales-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
