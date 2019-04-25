<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<section>
    <article class="content_format row">
        <div class="col-md-10 col-md-offset-1">
            <img style="display: inline-block; vertical-align: initial; margin-right: 30px;"
                 src="<?= Yii::getAlias('@web') ?>/img/ico_error.png" alt="error">
            <div style="display: inline-block;">
                <h4 style="color: #46a948">Se ha producido un error</h4>
                <br>
                <div style="color: #939393;">
                    <?= nl2br(Html::encode($message)) ?>
                </div>
            </div>
        </div>
    </article>
</section>