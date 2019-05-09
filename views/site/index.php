<?php

/* @var $this yii\web\View */

$this->title = 'O. Maquirriain SRL';
?>
<div class="site-index">
    <br>
    <h4 class="text-center">Bienvenido a Gestión <?= $this->title ?></h4>

    <div class="body-content">

        <div class="row mt-40">
            <div class="col-md-4 col-sm-6">
                <a href="acopios">
                    <div class="box1">
                        <img src="<?= Yii::getAlias('@web') ?>/img/menu/acopios.jpg" alt="" class="img-thumbn">
                        <h3 class="title">ACOPIOS</h3>
                    </div>
                </a>
            </div>
            <!--<div class="col-md-4 col-sm-6">
                <a href="acopios-lugares">
                    <div class="box1">
                        <img src="<?/*= Yii::getAlias('@web') */?>/img/menu/campo.jpg" alt="">
                        <h3 class="title">UBICACIONES DE ACOPIOS</h3>
                    </div>
                </a>
            </div>-->
            <div class="col-md-4 col-sm-6">
                <a href="cereales">
                    <div class="box1">
                        <img src="<?= Yii::getAlias('@web') ?>/img/menu/cereales.jpg" alt="">
                        <h3 class="title">CEREALES</h3>
                    </div>
                </a>
            </div>
        </div>
        <div class="row mt-40">
            <div class="col-md-4 col-sm-6">
                <a href="movimientos">
                    <div class="box1">
                        <img src="<?= Yii::getAlias('@web') ?>/img/menu/movimientos.jpg"" alt="">
                        <h3 class="title">VENTAS</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="localidades">
                    <div class="box1">
                        <img src="<?= Yii::getAlias('@web') ?>/img/menu/localidades.jpg" alt="" class="img-thumbn">
                        <h3 class="title">LOCALIDADES</h3>
                    </div>
                </a>
            </div>
            <!--<div class="col-md-4 col-sm-6">
                <a href="proveedores">
                    <div class="box1">
                        <img src="<?/*= Yii::getAlias('@web') */?>/img/menu/proveedores.jpg"" alt="">
                        <h3 class="title">PROVEEDORES</h3>
                    </div>
                </a>
            </div>-->
        </div>
    </div>

    <hr>
    <article class="content_format row apostillar-documento-seccion">
        <div class="col-md-10 col-md-offset-1">
            <a class="mostrar-ver-mas-instituciones custom-collapse" data-toggle="collapse"
               data-target="#ver-instituciones" aria-expanded="true">
                <div class="row">
                    <div class="col-xs-11 col-no-padding-right">
                        <div>
                            <div>
                                <h1 class="accesos-express">Accesos Express</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-1" style="margin-top: 20px;">
                        <div class="informacion-general-item"></div>
                    </div>
                </div>
            </a>
            <div class="row">
                <div class="col-xs-11 col-no-padding-right">
                    <div id="ver-instituciones" class="collapse" aria-expanded="false" style="">
                        <div class="row">
                            <div class="col-lg-12">
                                <a href="https://auth.afip.gob.ar/contribuyente_/login.xhtml"><img class="img-responsive center-block"
                                                 src="<?= Yii::getAlias('@web') ?>/img/logo_afip.png"
                                                 alt="Argentina"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>

</div>
</div>
