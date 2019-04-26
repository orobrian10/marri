<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Movimientos */

$this->title = Yii::t('app', 'Ingresar cereal');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Movimientos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="movimientos-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
