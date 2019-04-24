<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Variedades */

$this->title = Yii::t('app', 'Update Variedades: {name}', [
    'name' => $model->id_var,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Variedades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_var, 'url' => ['view', 'id' => $model->id_var]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="variedades-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
