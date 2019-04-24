<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Cereales;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

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
            <div class="col-lg-3">
                <?php $var = ['1' => 'Ingresar', '2' => 'Retirar', '3' => 'Transladar'] ?>
                <?= $form->field($model, 'tip_mov')->dropDownList($var, ['prompt' => ' - ', 'disabled' => (!$model->isNewRecord) ? 'disabled' : false]); ?>
            </div>
            <div class="col-lg-3 1 2 3">
                <?= $form->field($model, 'cod_mov')->textInput(['class' => 'form-control']) ?>
            </div>
            <div class="col-lg-3 1 2 3">
                <?php $var = ArrayHelper::map(Cereales::find()->all(), 'id_cer', 'nom_cer'); ?>
                <?= $form->field($model, 'cer_mov')->dropDownList($var, ['prompt' => ' - ', 'class' => 'form-control']); ?>
            </div>
            <div class="col-lg-3 1 2">
                <?= $form->field($model, 'var_mov')->dropDownList([], ['prompt' => ' - ', 'class' => 'form-control']); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 1 2">
                <?= $form->field($model, 'cos_mov')->textInput(['class' => 'form-control']) ?>
            </div>
            <div class="col-lg-3 1 2 3">
                <?= $form->field($model, 'fec_cos')->widget(DatePicker::classname(), [
                    'type' => DatePicker::TYPE_INPUT,
                    'options' => ['autocomplete' => 'off'],
                    'pluginOptions' => [
                        'autocomplete' => 'off',
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,
                    ]
                ]);
                ?>

            </div>
            <div class="col-lg-3 2">
                <?= $form->field($model, 'car_mov')->textInput(['class' => 'form-control']) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 1 2 3">
                <?= $form->field($model, 'tor_mov')->dropDownList(['' => ' - ', '1' => 'Campo', '2' => 'Acopio'], ['class' => 'form-control']) ?>
            </div>
            <div class="col-lg-6 1 2 3">
                <?= $form->field($model, 'ori_mov')->dropDownList(['' => ' - '], ['class' => 'form-control']) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 1 2 3">
                <?= $form->field($model, 'tde_mov')->dropDownList(['' => ' - ', '1' => 'Campo', '2' => 'Acopio'], ['class' => 'form-control']) ?>
            </div>
            <div class="col-lg-6 1 2 3">
                <?= $form->field($model, 'des_mov')->dropDownList(['' => ' - '], ['class' => 'form-control']) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 1 2 3">
                <?= $form->field($model, 'can_mov')->textInput(['class' => 'form-control']) ?>
            </div>
        </div>

        <!--<div class="row">
            <div class="col-lg-3">
                <?php /*= $form->field($model, 'nom_des')->textInput() */ ?>
            </div>
        </div>-->

        <div class="form-group  1 2 3">
            <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success btn-sm']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

<?php

$tor = ($model->tor_mov) ? $model->tor_mov : 1;
$tde = ($model->tde_mov) ? $model->tde_mov : 1;

$ori = ($model->ori_mov) ? $model->ori_mov : 0;
$des = ($model->des_mov) ? $model->des_mov : 0;

$cer = ($model->cer_mov) ? $model->cer_mov : 0;
$var = ($model->var_mov) ? $model->var_mov : 0;

