<?php

?>

<section>
	<article class="content_format row">
		<div class="col-md-10 col-md-offset-1">
			<h1>Resultado de Cron: <?= $resultado ?></h1>
			<?php if(count($errores) > 0): ?>
				<p>Email no enviados:</p>
				<br>
				<?php foreach ($errores as $e): ?>
					<p><?= $errores->email ?></p>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</article>
</section>