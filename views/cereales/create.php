<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cereales */

$this->title = Yii::t('app', 'Nuevo Cereal');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cereales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cereales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
