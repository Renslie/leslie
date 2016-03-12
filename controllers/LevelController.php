<?php
namespace app\controllers;

use Yii;
use app\controllers\CommonController;
use app\models\Level;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;

class LevelController extends CommonController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Level models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Level::find(),
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Level model.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Level();

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            $model->commission = $model->changeCommission($data['Level']['num']);
            if($model->load( $data ) && $model->save()){
                return $this->redirect(['index']);
            }
            return $this->render('create', [
                'model' => new Level(),
            ]);
        } else {
            //  {"count":3,"num":[1,2,3]}
           // $model->commission
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Level model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            if($model->load($data)){
                $model->commission = (string)$model->changeCommission($data['Level']['num']);
                if($model->save())
                    return $this->redirect(['index']);
            }
        } else {
            $model->num = json_decode($model->commission)->num;
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Level model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Level model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Level the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Level::findOne($id)) !== null) {
            return $model;
        } else {
            throw  new \yii\web\NotFoundHttpException('The requested page does not exist.');
        }
    }
}
