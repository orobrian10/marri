<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Cereales;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use app\models\Acopios;
use app\models\AcopiosLugares;

/* @var $this yii\web\View */
/* @var $model app\models\Movimientos */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="movimientos-form">

        <?php $form = ActiveForm::begin(['id' => 'form-signsup',

            'enableAjaxValidation' => false,
            'enableClientValidation' => true,
            //'id' => 'ajax'
        ]); ?>

        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'fec_cos')->widget(DatePicker::classname(), [
                    'type' => DatePicker::TYPE_INPUT,
                    'options' => ['autocomplete' => 'off', 'value' => date('Y-m-d')],
                    'pluginOptions' => [
                        'autocomplete' => 'off',
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,
                    ]
                ]);
                ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'car_mov')->textInput(['class' => 'form-control']) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'can_mov')->textInput(['class' => 'form-control']) ?>
            </div>

        </div>
        <div class="row">

            <div class="col-lg-4">
                <?php $var = ArrayHelper::map(Cereales::find()->all(), 'id_cer', 'nom_cer'); ?>
                <?= $form->field($model, 'cer_mov')->dropDownList($var, ['prompt' => ' - ', 'class' => 'form-control']); ?>
            </div>
            <div class="col-lg-4">
                <?php $var = ArrayHelper::map(AcopiosLugares::find()->all(), 'id_lug', 'nom_lug'); ?>
                <?= $form->field($model, 'ori_mov')->dropDownList($var,['prompt' => ' - '], ['class' => 'form-control']) ?>
            </div>
            <div class="col-lg-4">
                <?php $var = ArrayHelper::map(Acopios::find()->all(), 'id_aco', 'nom_aco'); ?>
                <?= $form->field($model, 'des_mov')->dropDownList($var,['prompt' => ' - '], ['class' => 'form-control']) ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success btn-sm']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

<?php

$script = <<< JS
    
    
JS;

//$this->registerJs($script);

?>