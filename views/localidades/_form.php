<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Localidades */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="localidades-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nom_loc')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
