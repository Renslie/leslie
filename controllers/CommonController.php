<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\Url;
use yii\helpers\Json;
use app\common\sms\Sms;
/**
 * @desc   公共控制器，需要权限验证的都继承此控制器
 * @author RZLIAO
 * @date   2016-1-12
 */
class CommonController extends Controller {

    public function beforeAction($event) {
        $auth   = Yii::$app->authManager;
        $isAjax = Yii::$app->request->getIsAjax();
        //未登录
        if (Yii::$app->user->isGuest) {
            if ($isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                Yii::$app->response->data = [
                    'status'  => -1,
                    'message' => '请先登录',
                    'url' => Yii::$app->getHomeUrl()
                ];
                return false;
            } else {
                return $this->goHome();
            }
        }
        //管理员拥有所有权限
        if(Yii::$app->user->identity->username ==  Yii::$app->params['admin'] ){
            return true;
        }

        $action = Yii::$app->controller->id . '/' . Yii::$app->controller->action->id;
        $action = strtolower($action);
        if(!$auth->getPermission($action)){
            return true;
        }

        //安全验证
        $session = Yii::$app->session;
        $con     = strtolower(Yii::$app->controller->id);
        if( Yii::$app->user->can($con. '/safe') ){
            if( !$session->get($action) ){
                $session['url'] = $action;
                return $this->redirect(Url::toRoute('site/validate-safe'));
            }
        }
        if (!Yii::$app->user->can($action)) {
            if ($isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                Yii::$app->response->data = [
                    'status' => -1,
                    'message' => '对不起,你无权进行此项操作',
                ];
                return false;
            } else {
                return $this->redirect(Url::toRoute(['site/error','error' => '对不起，您现在还没获此查看或操作的权限']));
            }
        } else {
            return parent::beforeAction($event);
        }
    }

    public function actions(){
        return [
            'uploads'=>[
                'class' => 'app\common\widgets\ueditor\UeditorAction',
                'config'=>[
                    //上传图片配置
                    'imageUrlPrefix' => "", /* 图片访问路径前缀 */
                    'imagePathFormat' => "/huhui_back/web/upload/{yyyy}{mm}{dd}{rand:6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */

                ]
            ],
            'upload'=>[
                'class' => 'app\common\widgets\file_upload\UploadAction',
                'config' => [
                    'imagePathFormat' => "/huhui_back/web/upload/{yyyy}{mm}{dd}{rand:6}",
                ]
            ],
        ];
    }

    protected function renderJson($params = []) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $params;
    }

    public function errorshow($error = ''){
        return $this->renderPartial('//site/error',['error' => $error]);
    }

    public function sms( $phone, $message ){
        $model = new Sms();
        $model->sendMessage($phone,$message);
    }
}
