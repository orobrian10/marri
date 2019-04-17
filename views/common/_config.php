<?php

use yii\web\View;
use yii\helpers\Url;
use yii\web\JsExpression;

use kartik\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin([
    'id'         => 'form-config-abm',
    'type'       => ActiveForm::TYPE_HORIZONTAL,
    'formConfig' => ['labelSpan' => 2],
    'method' => 'POST',
    'action' => Url::to(['config/activar' . $controller]),
    'options'    => ['class' => 'abm-form'],
]); ?>

    <div class="row filters-container">
        <div class="col-md-12">
            <p class="title" style="display: inline-block;">Activar <?= $controller ?></p>
            <div class="result-loading hidden" style="display: inline-block;"><img src="<?= Yii::getAlias('@web') ?>/img/loading_gris.gif" alt="loading" style="width: 30px;"></div>
            <div class="result-config-ok hidden" style="display: inline-block;"><i id="fa fa-check" class="fa fa-check icono-4x text-gray" data-clipboard-text="fa-check"></i></div>
            <div class="result-config-error hidden" style="display: inline-block;"><i id="fa fa-remove" class="fa fa-remove icono-4x text-gray" data-clipboard-text="fa-remove"></i> Error</div>
            <div class="config-item">
                <?= $form->field($model, 'valor')->radioButtonGroup(
                        [1 => 'Si', 0 => 'No'], 
                        ['itemOptions' => ['labelOptions' => ['class' => 'btn btn-sm btn-default']]]
                    )->label(false) ?>
            </div>
        </div>
    </div>

<?php ActiveForm::end(); ?> 


<?php $script = "

$('input[name=\"Config[valor]\"]').change(function(e) {
    $('#form-config-abm').submit();
});

$('#form-config-abm').on('beforeSubmit', function(e) {
    $('.result-loading').removeClass('hidden');
    
    var \$form = $(this);
    $.post(
        \$form.attr('action'),
        \$form.serialize()
    )
        .done(function(result) {
            $('.result-config-error').addClass('hidden')
            $('.result-loading').addClass('hidden');
            $('.result-config-ok').removeClass('hidden')
        })
        .fail(function(error){
            $('.result-config-ok').addClass('hidden')
            $('.result-loading').addClass('hidden');
            $('.result-config-error').removeClass('hidden')
        })
    return false;
});

"; 

$this->registerJs($script, View::POS_READY); ?>