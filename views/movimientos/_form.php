<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Cereales;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Movimientos */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="movimientos-form">

        <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-lg-3">
                <?php $var = ['1' => 'Ingresar', '2' => 'Retirar', '3' => 'Transladar'] ?>
                <?= $form->field($model, 'tip_mov')->dropDownList($var, ['prompt' => ' -    ']); ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'cod_mov')->textInput(['class' => 'form-control 1 2 3']) ?>
            </div>
            <div class="col-lg-3">
                <?php $var = ArrayHelper::map(Cereales::find()->all(), 'id_cer', 'nom_cer'); ?>
                <?= $form->field($model, 'cer_mov')->dropDownList($var, ['prompt' => ' - ', 'class' => 'form-control 1 2 3']); ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'var_mov')->textInput(['maxlength' => true, 'class' => 'form-control 1 2']) ?>

            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'cos_mov')->textInput(['class' => 'form-control 1 2']) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'fec_cos')->textInput(['class' => 'form-control 1 2 3']) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'can_mov')->textInput(['class' => 'form-control 1 2 3']) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'car_mov')->textInput(['class' => 'form-control 2']) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label">Tipo de Orígen</label>
                    <select id="tip-org" class="form-control 1 2 3">
                        <option value=""> -</option>
                        <option value="1">Campo</option>
                        <option value="2">Acopio</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <?= $form->field($model, 'ori_mov')->dropDownList(['' => ' - '], ['class' => 'form-control 1 2 3']) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label">Tipo de Destino</label>
                    <select id="tip-des" class="form-control 1 2 3">
                        <option value=""> -</option>
                        <option value="1">Campo</option>
                        <option value="2">Acopio</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <?= $form->field($model, 'des_mov')->dropDownList(['' => ' - '], ['class' => 'form-control 1 2 3']) ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success btn-sm 1 2 3']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

<?php
$script = <<< JS

    getUbicaciones();

    $('input,select.1,select.2,select.3,button.1').parent('div').hide();

    $('#movimientos-tip_mov').change(function() {
      var value = $(this).val();
      if(value == ''){
          $('input,select.1,select.2,select.3,button.1').parent('div').hide();      
      }
      if(value == 1){
          $('input,select.1,select.2,select.3').parent('div').hide();
          $('input.1,select.1,button.1').parent('div').show();
      }
      if(value == 2){
          $('input,select.1,select.2,select.3').parent('div').hide();
          $('input.2,select.2,button.1').parent('div').show();
      }
      if(value == 3){
          $('input,select.1,select.2,select.3').parent('div').hide();
          $('input.3,select.3,button.1').parent('div').show();
      }
    }); 
    
    function getUbicaciones(){
        $('#tip-org').val(1);
        $('#tip-des').val(1);
        $('#movimientos-ori_mov').html('');
        $('#movimientos-ori_mov').append('<option value=""> - </option>');
        $('#movimientos-des_mov').html('');
        $('#movimientos-des_mov').append('<option value=""> - </option>');
        $.ajax({
        url:'getcampos',
        data: {id:1},
        type:'post',
        dataType:'json',
        success:function(data) {
          $(data).each(function( index,value ) {
                $('#movimientos-ori_mov').append('<option value="'+value.id+'">'+value.nom_campos+'</option>');
                $('#movimientos-des_mov').append('<option value="'+value.id+'">'+value.nom_campos+'</option>');
         });
        }
      });
    }
    
    $('#tip-org').change(function() {
        var tip = $(this).val();
        $('#movimientos-ori_mov').html('');
        $('#movimientos-ori_mov').append('<option value=""> - </option>');
      $.ajax({
        url:'getcampos',
        data: {id:tip},
        type:'post',
        dataType:'json',
        success:function(data) {
          $(data).each(function( index,value ) {
              if(tip == 1){
                $('#movimientos-ori_mov').append('<option value="'+value.id+'">'+value.nom_campos+'</option>');
              }else{
                  $('#movimientos-ori_mov').append('<option value="'+value.id_aco+'">'+value.nom_aco+'</option>');
              }
         });
        }
      });
    });
    
    $('#tip-des').change(function() {
        var tip = $(this).val();
        $('#movimientos-des_mov').html('');
        $('#movimientos-des_mov').append('<option value=""> - </option>');
      $.ajax({
        url:'getcampos',
        data: {id:tip},
        type:'post',
        dataType:'json',
        success:function(data) {
          $(data).each(function( index,value ) {
              if(tip == 1){
                $('#movimientos-des_mov').append('<option value="'+value.id+'">'+value.nom_campos+'</option>');
              }else{
                  $('#movimientos-des_mov').append('<option value="'+value.id_aco+'">'+value.nom_aco+'</option>');
              }
              //console.log( index + ": " + $( this ).text() );
         });
        }
      });
    });
    
    $('#movimientos-tip_mov').trigger('change');

JS;

$this->registerJs($script);

?>