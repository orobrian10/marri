<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Acopios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acopios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nom_aco')->textInput(['maxlength' => true]) ?>

    <?php $var = ArrayHelper::map($lugares, 'id_lug', 'nom_lug'); ?>
    <?= $form->field($model, 'ubi_aco')->dropDownList($var, ['prompt' => 'Seleccione Uno']); ?>

    <?= $form->field($model, 'cer_aco')->textInput() ?>

    <?= $form->field($model, 'lot_aco')->textInput() ?>

    <?php $var = ['1' => 'Silo en bolsa', '2' => 'Silo Propio'] ?>
    <?= $form->field($model, 'sil_aco')->dropDownList($var, ['prompt' => 'Seleccione Uno']); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
