<?php
namespace app\controllers;

use Yii;
use app\controllers\CommonController;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use app\models\News;
use app\models\JihuoPrompt;
use app\models\Comments;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class NewsController extends CommonController
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

	public function actionIndex (){
		$dataProvider = new ActiveDataProvider([
            'query' => News::find()->where('news_id != 1'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
	}

	/**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

     /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionNewtips(){
        $model   = News::findOne(1)?:new News();
        if(Yii::$app->request->isPost){
			$model->news_id = 1;
            $data = Yii::$app->request->post();
            $res['status'] = 0;
            $res['message'] = '修改失败';
            if($model->load($data) && $model->save()){
                $res['status'] = 1;
                $res['message'] = '修改成功';
            }
            return $this->renderJson($res);
        }
       return $this->render('new_people',['model' => $model]);
    }

    public function actionComment(){
        $provider = new ActiveDataProvider([
            'query' => Comments::find()->where(['status'=>0]),
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'create_time' => SORT_DESC,
                ]
            ],
        ]);
        return $this->render('comment',['provider'=> $provider]);
    }

    public function actionCommentDeal(){
        $data  = Yii::$app->request->post();
        $model = Comments::findOne( $data['id'] );
        $return  = [
            'status'  => 0,
            'message' => '操作失败',
        ];
        if( $data['type'] == 'pass' ){
            $model->status = 1;
            $model->save();
            $return  = [
                'status'  => 1,
                'message' => '审核成功！',
            ];
        }else{
            $model->delete();
             $return  = [
                'status'  => 2,
                'message' => '删除成功',
            ];
        }
        return $this->renderJson($return);
    }
}
