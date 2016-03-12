<?php

namespace app\controllers;
use Yii;
use dosamigos\qrcode\QrCode;
use app\controllers\CommonController;
use yii\data\ActiveDataProvider;
use app\models\Message;
use yii\helpers\Url;
/**
 * @desc   留言控制器
 * @author RZLIAO
 * @date   2016-1-12
 */
class MessageController extends CommonController
{
	public function actionIndex( $pages = 1 ){
		$query = Message::find()->where(['type' => 2,'status' => 1]);
		$provider = new ActiveDataProvider([
			'query' => $query,
            'pagination' => [
                'pageSize' => 3,
            ],
            'sort' => [
                'defaultOrder' => [
                    'create_time' => SORT_DESC,
                ]
            ],
	 	]);
	 	if(Yii::$app->request->isAjax){
	 		return $this->renderPartial('list', ['provider'=>$provider]);
	 	}
        return $this->render('index',['provider'=>$provider,'count'=>$query->count()]);
    }

    public function actionReply(){
    	$data  = Yii::$app->request->get();
    	$user  = Message::findOne($data['id']);
    	$return['status'] = 0;
    	$return['msg'] = '未找到此信息，请重启浏览器后重试···';
    	if($user){
            $return = $user->replay($data);
            $user->status = 2;
            $user->save();
        }
    	return $this->renderJson($return);
    }

    public function actionDone(){
    	$query = Message::find()->where(['status'=>2]);
    	$provider = new ActiveDataProvider([
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
    	return $this->render('done',['provider' => $provider]);
    }

    public function actionDel( $id ){
    	$model = Message::findOne($id);
    	if($model){
    		$img = $model->img;
    		$model->delete();
    		@unlink(Yii::getAlias('@app').'\..'.$model->img);
    		$return['status'] = 1;
    		$return['msg']    = '删除成功！';
    	}else{
    		$return['status'] = 0;
    		$return['msg']    = '删除失败';
    	}
    	return $this->renderJson($return);
    }

    /**
     * @desc   <img src="<?=Url::to(['message/qrcode'])?>" />
     */
    public function actionQrcode( $url ){
        return QrCode::png($url);
    }

    public function actionLiuyan(){
        $data = Yii::$app->request->get();
        if(isset($data['id']) && isset($data['liuyan'])){
            //给用户留言。产生新数据
            $mess = new Message();
            $mess->user_id     = $data['id'];
            $mess->title       = '后台信息';
            $mess->content     = $data['liuyan'];
            $mess->type        = 1;
            $mess->create_time = time();
            if($mess->save()){
                $result['status'] = 1;
                $result['msg']    = '留言成功';
            }else{
                $result['status'] = 0;
                $result['msg']    = '留言失败';
            }
            return $this->renderJson($result);
        }
        return $this->render('liuyan');
    }
}
