<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Acopios */

$this->title = Yii::t('app', 'Create Acopios');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Acopios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acopios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'lugares' => $lugares
    ]) ?>

</div>
