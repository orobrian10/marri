<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VentasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ventas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_ven') ?>

    <?= $form->field($model, 'fec_ven') ?>

    <?= $form->field($model, 'cer_ven') ?>

    <?= $form->field($model, 'kgs_ven') ?>

    <?= $form->field($model, 'pkg_ven') ?>

    <?php // echo $form->field($model, 'pto_ven') ?>

    <?php // echo $form->field($model, 'des_ven') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
