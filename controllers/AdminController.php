<?php
namespace app\controllers;
//aaa
use Yii;
use yii\web\Controller;
use app\controllers\CommonController;
use app\models\Admin;
use app\models\RoleForm;
use yii\data\ActiveDataProvider;
use app\common\ip\ipLocation;
use yii\helpers\ArrayHelper;
/**
 * @desc   管理员控制器
 * @author RZLIAO
 * @date   2016-1-12
 */
class AdminController extends CommonController
{
	public function actionIndex() {
		$model = Admin::find()->where(['!=','admin_id', 1]);  //第一个管理员为超级管理员  不列出来
		$provider = new ActiveDataProvider([
		    'query' => $model,
		    'pagination' => [
		        'pageSize' => 10,
		    ],
		    'sort' => [
		        'defaultOrder' => [
		            'create_time' => SORT_DESC,
		        ]
		    ],
		]);
		$listRoles = ArrayHelper::getColumn(Yii::$app->authManager->getRoles(), 'name');
		return $this->render('index',['provider' => $provider,'model'=>new Admin(['scenario' => 'user']),'list' => $listRoles]);
	}

	//修改或者新增用户
	public function actionEdit () {
		$auth = Yii::$app->authManager;
        $data = Yii::$app->request->post('Admin');

        if(is_numeric($data['admin_id']) && $data['admin_id']>0){
        	$user = Admin::findOne($data['admin_id']);
        	$user->scenario = 'user';
		    if (!$user) {
		        $result['status'] = 0;
		        $result['message'] = '未找到该记录';
		    } else {
		        $oldPassword = $user->password;
		    }
        }else{
        	$user = new Admin(['scenario'=>'user']);
        }

        if ($user->load(Yii::$app->request->post())) {
        	if (!$user->isNewRecord && $user->password != '******') {
                $oldPassword = Yii::$app->security->generatePasswordHash($user->password);
            }
            if($user->isNewRecord){
            	if(Admin::findByUsername($user->username)){
            		$result['status']  = 0;
		        	$result['message'] = '此名字已存在';
		        	return $this->renderJson($result);
            	}
            }
        	if($user->save()){
        		if(isset($oldPassword)){
                    Admin::updateAll(['password'=>$oldPassword], 'admin_id=:id', [':id'=>$user->admin_id]);
                }

                //分配权限
                $auth->revokeAll($user->admin_id);
                foreach ($user->roles as $rolename) {
                    if ($role = $auth->getRole($rolename)) {
                        $auth->assign($role, $user->admin_id);
                    }
                }
			    $result['status'] = 1;
                $result['message'] = '保存成功';
        	}
        }
        $errors = $user->getFirstErrors();
        if ($errors) {
            $result['status'] = 0;
            $result['message'] = current($errors);
        }
        return $this->renderJson($result);
	}

    //删除用户
    public function actionDel(){
        $id = Yii::$app->request->post('id');
        $user = Admin::findOne( $id );
        if(!$user){
            $result['status']  = 0;
            $result['message'] = '未找到此用户';
        }else{
            $user->delete();
            $result['status'] = 1;
            $result['message'] = '保存成功';
        }
        return $this->renderJson($result);
    }

    //修改密码
    public function actionEditself(){

    	$model = new Admin(['scenario'=>'edit']);
    	if($model->load(Yii::$app->request->post())){

    		if($model->editProfile(Yii::$app->user->identity->id)){
    			Yii::$app->user->logout();
       			return $this->goHome();
    		}
    	}
    	return $this->render('edit',['model'=>$model]);
    }

