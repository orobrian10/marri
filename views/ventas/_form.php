<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Cereales;
use app\models\Acopios;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Ventas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ventas-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'fec_ven')->widget(DatePicker::classname(), [
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
            <?php $var = ArrayHelper::map(Cereales::find()->all(), 'id_cer', 'nom_cer'); ?>
            <?= $form->field($model, 'cer_ven')->dropDownList($var, ['prompt' => ' - ', 'class' => 'form-control']); ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'kgs_ven')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'pkg_ven')->textInput() ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'pto_ven')->textInput() ?>
        </div>
        <div class="col-lg-4">
            <?php $var = ArrayHelper::map(Acopios::find()->all(), 'id_aco', 'nom_aco'); ?>
            <?= $form->field($model, 'des_ven')->dropDownList($var, ['prompt' => ' - '], ['class' => 'form-control']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$script = <<< JS

    $('#ventas-kgs_ven,#ventas-pkg_ven').blur(function() {
      calcPrecio();
    });
    
    function calcPrecio(){
        kgs = $('#ventas-kgs_ven').val();
        pkg = $('#ventas-pkg_ven').val();
        
        if(kgs && pkg){
            
            totPre = parseFloat(kgs) * parseFloat(pkg);
            
            $('#ventas-pto_ven').val(totPre);
        }
        
    }
    
JS;

$this->registerJs($script);

?>
