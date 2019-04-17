<?php

use yii\bootstrap\Modal;
use yii\web\View;

?>

<?php Modal::begin([
    'id' => 'modal',
    'size' => Modal::SIZE_LARGE,
    'header' => '<h1 class="modal-title"></h1>',
    'closeButton' => [
        'label' => '<i id="fa fa-remove" class="fa fa-remove icono-4x text-gray" data-clipboard-text="fa-remove"></i>',
    ],
    'clientOptions' => [
        'backdrop' => 'static',
        'keyboard' => FALSE
    ],
    'options' => [
		'tabindex' => false // important for Select2 to work properly
	],
]);
?>

<div class="modal-custom-content"></div>

<?php Modal::end(); ?>

<?php $script = "

$('.action-open-modal').on('click', function(e) {
    e.preventDefault();

    var header;

    if($(this).hasClass('action-create'))
        header = 'Crear " . $entity . "';

    if($(this).hasClass('action-update'))
        header = 'Editar " . $entity . "';

    if($(this).hasClass('action-view'))
        header = 'Detalle de " . ucfirst($entity) . "';

    if($(this).hasClass('action-archive'))
        header = 'Archivar " . $entity . "';

    if($(this).hasClass('action-unarchive'))
        header = 'Desarchivar " . $entity . "';

    if($(this).hasClass('action-approved'))
        header = 'Aprobar " . $entity . "';

    if($(this).hasClass('action-rejected'))
        header = 'Rechazar " . $entity . "';

    if($(this).hasClass('action-duplicate'))
        header = 'Crear " . $entity . "';

    if($(this).hasClass('action-eliminar'))
        header = 'Eliminar " . $entity . "';

    $('#modal .modal-titulo').html('');
    $('#modal .modal-custom-content').html('<div style=\"padding:100px 0px;text-align:center;\"><img src=\"" . Yii::getAlias('@web') . "/img/loading.gif\" width=\"40\" /></div>');
    $('#modal').modal('show');

    $.get(
        $(this).attr('href')
    )
        .done(function(result) {
            $('#modal .modal-title').html(header);
            $('#modal .modal-custom-content').html(result);
        });
});

";

$this->registerJs($script, View::POS_READY); ?>