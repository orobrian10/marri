<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Proveedores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proveedores-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nom_pro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel_pro')->textInput() ?>

    <?php $var = ArrayHelper::map($localidades,'id_loc','nom_loc'); ?>
    <?=  $form->field($model, 'loc_pro')->dropDownList($var, ['prompt' => 'Seleccione Uno' ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
