<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Variedades */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="variedades-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $var = ArrayHelper::map(\app\models\Cereales::find()->all(), 'id_cer', 'nom_cer'); ?>
    <?= $form->field($model, 'cer_var')->dropDownList($var, ['prompt' => ' - ']); ?>

    <?= $form->field($model, 'des_var')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
