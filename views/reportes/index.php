<?php

use yii\helpers\Html;
use kartik\date\DatePicker;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Acopios;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LocalidadesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Reportes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reportes-index">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-success">
                <div class="panel-heading">
                    Generar Reportes
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(); ?>

                    <div class="row">
                        <div class="col-lg-4">
                            <?= $form->field($model, 'fde')->widget(DatePicker::classname(), [
                                'type' => DatePicker::TYPE_INPUT,
                                'options' => ['autocomplete' => 'off', 'value' => date("Y-m-d", strtotime("-1 month"))],
                                'pluginOptions' => [
                                    'autocomplete' => 'off',
                                    'format' => 'yyyy-mm-dd',
                                    'autoclose' => true,
                                ]
                            ]);
                            ?>
                        </div>
                        <div class="col-lg-4">
                            <?= $form->field($model, 'fha')->widget(DatePicker::classname(), [
                                'type' => DatePicker::TYPE_INPUT,
                                'options' => ['autocomplete' => 'off', 'value' => date("Y-m-d", strtotime("+1 month"))],
                                'pluginOptions' => [
                                    'autocomplete' => 'off',
                                    'format' => 'yyyy-mm-dd',
                                    'autoclose' => true,
                                ]
                            ]);
                            ?>
                        </div>

                        <div class="col-lg-4">
                            <?php $var = ArrayHelper::map(Acopios::find()->all(), 'id_aco', 'nom_aco'); ?>
                            <?= $form->field($model, 'aco')->dropDownList($var,['prompt' => ' - '], ['class' => 'form-control']) ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-11 text-right">
                        <?= Html::submitButton(Yii::t('app', 'Generar'), ['class' => 'btn btn-success btn-sm']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>