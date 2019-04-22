<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MovimientosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="movimientos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_mov') ?>

    <?= $form->field($model, 'cod_mov') ?>

    <?= $form->field($model, 'var_mov') ?>

    <?= $form->field($model, 'cos_mov') ?>

    <?= $form->field($model, 'fec_cos') ?>

    <?php // echo $form->field($model, 'can_mov') ?>

    <?php // echo $form->field($model, 'ori_mov') ?>

    <?php // echo $form->field($model, 'des_mov') ?>

    <?php // echo $form->field($model, 'car_mov') ?>

    <?php // echo $form->field($model, 'cer_mov') ?>

    <?php // echo $form->field($model, 'tip_mov') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
