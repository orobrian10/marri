<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Acopios */

$this->title = Yii::t('app', 'Update Acopios: {name}', [
    'name' => $model->id_aco,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Acopios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_aco, 'url' => ['view', 'id' => $model->id_aco]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="acopios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'lugares' => $lugares
    ]) ?>

</div>
