<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Campos */

$this->title = Yii::t('app', 'Modificar Campo: {name}', [
    'name' => $model->nom_campos,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Campos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nom_campos, 'url' => ['view', 'id' => $model->nom_campos]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Modificar');
?>
<div class="campos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'localidades' => $localidades
    ]) ?>

</div>
