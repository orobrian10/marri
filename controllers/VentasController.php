<?php

namespace app\controllers;

use Yii;
use app\models\Ventas;
use app\models\VentasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Acopios;

/**
 * VentasController implements the CRUD actions for Ventas model.
 */
class VentasController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Ventas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VentasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ventas model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Ventas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ventas();

        $model->stock_ven = 1;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $connection = Yii::$app->db;
            $trans = $connection->beginTransaction();

            try {

                $values_ant = Acopios::findOne(['id_aco', $model->des_ven]);
                $model->stock_ven = $values_ant->stock;

                $model->save();
                $command = $connection->createCommand('UPDATE acopios SET stock=(stock-' . $model->kgs_ven . ') WHERE id_aco = ' . $model->des_ven);
                $command->execute();

                $trans->commit();
                Yii::$app->session->setFlash('success', 'Venta realizada correctamente');
                return $this->redirect(['index']);
            } catch (Exception $e) {
                $trans->rollBack();
                Yii::$app->session->setFlash('error', 'Error en la transacción, intente nuevamente ' . $e);
                return $this->redirect(['index']);
            }


        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Ventas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $datos = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $connection = Yii::$app->db;
            $trans = $connection->beginTransaction();

            try {
                if ($model->save()):

                    // Sumo venta descontatada anteriormente
                    $kgs_anterior = $datos->kgs_ven;
                    $command = $connection->createCommand('UPDATE acopios SET stock=(stock+' . $kgs_anterior . ') WHERE id_aco = ' . $model->des_ven);
                    $command->execute();

                    // Resto venta nueva
                    $command = $connection->createCommand('UPDATE acopios SET stock=(stock-' . $model->kgs_ven . ') WHERE id_aco = ' . $model->des_ven);
                    $command->execute();

                    $trans->commit();
                    Yii::$app->session->setFlash('success', 'Venta modificada correctamente');
                    return $this->redirect(['index']);
                endif;
            } catch (Exception $e) {
                $trans->rollBack();
                Yii::$app->session->setFlash('error', 'Error en la transacción, intente nuevamente ' . $e);
                return $this->redirect(['index']);
            }

            return $this->redirect(['view', 'id' => $model->id_ven]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Ventas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $connection = Yii::$app->db;
        $datos = $this->findModel($id);
        $kgs = $datos->kgs_ven;
        $idDestino = $datos->des_ven;

        $trans = $connection->beginTransaction();

        try {

            $command = $connection->createCommand('UPDATE acopios SET stock=(stock+' . $kgs . ') WHERE id_aco = ' . $idDestino);
            $command->execute();

            $datos->delete();
            $trans->commit();
            Yii::$app->session->setFlash('success', 'Se eliminó la venta correctamente.');
            return $this->redirect(['index']);
        } catch (Exception $e) {
            $trans->rollBack();
            Yii::$app->session->setFlash('error', 'Error en la transacción, intente nuevamente ' . $e);
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Ventas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ventas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ventas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
