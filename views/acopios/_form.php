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
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'nom_aco')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?php $var = ArrayHelper::map($lugares, 'id_lug', 'nom_lug'); ?>
            <?= $form->field($model, 'ubi_aco')->dropDownList($var, ['prompt' => ' - ']); ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'cer_aco')->textInput() ?>
        </div>

        <div class="col-lg-4">
            <?= $form->field($model, 'lot_aco')->textInput() ?>
        </div>

        <div class="col-lg-4">
            <?php $var = ['1' => 'Silo en bolsa', '2' => 'Silo Propio'] ?>
            <?= $form->field($model, 'sil_aco')->dropDownList($var, ['prompt' => ' - ']); ?>
        </div>

        <?php if($model->isNewRecord): ?>
            <div class="col-lg-4">
                <?= $form->field($model, 'stock')->textInput() ?>
            </div>
        <?php endif; ?>

    </div>

    <div class="col-lg-12 text-right">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
