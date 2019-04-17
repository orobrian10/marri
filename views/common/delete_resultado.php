<?php

$this->title = $nombre_abm;

$this->params['breadcrumbs'][] = [
	'label' =>  'ABM ' . $nombre_abm,
	'url' => $url,
];

$this->params['breadcrumbs'][] = $this->title;

?>

<h1>El registro se elimino satisfactoriamente</h1>
<a href="<?= $url ?>">Volver al ABM</a>

