<?php

namespace app\controllers;

use app\models\Cadastr;
use app\models\search\CadastrSearch;
use Yii;
use yii\httpclient\Client;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CadastrController implements the CRUD actions for Cadastr model.
 */
class CadastrController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class'   => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Cadastr models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CadastrSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cadastr model.
     * @param int $id
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
     * Creates a new Cadastr model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cadastr();

        if ($this->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            $file = \Yii::getAlias('@webroot') . Cadastr::SAVE_PATH . '/' . $model->file->baseName . '.' . $model->file->extension;
            $model->file->saveAs($file);
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader(\PhpOffice\PhpSpreadsheet\IOFactory::identify($file));
            $sprh = $reader->setReadDataOnly(true)->load($file)->getActiveSheet()->toArray();
            foreach ($sprh as $k => $v) {
                if ($k > 0) {
                    $model = new Cadastr();
                    $model->cn = $v[0];
                    $model->save(false);
                }
            }
            return $this->redirect([
                'index'
            ]);
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Cadastr model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        $models = Cadastr::find()->all();
        $client = new Client(['baseUrl' => 'https://soft.farm/api']);
        foreach ($models as $model) {
            $response = \yii\helpers\Json::decode($client->get('/open/cadastral/find-center-by-cadastral-number', ['clientId' => Yii::$app->params['clientId'], 'cadastralNumber' => $model->cn])->send()->content);
            if ($response['status']) {
                $model->status = $response['status'];
                $model->lat = $response['data']['lat'];
                $model->lng = $response['data']['lng'];
                $model->save(false);
            }
        }
        Yii::$app->getSession()->setFlash('success', 'Success!');

        return $this->redirect(['index']);

    }

    /**
     * Deletes an existing Cadastr model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cadastr model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Cadastr the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cadastr::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
