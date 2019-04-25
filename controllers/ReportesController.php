<?php

namespace app\controllers;

use app\models\Movimientos;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\filters\AccessRule;
use Mpdf\Mpdf;
use app\models\Reportes;
use Mpdf\Output\Destination;

/**
 * LocalidadesController implements the CRUD actions for Localidades model.
 */
class ReportesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Localidades models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Reportes();

        if ($model->load(Yii::$app->request->post()) && $model->validate()):
            $mpdf = new mPDF();
            $movimientos = Movimientos::find()->where(['between', 'fec_cos', $model->fde, $model->fha])->orderBy('fec_cos', 'asc')->all();
            $mpdf->WriteHTML($this->renderPartial('report', array('mov' => $movimientos, 'fde' => $model->fde, 'fha' => $model->fha)));
            $mpdf->Output("Movimientos.pdf", Destination::DOWNLOAD);
            exit;
        endif;

        return $this->render('index', [
            'model' => $model
        ]);
    }

}
