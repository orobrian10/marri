<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\Campos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="campos-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'nom_campos')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-lg-3">
            <?php $var = ArrayHelper::map($localidades, 'id_loc', 'nom_loc'); ?>
            <?= $form->field($model, 'loc_campos')->dropDownList($var, ['prompt' => 'Seleccione Uno']); ?>
        </div>

        <div class="col-lg-3">
            <?= $form->field($model, 'hec_tot_campos')->textInput() ?>
        </div>

        <div class="col-lg-3">
            <?= $form->field($model, 'hec_sem_campos')->textInput() ?>
        </div>

        <div class="col-lg-12 text-right">
            <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success btn-sm']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