$script = <<< JS
    
   // $('input.1,input.2,input.3,select.1,select.2,select.3,button.1').parent('div').hide();
    $('div.1, div.2, div.3').hide();
    //$('.field-movimientos-fec_cos').hide();

    $('#movimientos-tip_mov').change(function() {
      var value = $(this).val();
      if(value == ''){
          //$('.field-movimientos-fec_cos').hide();
          //$('input.1,input.2,input.3,select.1,select.2,select.3,button.1').parent('div').hide();
          $('div.1, div.2, div.3').hide();
      }
      if(value == 1){
          //$('input.1,input.2,input.3,select.1,select.2,select.3').parent('div').hide();
          $('div.1, div.2, div.3').hide();
          $('div.1').show();
          //$('.field-movimientos-fec_cos').show();
      }
      if(value == 2){
          /*$('input.1,input.2,input.3,select.1,select.2,select.3').parent('div').hide();
          $('input.2,select.2,button.1').parent('div').show();
          $('.field-movimientos-fec_cos').show();*/
          $('div.1, div.2, div.3').hide();
          $('div.2').show();
      }
      if(value == 3){
         /* $('.field-movimientos-fec_cos').hide();
          $('input.1,input.2,input.3,select.1,select.2,select.3').parent('div').hide();
          $('input.3,select.3,button.1').parent('div').show();*/
         $('div.1, div.2, div.3').hide();
          $('div.3').show();
      }
    }); 
    
    function getUbicaciones(){
        $('#movimientos-tor_mov').val(1);
        $('#movimientos-tde_mov').val(1);
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
    
    function loadUbicaciones(){
        var tip = $tor;
        var tip2 = $tde;
        $.ajax({
        url:'getcampos',
        data: {id:tip},
        type:'post',
        dataType:'json',
        success:function(data) {
          $(data).each(function( index,value ) {
              var selectedOri = '';
              if(tip == 1){
                    if(value.id == $ori){
                        selectedDes = "selected";
                    }
                $('#movimientos-ori_mov').append('<option '+selectedDes+' value="'+value.id+'">'+value.nom_campos+'</option>');
              }else{
                    if(value.id_aco == $ori){
                        selectedDes = "selected";
                    }
                  $('#movimientos-ori_mov').append('<option '+selectedDes+' value="'+value.id_aco+'">'+value.nom_aco+'</option>');
              }
         });
        }
      });
        $.ajax({
        url:'getcampos',
        data: {id:tip2},
        type:'post',
        dataType:'json',
        success:function(data) {
          $(data).each(function( index,value ) {
               var selectedDes = '';
              if(tip2 == 1){
                  if(value.id == $des){
                    selectedDes = "selected";
                }
                $('#movimientos-des_mov').append('<option '+selectedDes+' value="'+value.id+'">'+value.nom_campos+'</option>');
              }else{
                  if(value.id_aco == $des){
                    selectedDes = "selected";
                    }
                  $('#movimientos-des_mov').append('<option '+selectedDes+'  value="'+value.id_aco+'">'+value.nom_aco+'</option>');
              }
         });
        }
      });
    }

    $('#movimientos-tor_mov').change(function() {
        var tip = $(this).val();
        if(!tip){
            $('#movimientos-ori_mov').html('');
            $('#movimientos-ori_mov').append('<option value=""> - </option>');
            return false;
        }
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
    
    $('#movimientos-tde_mov').change(function() {
        var tip = $(this).val();
        if(!tip){
            $('#movimientos-des_mov').html('');
            $('#movimientos-des_mov').append('<option value=""> - </option>');
            return false;
        }
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
                $('#movimientos-des_mov').append('<option  value="'+value.id+'">'+value.nom_campos+'</option>');
              }else{
                  $('#movimientos-des_mov').append('<option value="'+value.id_aco+'">'+value.nom_aco+'</option>');
              }
         });
        }
      });
    });
    
    $('#movimientos-tip_mov').trigger('change');
    
    $('#movimientos-cer_mov').change(function() {
        $('#movimientos-var_mov').html('');
        $('#movimientos-var_mov').append('<option value=""> - </option>');
        $.ajax({
        url:'getvariedades',
        data: {id: $(this).val()},
        type:'post',
        dataType:'json',
        success:function(data) {
          $(data).each(function( index,value ) {
              $('#movimientos-var_mov').append('<option  value="'+value.id_var+'">'+value.des_var+'</option>');
         });
        }
      });
    });
    
    function loadCereales(){
        var cer = $cer;
        var variedad = $var;
        $('#movimientos-var_mov').html('');
        $('#movimientos-var_mov').append('<option value=""> - </option>');
        $.ajax({
        url:'getvariedades',
        data: {id: cer},
        type:'post',
        dataType:'json',
        success:function(data) {
          $(data).each(function( index,value ) {
              if(value.id_var == variedad){
                    var selected = "selected";
                }
              $('#movimientos-var_mov').append('<option '+ selected +'  value="'+value.id_var+'">'+value.des_var+'</option>');
         });
        }
      });
    }
    
    if($cer){
        loadCereales();
    }
    
    if($ori && $des){
        loadUbicaciones();
    }else{
        getUbicaciones();
    }
    
JS;

$this->registerJs($script);

?>