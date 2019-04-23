<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Ingresar';
?>
<div class="site-login">
<br>
    <div class="row">
        <div class="col-lg-offset-4 col-lg-4 divLogin">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox([
                'template' => "<div class=\"col-lg-7\">{input} {label}</div>\n<div class=\"col-lg-6\">{error}</div>",
            ]) ?>

            <div class="form-group">
                <div class="col-lg-12 text-right">
                    <?= Html::submitButton('Aceptar', ['class' => 'btn btn-success btn-sm', 'name' => 'login-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
