<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Campos */

$this->title = Yii::t('app', 'Crear Campo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Campos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="campos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'localidades' => $localidades
    ]) ?>

</div>
