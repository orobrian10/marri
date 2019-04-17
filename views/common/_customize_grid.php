<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\web\JsExpression;

use kartik\select2\Select2;
use kartik\popover\PopoverX;

// Needed for get pagination
$dataProvider->prepare();
?>

<div class="row">
	<div class="col-md-6">
		<?= $form->field($model, 'sort')->hiddenInput(['options' => ['class' => 'g-sort-custom']]) ?>

		<div class="customize-open-item-container">
			<?php PopoverX::begin([
				'id' => 'custom-lines',
			    'placement' => PopoverX::ALIGN_BOTTOM_LEFT,
			    'toggleButton' => [
			    	'label' => 'Cantidad <br/> de líneas <span class="caret"></span>', 
			    	'class' => 'btn btn-sm btn-link btn-customize-open'
			    ],
			    'options' => [
			    	'class' => 'customize-container',
			    ],
			    'header' => 'Seleccionar',
			    'footer' => Html::button('Aplicar', [
			    	'class' => 'btn btn-sm btn-primary btn-customize-apply showLoading',
			    	'onclick' => '$("#custom-lines .close").click(); $("#form-abm").trigger("submit")'
			    ]),
			]); ?>

				<div id="customize-lines" class="customize-form">
					<?= $form->field($model, 'lines')->multiselect(['10' => '10', '50' => '50', '100' => '100'], [
						'height' => '100%',
						'selector' => 'radio',
			    		'container' => ['class' => 'customize-items-container'],
					]) ?>
				</div>

			<?php PopoverX::end(); ?>
		</div>
		<div class="customize-open-item-container">
			<?php PopoverX::begin([
				'id' => 'custom-columns',
			    'placement' => PopoverX::ALIGN_BOTTOM_LEFT,
			    'toggleButton' => [
			    	'label' => 'Seleccionar <br/> columnas <span class="caret"></span>', 
			    	'class' => 'btn btn-sm btn-link btn-customize-open'
			    ],
			    'options' => [
			    	'class' => 'customize-container',
			    ],
			    'header' => 'Seleccionar',
			    'footer' => Html::button('Aplicar', [
			    	'class' => 'btn btn-sm btn-primary btn-customize-apply showLoading',
			    	'onclick' => '$("#custom-columns .close").click(); $("#form-abm").trigger("submit")'
			    ]),
			]); ?>

				<div id="customize-columns" class="customize-form">
					<?= $form->field($model, 'columns')->multiselect($columns, [
						'height' => '100%',
			    		'container' => ['class' => 'customize-items-container inline-checkbox'],
					]) ?>
				</div>

			<?php PopoverX::end(); ?>
		</div>

		<?php if($showStatus): ?>
			<div class="customize-open-item-container">
				<?php PopoverX::begin([
					'id' => 'custom-status',
				    'placement' => PopoverX::ALIGN_BOTTOM_LEFT,
				    'toggleButton' => [
				    	'label' => 'Estado <br/> de la beca <span class="caret"></span>', 
				    	'class' => 'btn btn-sm btn-link btn-customize-open'
				    ],
				    'options' => [
				    	'class' => 'customize-container',
				    ],
				    'header' => 'Seleccionar',
				    'footer' => Html::button('Aplicar', [
				    	'class' => 'btn btn-sm btn-primary btn-customize-apply showLoading',
				    	'onclick' => '$("#custom-status .close").click(); $("#form-abm").trigger("submit")'
				    ]),
				]); ?>

					<div id="customize-status" class="customize-form">
						<?= $form->field($model, 'status')->multiselect(Yii::$app->utilidades->getEstados(), [
							'height' => '100%',
				    		'container' => ['class' => 'customize-items-container'],
						]) ?>
					</div>

				<?php PopoverX::end(); ?>
			</div>
		<?php endif; ?>
		<div class="customize-open-item-container item-page">
			<span class="page-cursor prev-page">< <</span>
			<span> Página </span>
			<span>
				<div id="customize-page" class="customize-form">
					<?= $form->field($model, 'page')->textInput(['class' => 'customize-page']) ?>					
				</div>
			</span>
			<span> de </span>
			<span class="total-pages"><?= $dataProvider->getPagination()->getPageCount() ?></span> 
			<span class="page-cursor next-page">> ></span>
		</div>
	</div>
</div>
<div class="gridview-scroll-top" style="height: 20px; width: 100%; overflow-x: auto; overflow-y: hidden;">
	<div class="custom-scroll-top" style="height: 20px;"></div>
</div>

<?php $script = "

$('.next-page').click(function(e) {
	var formName = '" . $model->formName() . "';
	var currentPage = $('#' + formName + '-page').val();
	var totalPages = $('.total-pages').html();

	if (currentPage >= totalPages) {
		return;
	}
	$('#' + formName + '-page').val(++currentPage);
	$('#' + formName + '-page').change();
});

$('.prev-page').click(function(e) {
	var formName = '" . $model->formName() . "';
	var currentPage = $('#' + formName + '-page').val();
	var totalPages = $('.total-pages').html();

	if (currentPage <= 1) {
		return;
	}
	$('#' + formName + '-page').val(--currentPage);
	$('#' + formName + '-page').change();
});

$('#" . $model->formName() . "-page').change(function(e) {
	$('#form-abm').trigger('submit');
});

window.refreshPage = false;

$('input[name=\"" . $model->formName() . "[lines]\"], input[name=\"" . $model->formName() . "[status]\"], input[name=\"" . $model->formName() . "[sort]\"]').change(function(e) {
	window.refreshPage = true;
});

$('#form-abm').on('beforeSubmit', function(e) {
	if (window.refreshPage) {
		$('#" . $model->formName() . "-page').val(1);
	}
	e.preventDefault();
});

$('.custom-grid-header a').click(function(e) {
	e.preventDefault();
	var order = $(this).attr('data-sort');
	var newOrder = order + ' ASC';
	if (order.indexOf('-') !== -1) {
		newOrder = order.substring(1) + ' DESC';
	}
	$('#g-sort').val(newOrder);
	$('#g-sort').change();
	$('#form-abm').trigger('submit');
});

$('.gridview-scroll-top').on('scroll', function (e) {
    $('.table-responsive').scrollLeft($('.gridview-scroll-top').scrollLeft());
}); 

$('.table-responsive').on('scroll', function (e) {
    $('.gridview-scroll-top').scrollLeft($('.table-responsive').scrollLeft());
});

$('.gridview-scroll-top .custom-scroll-top').width($('.table').width());

";

$this->registerJs($script, View::POS_READY); ?>