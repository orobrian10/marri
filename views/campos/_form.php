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

    <?= $form->field($model, 'nom_campos')->textInput(['maxlength' => true]) ?>

    <?php $var = ArrayHelper::map($localidades,'id_loc','nom_loc'); ?>

    <?=  $form->field($model, 'loc_campos')->dropDownList($var, ['prompt' => 'Seleccione Uno' ]); ?>


    <?= $form->field($model, 'hec_tot_campos')->textInput() ?>

    <?= $form->field($model, 'hec_sem_campos')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
