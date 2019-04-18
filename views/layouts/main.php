<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="logo-container nav-bar-container ">
        <div class="container">
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <img class="img-responsive" src="<?= Yii::getAlias('@web') ?>/img/Logo_Argentina.png"
                         alt="Argentina">
                </div>
            </div>
        </div>
    </div>
    <?php
    $ico_inicio = '<svg id="Capa_1" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 25"><defs><style>.cls-1{fill:#4d4d4d;}</style></defs><title>home</title><path class="cls-1" d="M29.71,11.51,16.86,2.1a.71.71,0,0,0-.83,0L3.17,11.51A.71.71,0,0,0,4,12.65l1.87-1.37v11a.7.7,0,0,0,.7.71h7.05a.71.71,0,0,0,.7-.65V15.48a2.12,2.12,0,1,1,4.23,0v6.88a.71.71,0,0,0,.7.65h7a.7.7,0,0,0,.7-.71v-11l1.87,1.37a.71.71,0,0,0,.83-1.14ZM25.6,10.39V21.6H20V15.48a3.53,3.53,0,1,0-7,0V21.6H7.28V10.39a.51.51,0,0,0,0-.13l9.18-6.72,9.19,6.72A.5.5,0,0,0,25.6,10.39Z"/></svg>';

    $menu_items = [
        [
            'label' => '<div class="ico-svg-navbar">' . $ico_inicio . '</div>',
            'url' => Yii::$app->homeUrl,
            'options' => ['class' => 'showLoading']
        ],
        [
            'label' => 'Campos',
            'items' => [
                [
                    'label' => 'Listado',
                    'url' => ['/campos/index'],
                    'options' => ['class' => 'showLoading']
                ]
            ]
        ],
        [
            'label' => 'Acopios',
            'items' => [
                [
                    'label' => 'Listado',
                    'url' => ['/acopios/index'],
                    'options' => ['class' => 'showLoading']
                ],
                [
                    'label' => 'Lugares',
                    'url' => ['/acopios-lugares/index'],
                    'options' => ['class' => 'showLoading']
                ],
            ],
        ],
        [
            'label' => 'Localidades',
            'url' => ['/localidades/index'],
            'options' => ['class' => 'showLoading']
        ],
        [
            'label' => 'Proveedores',
            'url' => ['/proveedores/index'],
            'options' => ['class' => 'showLoading']
        ],
    ];


    NavBar::begin([
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => $menu_items,
    ]);
    NavBar::end();
    ?>

    <div class="container" id="page-loader">
        <?= Breadcrumbs::widget([
            'homeLink' => false,
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : '',
        ]) ?>
        <?= $content ?>
    </div>

    <div id="loader"></div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
