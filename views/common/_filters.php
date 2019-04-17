<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\web\JsExpression;

use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;

?>

<div class="row filters-container">
	<div class="col-sm-12">
		<p class="title">Filtrar por</p>

	    <div id="filters-form" class="abm-form">
	    	<div id="dinamic-fields">
				<?php $filtersActivesCount = 0; ?>
	            <?php foreach ($models as $index => $model): ?>
	            	<?php
	            		$isSelect2 = $model->type == 'dropdown';
	            		$isAvaiable = $index == 0 || $model->hasValue();
	            		if ($isAvaiable) {
	            			$filtersActivesCount++;
	            		}
	            	?>
	            	<div class="row <?= $isAvaiable ? '' : 'hidden' ?>" id="field-<?= $index ?>">
	            		<div class="col-sm-3 col-no-padding-right">
	            			<div class="filters-form-item">
							    <?= $form->field($model, "[{$index}]metric")->widget(Select2::classname(), [
							        'options' => [ 'placeholder' => 'Seleccionar filtro'],
							        'data'    => $metrics,
							        'pluginEvents' => [
							        	'change' =>  new yii\web\JsExpression('function(e) {
							        			$.get(
							        				"' . Url::to(['obtenervalordefiltro']) . '",
							        				{metric: $("#' . $model->formName() . '-' . $index . '-metric").val()},
							        				function(data, textStatus, jqXHR) {

														if (data["type"] == "input") {
															$(".container-select2-' . $index . '").addClass("hidden");
															$(".container-input-' . $index . '").removeClass("hidden");
															return;
														}

														$(".container-select2-' . $index . '").removeClass("hidden");
														$(".container-input-' . $index . '").addClass("hidden");

							        					var html = "<option value=>Select values</option>";
							        					for (var i = 0; i < data["values"].length ; i++) { 
							                                html += "<option value=\"" + data["values"][i].id + "\">" + data["values"][i].value + "</option>";
							                            }
							                            $("#' . $model->formName() . '-' . $index . '-valuesdropdown").html(html);
							        				},
							        				"json"
							        			);
							        		}'
							        	)
							        ],
							    ])->label(false) ?>	
	            			</div>
	            		</div>
	            		<div class="col-sm-6 col-no-padding-right <?= $isSelect2 ? '' : 'hidden' ?> container-select2-<?= $index ?>">
	            			<div class="filters-form-item">
							    <?= $form->field($model, "[{$index}]valuesDropdown")->widget(Select2::classname(), [
							        'options' => [ 'placeholder' => 'Ingresar valor', 'class' => 'col-md-12', 'multiple' => true ],
							        'data'    => $model->allValues,
							    ])->label(false) ?>
	            			</div>
	            		</div>
	            		<div class="col-sm-6 col-no-padding-right <?= $isSelect2 ? 'hidden' : '' ?> container-input-<?= $index ?>">
	            			<div class="filters-form-item">
							    <?= $form->field($model, "[{$index}]valueInput")->textInput()->label(false) ?>
	            			</div>
	            		</div>
	            		<div class="col-sm-1 col-no-padding">
	            			<?= Html::a('<i id="fa fa-remove" class="fa fa-remove icono-4x text-gray" data-clipboard-text="fa-remove"></i>', '#', ['class' => 'btn-sm btn btn-delete-filter delete-item', 'fieldIndex' => $index]) ?>
	            		</div>
	            	</div>
	            <?php endforeach; ?>
	        </div>

			<div class="form-group">
		        <?= Html::button('Agregar filtro', ['class' => 'btn btn-sm btn-link btn-add-filter add-item', 'nextFieldIndex' => $index + 1]) ?>
		        <?= Html::submitButton('Buscar', ['class' => 'btn btn-sm btn-primary btn-buscar-filter showLoading']) ?>
			</div>
	    </div>
	</div>
</div>

<?php $script = "

window.fieldCount = " . $filtersActivesCount . ";

$('.delete-item').click(function(e) {
	var fieldIndex = $(this).attr('fieldIndex');
	var formName = '" . $model->formName() . "';

	// Set val() to null of current filters
	$('#' + formName + '-' + fieldIndex + '-metric').val('');
	$('#' + formName + '-' + fieldIndex + '-metric').trigger('change');
	$('#' + formName + '-' + fieldIndex + '-valueinput').val('');
	$('#' + formName + '-' + fieldIndex + '-valuesdropdown').val('');
	$('#' + formName + '-' + fieldIndex + '-valuesdropdown').trigger('change');

	if (fieldCount == 1) {
		return;
	}
	fieldCount--;

	// Hide row for current filter
	$('#field-' + fieldIndex).addClass('hidden');

});

$('.add-item').click(function(e) {
	if (fieldCount == " . count($models) . ") {
		return;
	}
	fieldCount++;
	$('#dinamic-fields .row.hidden').first().removeClass('hidden');
});

$('#filters-form input, #filters-form select').change(function(e) {
	window.refreshPage = true;
});

";

$this->registerJs($script, View::POS_READY); ?>