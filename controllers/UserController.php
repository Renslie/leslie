<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use app\controllers\CommonController;
use app\models\UserRelation;
use app\models\JihuoPrompt;
use app\models\Level;
use app\models\Orders;
use app\models\Gethelp;
use app\models\Payhelp;
use app\models\BackMoneyLog;

/**
 * @desc   普通用户管理控制器
 * @author RZLIAO
 * @date   2016-1-13
 */
class UserController extends CommonController
{
    /**
     * 显示正常用户
     * @return mixed
     */
    public function actionIndex()
    {
        $query = User::find();
        //当用户请求的正常用户界面的话，默认1 ，未激活则为2 ，封号则为3
        $type = Yii::$app->request->get('type') or $type = 1;
        switch ($type) {
            case 1:
                //正常用户
                $query->andFilterWhere(['level_id' => Yii::$app->request->get('level')]);
                $query->andFilterWhere(['is_active' => Yii::$app->request->get('is_active')]);
                $query->andFilterWhere(['status'=>1]);
                $level = Level::find()->all();
                break;
            case 2:
                //未激活则为2
                $query->andFilterWhere(['status'=>1,'is_active'=>0]);
                break;
            case 3:
                //封号用户
                $query->andFilterWhere(['!=','status',1]);
                break;
            case 4:
                $level = Level::find()->all();
                $query->where(['ip_id'=> Yii::$app->request->get('ip')]);
                break;
            default:
                return $this->errorshow();
                break;
        }
        $query->andFilterWhere(['like', 'user_id', Yii::$app->request->get('id')]);
        $query->orFilterWhere(['like', 'nickname', Yii::$app->request->get('id')]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'create_time' => SORT_DESC,
                ]
            ],
        ]);
        $data = ['dataProvider' => $dataProvider];
        if($type == 1 || $type == 4) {
            $data += ['level' => $level,'model'=>new User()];
        }
        return $this->render('index'.$type, $data);
    }

    public function actionEdituser() {

        if( Yii::$app->request->getIsAjax() ){
            $data = Yii::$app->request->post();
            $model = $this->findModel($data['User']['user_id']);
            $res['status']   = 0;
            $res['message']  = '修改失败';
            if( $model->load($data) ){
                if(isset($data['User']['bank'])){
                    $model->bank = json_encode($model->bank);
                }
                if($model->save()){
                    $res['status']   = 1;
                    $res['message']  = '修改成功';
                }
            }
            return $this->renderJson($res);
        }
    }

    /**
     * 获取用户数据 ajax     暂不用
     * @return mixed
     */
    // public function actionList()
    // {
    //     $query = User::find();
    //     $query->andFilterWhere(['user_id' => Yii::$app->request->get('id')]);
    //     $query->andFilterWhere(['account' => Yii::$app->request->get('account')]);
    //     $query->andFilterWhere(['level_id' => Yii::$app->request->get('level')]);
    //     $query->andFilterWhere(['is_active' => Yii::$app->request->get('is_active')]);
    //     $dataProvider = new ActiveDataProvider([
    //         'query' => $query,
    //     ]);

    //     return $this->renderPartial('index', [
    //         'dataProvider' => $dataProvider,
    //     ]);
    // }


    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDeleted($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionActived($id){
        $user = $this->findModel($id);
        $user->is_active = 1;
        $user->save();
        $this->sms($user->phone, '您的账号: '.$user->account.' ,已激活');
        return $this->redirect(['index']);
        //或者跳转到激活页面显示出来
    }

    //public function action
    public function actionFenghao(){
        $data = Yii::$app->request->get();
        if(isset($data['id'])){
            $user = $this->findModel($data['id']);
            $user->status = $data['liyou'];
            if($user->save()){
                $result['status'] = 1;
                $result['msg']    = '封号成功';
                Gethelp::updateAll(['status' => 4], 'user_id=:id', [':id'=>$user->user_id]);
                Payhelp::updateAll(['status' => 4], 'user_id=:id', [':id'=>$user->user_id]);
            }else{
                $result['status'] = 0;
                $result['msg']    = '封号失败';
            }
            return $this->renderJson($result);
        }
        if(isset($data['find'])){
            $user = User::find()->andFilterWhere(['like','account',$data['find']])
                                ->orFilterWhere(['like','nickname',$data['find']])
                                ->one();
            return $this->renderPartial('fenghao1',['model'=>$user]);
        }
        return $this->render('fenghao');
    }


    public function actionHuifu($id){

        $user = $this->findModel($id);
        $user->status = '1';
        Gethelp::updateAll(['status' => 4], 'user_id=:id', [':id'=>$user->user_id]);
        Payhelp::updateAll(['status' => 4], 'user_id=:id', [':id'=>$user->user_id]);
        $user->save();
        return $this->redirect(['index']);
        //或者跳转到激活页面显示出来
    }

    public function actionAddmoney(){
        $data = Yii::$app->request->get();
        if(isset($data['name'])){
            $model = User::find()
            ->orFilterWhere(['like', 'account', Yii::$app->request->get('name')])
            ->orFilterWhere(['like', 'nickname', Yii::$app->request->get('name')])->one();
            if($model) return $this->renderPartial('money_ajax',['model'=>$model]);
            $return['status'] = 5;
            $return['msg']    = '查无此用户';
            return $this->renderJson($return);
        }elseif(isset($data['add'])){
            $model = User::findOne($data['id']);
            $model->flow_money = $data['add']==1? $model->flow_money + $data['mon'] : $model->flow_money - $data['mon'];
            if($model->save()){
                $log = new BackMoneyLog();
                $log->user_id       = $data['id'];
                $log->user_name     = $model->nickname;
                $log->target      = Yii::$app->user->identity->username;
                $log->log         = ($data['add']==1? '增加了' : '减少了' ).$data['mon'].'金币';
                $log->create_time = time();
                $log->save();
                $return['msg'] = '操作成功！';
            }else{
                $return['msg'] = '操作失败！';
            }
            return $this->renderJson($return);
        }
        return $this->render('money');
    }

    public function actionMoneyLog(){
        $provider = new ActiveDataProvider([
            'query' => BackMoneyLog::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'create_time' => SORT_DESC,
                ]
            ],
        ]);
        return $this->render('money_log',['provider' => $provider]);
    }

    //关系图
    public function actionRelate(){
        $tree_data = (new UserRelation())->getTreeData(0);
        $data['tree_data'] = json_encode($tree_data);

        return $this->render('relate',$data);
    }


    /**
     * 关系图--获取用户信息
     *
     * @return string
     */
    public function actionUserinfo(){
        $this->layout = false;
        $request = Yii::$app->request;
        $user_id = $request->get('user_id');

        $user_info = (new User())->find()
                ->select('user_id,nickname,account,phone,create_time')
                ->where(['user_id'=>$user_id])
                ->asArray()->one();
        $parent = (new UserRelation())->find()
            ->leftJoin(['u'=>'hl_user'],'u.user_id=hl_user_relation.parent_id')
            ->select('u.nickname')
            ->where(['hl_user_relation.user_id'=>$user_id])
            ->asArray()->one();

        $user_info['parent'] = isset($parent['nickname']) ? $parent['nickname'] : '';


        $data['user_info'] = $user_info;
        return $this->renderPartial('relate_user_ajax',$data);
    }

    /**
     * 更新用户关系
     *
     * @return string
     */
    public function actionRelationedit(){
        $request = Yii::$app->request;
        $user_id = $request->get('user_id');
        $parent_id = $request->get('parent_id');

        $user = User::findOne($user_id);
        $parent = User::findOne($parent_id);

        /**
         * 判断要修改的上线是否是自己的下线.
         */
        $childs = (new UserRelation())->checkChild($user_id,$parent_id);
        if($childs){
            $msg['status'] = 0;
            $msg['error'] = "不能成为自己下线的下线!";
        }

        if(isset($msg)){
            //跳出
        }else if(!$user || !$parent){
            $msg['status'] = 0;
            $msg['error'] = '用户不存在!';
        }else{

            $Relation = UserRelation::findOne($user_id);

            $Relation->parent_id = $parent_id;
            $res = $Relation->save();

            if($res){
                $msg['status'] = 1;
            }else{
                $msg['status'] = 0;
                $msg['error'] = '更新关系失败!';
            }
        }

        return json_encode($msg);
    }

    //修改激活提示页面内容
    public function actionEditactive(){
        $model = JihuoPrompt::findOne(1);
        if(Yii::$app->request->isPost){
            $data = Yii::$app->request->post();
            $res['status'] = 0;
            $res['status'] = '修改失败';
            if($model->load($data) && $model->save()){
                $res['status'] = 1;
                $res['status'] = '修改成功';
            }
            return $this->renderJson($res);
        }
       return $this->render('editactive',['model' => $model]);
    }
}
