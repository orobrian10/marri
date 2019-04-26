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
            // $movimientos = Movimientos::find()->joinWith('acopios')->joinWith('lugaresacopios')->where(['between', 'fec_cos', $model->fde, $model->fha])->orderBy('fec_cos', 'asc')->all();

            $sql = "SELECT  cre_mov cre, id_mov id_mov, fec_cos fec_cos, can_mov can_mov, ori_mov ori_mov,nom_lug nom_lug, nom_aco nom_aco, cer_mov cer_mov, 1 tip, stock_ant_mov stock FROM movimientos " .
                " join acopios on des_mov = id_aco " .
                " join acopios_lugares on ori_mov = id_lug " .
                " where id_aco = $model->aco " .
                " UNION " .
                " SELECT  cre_ven cre, id_ven, fec_ven, kgs_ven, '','', nom_aco, cer_ven, 2, stock_ven FROM ventas " .
                " join acopios on des_ven = id_aco " .
                " where id_aco = $model->aco " .
                " order by cre asc";

            $db = Yii::$app->db;
            $command = $db->createCommand($sql);
            $res = $command->queryAll();

            $mpdf->WriteHTML($this->renderPartial('report', array('mov' => $res, 'fde' => $model->fde, 'fha' => $model->fha)));
            //$mpdf->Output("Movimientos.pdf", Destination::DOWNLOAD);
            $mpdf->Output();
            exit;
        endif;

        return $this->render('index', [
            'model' => $model
        ]);
    }

}
