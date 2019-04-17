<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Campos */

$this->title = $model->nom_campos;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Campos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="campos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Modificar'), ['update', 'id' => $model->nom_campos], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->nom_campos], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php

    //var_dump($model); exit();
    //$model->nom_loc = $model->getLocalidad()->one()->nom_loc; ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nom_campos',
            'localidades.nom_loc',
            'hec_tot_campos',
            'hec_sem_campos',
        ],
    ]) ?>

</div>
