<?php

namespace app\controllers;

use app\models\Acopios;
use app\models\Campos;
use app\models\Variedades;
use Yii;
use app\models\Movimientos;
use app\models\MovimientosSearch;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\AccessRule;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\db\Connection;

/**
 * MovimientosController implements the CRUD actions for Movimientos model.
 */
class MovimientosController extends Controller
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
                        'actions' => ['index', 'create', 'update', 'view', 'getcampos', 'getvariedades', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Movimientos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MovimientosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Movimientos model.
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
     * Creates a new Movimientos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Movimientos();

        $connection = Yii::$app->db;
        $trans = $connection->beginTransaction();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            try {

                if ($model->tor_mov == 1):
                    $command = $connection->createCommand('UPDATE campos SET stock=(stock-' . $model->can_mov . ') WHERE id = ' . $model->ori_mov);
                else:
                    $command = $connection->createCommand('UPDATE acopios SET stock=(stock-' . $model->can_mov . ') WHERE id_aco = ' . $model->ori_mov);
                endif;
                $command->execute();

                if ($model->tde_mov == 1):
                    $command = $connection->createCommand('UPDATE campos SET stock=(stock+' . $model->can_mov . ') WHERE id = ' . $model->des_mov);
                else:
                    $command = $connection->createCommand('UPDATE acopios SET stock=(stock+' . $model->can_mov . ') WHERE id_aco = ' . $model->des_mov);
                endif;
                $command->execute();

                $model->save();

                $trans->commit();
                Yii::$app->session->setFlash('success', 'Se movieron ' . $model->can_mov . ' desde: ' . $model->ori_mov . ' hacia: ' . $model->des_mov);
                return $this->redirect(['index']);
            } catch (Exception $e) {
                $trans->rollBack();
                Yii::$app->session->setFlash('error', 'Error en la transacción, intente nuevamente ' . $e);
                return $this->redirect(['index']);
            }

            return $this->redirect(['view', 'id' => $model->id_mov]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Movimientos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $datos = $this->findModel($id);
        $model = $this->findModel($id);
        $connection = Yii::$app->db;
        $stockMov = $datos->can_mov;
        $idOrigen = $datos->ori_mov;
        $idDestino = $datos->des_mov;


        if ($model->load(Yii::$app->request->post())) {
            $trans = $connection->beginTransaction();
            if ($model->save()):

                try {
                    if ($datos->tor_mov == 1):
                        /*sumo lo restado anteriormente*/
                        $command = $connection->createCommand('UPDATE campos SET stock=(stock+' . $stockMov . ') WHERE id = ' . $idOrigen);
                        $command->execute();
                        /* resto el nuevo valor */
                        $command = $connection->createCommand('UPDATE campos SET stock=(stock-' . $model->can_mov . ') WHERE id = ' . $idOrigen);
                        $command->execute();
                    else:
                        /*sumo lo restado anteriormente*/
                        $command = $connection->createCommand('UPDATE acopios SET stock=(stock+' . $stockMov . ') WHERE id_aco = ' . $idOrigen);
                        $command->execute();
                        /* resto el nuevo valor */
                        $command = $connection->createCommand('UPDATE acopios SET stock=(stock-' . $model->can_mov . ') WHERE id_aco = ' . $idOrigen);
                        $command->execute();
                    endif;


                    if ($datos->tde_mov == 1):
                        /*resto lo sumado anteriormente*/
                        $command = $connection->createCommand('UPDATE campos SET stock=(stock-' . $stockMov . ') WHERE id = ' . $idDestino);
                        $command->execute();

                        /*sumo nuevo valor*/
                        $command = $connection->createCommand('UPDATE campos SET stock=(stock+' . $model->can_mov . ') WHERE id = ' . $idDestino);
                        $command->execute();
                    else:
                        /*resto lo sumado anteriormente*/
                        $command = $connection->createCommand('UPDATE acopios SET stock=(stock-' . $stockMov . ') WHERE id_aco = ' . $idDestino);
                        $command->execute();
                        /*sumo nuevo valor*/
                        $command = $connection->createCommand('UPDATE acopios SET stock=(stock+' . $model->can_mov . ') WHERE id_aco = ' . $idDestino);
                        $command->execute();
                    endif;

                    $trans->commit();
                    Yii::$app->session->setFlash('success', 'Se modificó el movimiento correctamente.');
                    return $this->redirect(['index']);
                } catch (Exception $e) {
                    $trans->rollBack();
                    Yii::$app->session->setFlash('error', 'Error en la transacción, intente nuevamente ' . $e);
                    return $this->redirect(['index']);
                }

            endif;

        }

        // && $model->save()

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Movimientos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $connection = Yii::$app->db;
        $datos = $this->findModel($id);
        $stockMov = $datos->can_mov;
        $idOrigen = $datos->ori_mov;
        $idDestino = $datos->des_mov;

        $trans = $connection->beginTransaction();

        try {
            if ($datos->tor_mov == 1):
                $command = $connection->createCommand('UPDATE campos SET stock=(stock+' . $stockMov . ') WHERE id = ' . $idOrigen);
            else:
                $command = $connection->createCommand('UPDATE acopios SET stock=(stock+' . $stockMov . ') WHERE id_aco = ' . $idOrigen);
            endif;
            $command->execute();

            if ($datos->tde_mov == 1):
                $command = $connection->createCommand('UPDATE campos SET stock=(stock-' . $stockMov . ') WHERE id = ' . $idDestino);
            else:
                $command = $connection->createCommand('UPDATE acopios SET stock=(stock-' . $stockMov . ') WHERE id_aco = ' . $idDestino);
            endif;
            $command->execute();

            $datos->delete();
            $trans->commit();
            Yii::$app->session->setFlash('success', 'Se eliminó el movimiento correctamente.');
            return $this->redirect(['index']);
        } catch (Exception $e) {
            $trans->rollBack();
            Yii::$app->session->setFlash('error', 'Error en la transacción, intente nuevamente ' . $e);
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Movimientos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Movimientos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Movimientos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /*public function getcampos()
    {
        echo "a";
        exit();
        //$campos = Campos::find()->where('=', ['id_cam', $id]);
        // echo Json::encode($campos);
    }*/

    public function actionGetcampos()
    {
        $tip = Yii::$app->request->post('id');
        if ($tip == 1):
            $res = Campos::find()->all();
        else:
            $res = Acopios::find()->all();
        endif;
        return Json::encode($res);
    }

    public function actionGetvariedades()
    {
        $id = Yii::$app->request->post('id');
        $res = Variedades::find()->where(['cer_var' => $id])->all();
        return Json::encode($res);
    }
}
