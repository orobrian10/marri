<?php

$values = ['si' => Yii::t('app', 'Si'), 'no' => Yii::t('app', 'No')]; 

use kartik\checkbox\CheckboxX;

$removeCallback = '';
$addCallback = '';

foreach ($class_a_mostrar as $c) {
	$removeCallback .= '$(".' . $c . '").removeClass("hidden");';
	$addCallback .= '$(".' . $c . '").addClass("hidden");';
}

if ($activo) {
	$key_match = 'si';
} else {
	$key_match = 'no';
}

?>

<?php foreach ($values as $key => $value): ?>
	<div class="<?= $nombre ?>-mostrar-item <?= ($key == $key_match ? 'active' : '') ?>">
		<?= CheckboxX::widget([
		    'name' => 'field-' . $nombre . '-' . $key,
		    'value' => ($key == $key_match ? '1' : '0'),
		    'options' => ['id' => 'field-' . $nombre . '-' . $key, 'class' => $nombre . '-cbx'],
		    'pluginOptions' => ['threeState' => false],
		    'pluginEvents' => [
		    	'change' => new yii\web\JsExpression('
					function(e) {
						if ($(this).val() == 0) {
							$(this).val("1");
							$(this).parents("' . $nombre . '-mostrar-item").find(".cbx-icon").html("<i class=\"glyphicon glyphicon-ok\"></i>");
							return false;
						}

						// Muestro clases segun corresponda
						if ($(".' . $nombre . '-mostrar-item.active .cbx-label").html().trim() == "No") {
							' . $removeCallback . '
						} else {
							' . $addCallback . '
						}

						// Desactivo checkbox de opcion anterior
						$(".' . $nombre . '-mostrar-item.active .glyphicon-ok").remove();
						// Quito opcion active
						$(".' . $nombre . '-mostrar-item.active .' . $nombre . '-cbx").val("0");
						$(".' . $nombre . '-mostrar-item.active").removeClass("active");

						// Agrego opcion como activa
						$(this).parents(".' . $nombre . '-mostrar-item").addClass("active");
					}
		    	'),
		    ],
		]) ?>
		<label class="form-label-hide cbx-label" for="field-<?= $nombre ?>-<?= $key ?>"><?= $value ?></label>
	</div>
<?php endforeach; ?>