    public function actionRole() {
        $permissions = [
            ['name' => 'orders/index', 'description' => '首页订单管理', 'child' => [
                ['name' => 'orders/index1', 'description' => '帮助订单','child'=>[
                	//['name' => 'orders/safe1', 'description' => '安全验证'],
                ]],
                ['name' => 'orders/index2', 'description' => '订单管理'],
                ['name' => 'orders/index3', 'description' => '异常订单'],
                ['name' => 'orders/safe', 'description' => '安全验证'],
            ]],
            ['name' => 'User', 'description' => '用户管理' , 'child'=>[
            	['name' => 'user/unactive', 'description' => '未激活用户列表'],
            	['name' => 'user/editactive', 'description' => '激活内容修改'],
            	['name' => 'user/index', 'description' => '正常用户'],
            	['name' => 'user/disable', 'description' => '封号用户'],
            	['name' => 'user/fenghao', 'description' => '封号操作'],
                ['name' => 'user/addmoney', 'description' => '金币增减'],
            	['name' => 'user/money-log', 'description' => '金币记录'],
            	['name' => 'user/relate', 'description' => '会员关系查看'],
				['name' => 'user/safe', 'description' => '安全验证'],
            ]],
            ['name' => 'news/index', 'description' => '资讯管理', 'child' => [
            	//['name' => 'news/index' ,'description' => '资讯列表'],
            	//['name' => 'news/creat' ,'description' => '资讯创建'],
            	//['name' => 'news/update' ,'description' => '资讯修改'],
            	//['name' => 'news/delete' ,'description' => '资讯删除'],
            	['name' => 'news/safe', 'description' => '安全验证'],
            ]],
            ['name' => 'Message' , 'description' => '留言管理' ,'child'=>[
            	//['name' => 'message/index', 'description' => '留言列表'],
            	//['name' => 'message/reply', 'description' => '留言回复'],
            	//['name' => 'message/done', 'description' => '已处理留言列表'],
            	//['name' => 'message/del', 'description' => '删除留言' ],
            	['name' => 'message/safe', 'description' => '安全验证'],
            ]],
            ['name' => 'Rule' , 'description' => '规则管理', 'child' =>[
            	//['name' => 'order/rules', 'description' => '规则列表'],
            	//['name' => 'order/edit', 'description' => '规则修改'],
            	['name' => 'rule/safe', 'description' => '安全验证'],
            ]],
            ['name' => 'Level', 'description' => '等级管理', 'child' =>[
            	//['name' => 'level/index', 'description' => '等级查看'],
            	//['name' => 'level/create', 'description' => '添加等级'],
            	//['name' => 'level/update', 'description' => '等级修改'],
            	//['name' => 'level/delete', 'description' => '等级删除'],
            ]],
            ['name' => 'Admin', 'description' => '管理员管理', 'child' => [
            	//['name' => 'admin/index', 'description' => '管理员查看'],
            	//['name' => 'admin/edit', 'description' => '管理员修改'],
            	//['name' => 'admin/create', 'description' => '管理员创建'],
            	//['name' => 'admin/delete', 'description' => '管理员删除'],
            	['name' => 'admin/safe', 'description' => '安全验证'],
            ]],
            ['name' => 'Role', 'description' => '角色管理', 'child' =>[
            	//['name' => 'role/index', 'description' => '角色查看'],
            	//['name' => 'role/edit', 'description' => '角色修改'],
            	//['name' => 'role/create', 'description' => '角色添加'],
            	//['name' => 'role/delete', 'description' => '角色删除'],
            ]],
        ];
        return $this->render('role', ['model' => new RoleForm(), 'permissions' => $permissions]);
    }

    public function actionRolelist() {
        $model = Yii::$app->authManager->getRoles();
        return $this->renderPartial('rolelist', ['model' => $model]);
    }

    public function actionRoleedit() {
        $auth = Yii::$app->authManager;
        $model = new RoleForm();
        $result = [];
        if ($model->load(Yii::$app->request->post())) {
            $role = $auth->getRole($model->name);
            if (!$role) {
                $role = $auth->createRole($model->name);
                $auth->add($role);
            }
            //分配权限
            $oldPermissions = [];
            if ($auth->getPermissionsByRole($role->name)) {
                $oldPermissions = ArrayHelper::getColumn($auth->getPermissionsByRole($role->name), 'name');
            }

            is_array($model->permissions) ? $newPermissions = $model->permissions : $newPermissions = array();
            //计算交集
            $intersection = array_intersect($newPermissions, $oldPermissions);
            //需要增加的权限
            $newPermissions = array_diff($newPermissions, $intersection);
            //需要删除的权限
            $oldPermissions = array_diff($oldPermissions, $intersection);

            foreach ($newPermissions as $new) {
                $auth->addChild($role, $auth->getPermission($new));
            }
            foreach ($oldPermissions as $old) {
                $auth->removeChild($role, $auth->getPermission($old));
            }
            $result['status'] = 1;
            $result['message'] = '保存成功';
        }
        $errors = $model->getFirstErrors();
        if ($errors) {
            $result['status'] = 0;
            $result['message'] = current($errors);
        }
        return $this->renderJson($result);
    }

    public function actionGetpermissionsbyrole($name) {
        $result = [];
        $auth = Yii::$app->authManager;
        $permissions = $auth->getPermissionsByRole($name);
        if ($permissions) {
            foreach ($permissions as $p) {
                $result[] = $p->name;
            }
        }
        return $this->renderJson($result);
    }


    public function actionRoledel($name) {
        $result = [];
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($name);
        if ($role) {
            $auth->remove($role);
        }
        $result['status'] = 1;
        $result['message'] = '删除成功';
        return $this->renderJson($result);
    }

    private function getChild($item) {
        $auth = Yii::$app->authManager;
        $item = (array) $item;
        if ($childs = $auth->getChildren($item['name'])) {
            foreach ($childs as $child) {
                $item['child'][] = $this->getChild($child);
            }
            return $item;
        } else {
            return $item;
        }
    }
}
