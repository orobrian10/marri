<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cereales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cereales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nom_cer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'var_cer')->textarea(['maxlength' => true, 'style' => 'resize:none']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
