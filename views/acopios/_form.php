<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Cereales;
use app\models\Localidades;

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
            <?php $var = ArrayHelper::map(Localidades::find()->all(), 'id_loc', 'nom_loc'); ?>
            <?= $form->field($model, 'ubi_aco')->dropDownList($var, ['prompt' => ' - ']); ?>
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
