<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AcopiosLugares */

$this->title = Yii::t('app', 'Crear Lugar de Acopio');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lugares de Acopios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acopios-lugares-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
