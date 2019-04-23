<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Localidades */

$this->title = Yii::t('app', 'Crear Localidad');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Localidades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="localidades-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
