<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Variedades */

$this->title = Yii::t('app', 'Crear Variedad');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Variedades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="variedades-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
