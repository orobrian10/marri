<?php

namespace app\controllers;

use app\models\Movimientos;
use app\models\Ventas;
use Yii;
use app\models\Cereales;
use app\models\CerealesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\filters\AccessRule;

/**
 * CerealesController implements the CRUD actions for Cereales model.
 */
class CerealesController extends Controller
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
                        'actions' => ['index', 'create', 'update', 'view', 'findModel', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Cereales models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CerealesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(['pageSize' => 10]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cereales model.
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
     * Creates a new Cereales model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cereales();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'El cereal ' . $model->nom_cer . ' se agregó correctamente.');
            return $this->redirect('index');
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Cereales model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'El cereal ' . $model->nom_cer . ' se modificó correctamente.');
            return $this->redirect('index');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Cereales model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $validate = Movimientos::find()->where('cer_mov = ' . $id)->count();
        if ($validate > 0):
            Yii::$app->session->setFlash('error', 'No se puede eliminar esta localidad porque está en uso');
        else:
            $validate = Ventas::find()->where('cer_ven = ' . $id)->count();
            if ($validate > 0):
                Yii::$app->session->setFlash('error', 'No se puede eliminar esta localidad porque está en uso');
            else:
                $cer = Cereales::findOne($id);
                $res = $cer->delete();
                if ($res):
                    Yii::$app->session->setFlash('success', 'Eliminado correctamente');
                endif;
            endif;
        endif;

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cereales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cereales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cereales::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
