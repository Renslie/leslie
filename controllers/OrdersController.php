<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use app\controllers\CommonController;
use app\models\Gethelp;
use app\models\GethelpRule;
use app\models\Payhelp;
use app\models\PayhelpRule;
use app\models\BonusType;
use app\models\Orders;
use app\models\User;
use app\models\JihuoPrompt;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use app\common\widgets\excel\excel;
use yii\filters\VerbFilter;
/**
 * @desc   订单管理控制器
 * @author RZLIAO
 * @date   2016-1-22
 */
class OrdersController extends CommonController
{
	public function actionIndex(){
		//渲染视图
		//测试redis
		// Yii::$app->cache->set('test', 'hehe..');
		// echo Yii::$app->cache->get('test'), "\n";

		// Yii::$app->cache->set('test1', 'haha..', 5);
		// echo '1 ', Yii::$app->cache->get('test1'), "\n";
		// sleep(6);
		// echo '2 ', Yii::$app->cache->get('test1'), "\n";
		// // Yii::$app->cache->set('test','111',5);  //设置redis缓存
		// // //Yii::$app->redis->del('test');
		// // echo Yii::$app->cache->get('test');   
		//exit;
		return $this->render('index');
	}

	//各类型订单显示页面
	public function actionList( $page = 1 ){
		//默认获取帮助页面
		$type = Yii::$app->request->get('type') or $type = 1;  //帮助页面 1为 提供者， 2为接受者
		switch ($type) {
			case 1 :
			case 2 :
				if($type == 1){
					$model = Payhelp::find()->select(['pay_id'])->where(['status' => 1]);
					//$model->leftJoin('hl_user', 'hl_user.user_id = hl_payhelp.user_id');
					//$model->orFilterWhere(['like','account', Yii::$app->request->get('id')]);
					$id    = 'pay_id';
				}else{
					$model = Gethelp::find()->select(['get_id'])->where(['status' => 1]);
					$id    = 'get_id';
				}
				$status[] = Yii::$app->request->get('status') or $status = [1];  // 1 为匹配中 2为待~~
				$query    = Orders::find()->where([$id => $model,'status' => $status]);
				//dump($query->asArray()->all());
				break;
			case 3 :
				$status = Yii::$app->request->get('status');
				$query = Orders::find();
				if( $status == 1 ){
					//交易完成订单
					$query->where(['status' => 7]);
				}else{
					$query->where(['in', 'status', [2,3]]);
				}
				break;
			case 8 :
				//初始显示所有数据
				$query = Orders::find()->where(['in' ,'status',[1,2,3]]);
				break;
			default:
				//剩下的为异常的订单
				$status = Yii::$app->request->get('status');
				$query = Orders::find()->where(['status' => $status]);
				break;
		}
		if(Yii::$app->request->get('time1') && Yii::$app->request->get('time2')){
			$t1 = Yii::$app->request->get('time1');
			$t2 = Yii::$app->request->get('time2');
			$starTime =  strtotime("$t1-$t2-1 00:00:00");
			$endTime  =  strtotime("$t1-$t2-1 00:00:00 +1 month")-1;
			$query->andWhere(
				'create_time between :startime and :endtime',
				[':startime'=>$starTime, ':endtime' => $endTime]
			);
		}
		$query->andFilterWhere(['like', 'mate_id', Yii::$app->request->get('id')]); //can not一个字段同时搜索订单号、搜索用户名
		if( !Yii::$app->request->getIsAjax() ){
			//导出数据
			$arr = [];
			foreach($query->all() as $model){
				$arr[] = $model->exceldata();
			}
			$this->excel($arr,Yii::$app->request->get('title'));
			die;
		}

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
		return $this->renderPartial('list', ['provider' => $provider, 'type' => $type]);
	}

	//匹配查找订单
	public function actionSearch(){
		$id = Yii::$app->request->post('id');
		$order = Orders::findOne( $id );
		if($order){
			$return = $order->searchOrder();
			if(!isset($return['status'])) return $this->renderPartial('alert',['orders' => $return]);
		}else{
			$return['status']  = 0;
			$return['message'] = '查无此订单';
		}
		return $this->renderJson($return);
	}

	//将双方订单真正匹配
	public function actionMatch(){
		if(!Yii::$app->request->getIsAjax()) return $this->errorshow();  //以后换成行为验证
		$data = Yii::$app->request->post();
		/*
		[one] => 96
		[two] => Array
		    (
		        [0] => Array
		            (
		                [0] => 75
		                [1] => 700
		            )

		        [1] => Array
		            (
		                [0] => 102
		                [1] => 500
		            )

		    )
		    96  47  -> pay 75 102
	     */
	    $model1   = Orders::findOne( $data['one'] );  //需要拆的

  		if(is_numeric($data['one']) && is_array($data['two'])  && (count($data['two']) != 0)  && count($data['two']) == count($data['two']) ){
  			$return = $model1->splitOrder( $data['two'] ,1);
  			$model1->delete();
  			// foreach( $model1->splitOrder($data['thr']) as $k => $v ){
  			// 	$order1 = Orders::findOne($data['two'][$k]);
  			// 	$order2 = Orders::findOne($v);
  			// 	$return = $this->matchd($order1, $order2);
  			// }
  		}else{
  			$return['status']  = 0;
		    $return['message'] = 'UNKONW ERROR';
  		}
  		return $this->renderJson($return);
	}

	private function matchd($model1, $model2){
		//if( $model1 instanceof app\models\Orders)
		if(($model1 instanceof Orders) && ($model2 instanceof Orders) && ($model1->money == $model2->money)){
			$type  = $model1->get_id == 0 ? 'pay_id' : 'get_id';
			$connection = Yii::$app->db;
			$transaction = $connection->beginTransaction();
			try {
		        $new = new Orders();
		        $new->status = 2;
		        $new->money  = $model1->money;
		        if( $type === 'pay_id' ){
		        	$new->get_id = $model2->get_id;
		        	$new->pay_id = $model1->pay_id;
		        }else{
		        	$new->pay_id = $model2->pay_id;
		        	$new->get_id = $model1->get_id;
		        }
		        if($new->save()){
					//Payhelp::updateAll(['status' => 2], 'pay_id = '.$new->pay_id);
					//Gethelp::updateAll(['status' => 2], 'get_id = '.$new->get_id);
		        	$model1->delete();
		        	$model2->delete();
		        	$return['status']  = 1;
		        	$return['message'] = '匹配成功';
		        	$this->sms($new->pay->user->phone, '尊敬的用户，您有订单号已匹配成功，请登录查看');
		        	$this->sms($new->get->user->phone, '尊敬的用户，您有订单号已匹配成功，请登录查看');
		        }
		        $transaction->commit();
		    } catch (Exception $e) {
		    	$return['status']  = 0;
		    	$return['message'] = '程序发生错误，请联系网站管理员';
		        $transaction->rollBack();
		    }
		}else{
			$return['status']  = 0;
		    $return['message'] = '订单匹配出现问题，操作失败';
		}
	    return $return;
	}

	//拆分
	public function actionSplit(){
		//id 分成的额度
		if(!Yii::$app->request->getIsAjax()) return $this->errorshow();  //以后换成行为验证
		$data = Yii::$app->request->post();
		/*
		[id] => 52
	    [arr] => Array
	        (
	            [0] => 1500
	            [1] => 1000
	        )
		 */
		$model = Orders::findOne($data['id']);
		//验证··
		if( ($model->status == 1) && is_array($data['arr']) && count($data['arr'])>0 ){
			//为了安全
			$return = $model->splitOrder($data['arr']);
			if($return['status'] == 1) $model->delete();  //删除旧订单
		}else{
			$return['status']  = 0;
		    $return['message'] = '订单拆分失败，请刷新后重试';
		}
		return $this->renderJson($return);
	}

	//查找可合并订单
	public function actionSearchCombine(){
		if(!Yii::$app->request->getIsAjax()) return $this->errorshow();  //以后换成行为验证
		$id = Yii::$app->request->post('id');  //传输过来的 id
		//寻找此订单的同父类订单
		$old  = Orders::findOne($id);
		if($old && $old->status ==1 && ($old->get_id == 0 || $old->pay_id == 0)){
			$type = $old->get_id == 0 ? 'pay_id' : 'get_id';
			$new  = Orders::find()->where([$type => $old->$type, 'status' => 1])->andWhere(['!=', 'mate_id', $old->mate_id])->all();
			if(count($new)>=1) return $this->renderPartial('alert', ['orders' => $new]);
			$return['status']  = 0;
			$return['message'] = '暂无可合并的订单';
		}else{
			$return['status']  = 0 ;
			$return['message'] = '订单信息错误' ;
		}
		return $this->renderJson($return);
	}

	public function actionCombine(){
		$data = Yii::$app->request->post();
		// [one] => 35
  		// [two] => 34
  		if(is_numeric($data['one']) && is_numeric($data['two']) ){
  			$model1 = Orders::findOne( $data['one'] );
  			$model2 = Orders::findOne( $data['two'] );
  			if($model1 && $model2 && ($model1->get_id == $model2->get_id || $model1->pay_id == $model2->pay_id)){
  				$connection = Yii::$app->db;
				$transaction = $connection->beginTransaction();
				try {
					$new = new Orders();
					if($model1->pay_id == 0){
						$new->get_id = $model1->get_id;
					}else{
						$new->pay_id = $model1->pay_id;
					}
					$new->money = ($model1->money + $model2->money);
					$new->save();
					$model1->delete();
					$model2->delete();
					$return['status']  = 1;
			    	$return['message'] = '合并成功';
					$transaction->commit();
				} catch (Exception $e) {
					$return['status']  = 0;
			    	$return['message'] = '程序发生错误，请检查网络后重试····';
					$transaction->rollBack();
				}
			}else{
				$return['status']  = 0;
		   		$return['message'] = '订单信息错误。合成失败';
			}
  		}else{
  			$return['status']  = 0;
		    $return['message'] = 'UNKONW ERROR';
  		}
  		return $this->renderJson($return);
	}

	//删除订单
	public function actionDelorder(){
		$id = Yii::$app->request->post('id');
		if(!$id) {
			$res['status']  = 0;
			$res['message'] = '未找到此订单';
			return $this->renderJson( $res );
		}
		$order = Orders::findOne($id);

		if( $order->status == 7 ){
			$order->delete();
			$res['status']  = 1;
			$res['message'] = '删除成功';
		}else{
			$res['status']  = 0;
			$res['message'] = '订单未完成不能删除';
		}
		return $this->renderJson( $res );
	}

	//规则页面
	public function actionRules(){

		if( Yii::$app->user->can('rule/safe') ){
			$session = Yii::$app->session;
			if( !$session->get('rule/safe') ){  //判断是否存在访问地址
                $session['url'] = 'rule/safe';  //记录跳转地址
                return $this->redirect(Url::toRoute('site/validate-safe'));
            }
		}
		//获取数据  - -！  类似数据字典 只有一条数据
		$get = GethelpRule::findOne(1);
		$pay = PayhelpRule::findOne(1);
		$tj  = BonusType::findOne(1);
		$jl  = BonusType::findOne(2);
		$tt  = JihuoPrompt::findOne(1);
		if(Yii::$app->request->isPost){
			$data = Yii::$app->request->post();
			$return['message'] = '保存失败';
			$return['status']  = 0;
			if( isset($data['GethelpRule']) ){

				if($get->load($data) && $get->save()){
					$return['message'] = '保存成功';
					$return['status']  = 1;
				}
			}elseif( isset($data['PayhelpRule']) ){

				if($pay->load($data) && $pay->save()){
					$return['message'] = '保存成功';
					$return['status']  = 1;
				}
			}elseif( isset($data['BonusType']) ){

				$bon = BonusType::findOne($data['BonusType']['bonus_type_id']);
				if($bon->load($data) && $bon->save()){
					$return['message'] = '保存成功';
					$return['status']  = 1;
				}
			}elseif( isset($data['JihuoPrompt']) ){

				if($tt->load($data) && $tt->save()){
					$return['message'] = '保存成功';
					$return['status']  = 1;
				}
			}
			return $this->renderJson($return);
		}

		return $this->render('rules',['get' => $get, 'pay' => $pay, 'tj' => $tj, 'jl' => $jl, 'tt' => $tt]);
	}

	private function excel( $data, $eTitle = ''){
		$title  = [
        	'订单号','会员名','姓名','支付方式','金额','帮助类型','状态','匹配人','匹配时间' ,'注册IP','等级'
        ];
        array_unshift($data, $title);
        $excel = new Excel();
		$excel->download($data, $eTitle);
		die;
	}

	public function actionOrderlist( $id ){
		$get = Gethelp::find()->select('get_id')->where(['user_id'=>$id])->asArray()->all();
		$pay = Payhelp::find()->select('pay_id')->where(['user_id'=>$id])->asArray()->all();
		$aa = array_merge(array_values($get),array_values($pay));
		$bb = [];
		foreach($aa as $v){foreach($v as $vv){$bb[] = $vv; } }
        $query = Orders::find()->where(['in', 'get_id' , $bb])->orwhere(['in', 'pay_id' , $bb])
        						->andFilterWhere(['like','mate_id',Yii::$app->request->get('mid')]);
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
        return $this->render('user_order',['provider' => $provider,'user' => User::findOne($id)]);
    }

    //重新分配
    public function actionAgain(){
    	if(!Yii::$app->request->getIsAjax()) return $this->errorshow();  //以后换成行为验证
		$id  = Yii::$app->request->post('id');
		$old = Orders::findOne($id);
		if( $old ){
			switch ($old->status) {
				case 4:
					//举报状态订单 两者都直接重新分配 封号管理员决定
					$connection = Yii::$app->db;
					$transaction = $connection->beginTransaction();
					try {
						$pay_id = $old->pay_id;
						$old->pay_id = 0;
						$new = new Orders();
						$new->get_id = 0;
						$new->pay_id = $pay_id;
						$new->money  = $old->money;
						$new->status = 1;
						$new->pipei_count += 1;
						$old->pipei_count += 1;

						$old->save();
						$new->save();
						$return['status']  = 1;
				    	$return['message'] = '重新分配成功';
						$transaction->commit();
					} catch (Exception $e) {
						$return['status']  = 0;
				    	$return['message'] = '程序发生错误，请检查网络后重试····';
						$transaction->rollBack();
					}
					break;

				case 5:

					//未打款  给提供用户记录一次封号记录 然后两个人都重新分配
					$connection = Yii::$app->db;
					$transaction = $connection->beginTransaction();
					try {
						//金额恢复
						$pay = Payhelp::findOne($old->pay->pay_id);
						$pay->accrual = 0;
						$pay->save();

						//记录次数 或者封号
						$user = User::findOne($old->get->user_id);
						if( $user->wdk_count >=3 ) {
							//封号
							$user->status = '三次未打款';
							//将用户订单为1 改为4
							Gethelp::updateAll(['status' => 4], 'user_id=:id', [':id'=>$user->user_id]);
							Payhelp::updateAll(['status' => 4], 'user_id=:id', [':id'=>$user->user_id]);
						}else{
							$user->wdk_count = $user->wdk_count + 1;
						}
						$user->save();

						$pay_id = $old->pay_id;
						$old->pay_id = 0;
						$new = new Orders();
						$new->get_id = 0;
						$new->pay_id = $pay_id;
						$new->money  = $old->money;
						$new->status = 1;
						$new->pipei_count += 1;
						$old->pipei_count += 1;
						$old->save();
						$new->save();
						$return['status']  = 1;
				    	$return['message'] = '重新分配成功';
						$transaction->commit();
					} catch (Exception $e) {
						$return['status']  = 0;
				    	$return['message'] = '程序发生错误，请检查网络后重试····';
						$transaction->rollBack();
					}
					break;
				case 6:
					//没收到款
					$old->status = 7;
					$old->save();
					$return['status']  = 1;
				    $return['message'] = '操作成功！';
					break;
				default:
					$return['status']  = 0;
				    $return['message'] = '程序发生错误，请检查网络后重试····';
					break;
			}

		}else{

			$return['status']  = 0;
			$return['message'] = '订单信息错误';
		}
		return $this->renderJson($return);
    }

    //自动匹配
    public function actionAutosearch(){
    	$aa = Orders::find()->select('get_id')->where(['status' => 1, 'pay_id' => 0])->asArray()->all();
    	$bb = Orders::find()->select('pay_id')->where(['status' => 1, 'get_id' => 0])->asArray()->all();
    	$get = [];
    	$pay = [];
    	foreach($aa as $v){foreach($v as $vv){$get[] = $vv;}}
    	foreach($bb as $v){foreach($v as $vv){$pay[] = $vv;}}

    	//匹配订单
    	$good = []; //存储匹配好的订单
    	foreach($get as $k => $v){
    		$order = Orders::findOne(['get_id' => $v]);
			if(count($pay) < 1) break;
    		foreach($pay as $kk=>$vv){
    			$pays  = Orders::find()->where(['pay_id' => $vv, 'money' => $order->money])->one();
    			if( $pays ){
    				if( $order->get->user_id  == $pays->pay->user_id ) break;  //属于自己的订单
    				$good[] = [$order->mate_id,$pays->mate_id];
    				unset($pay[$kk]);
					break;  //找到订单了
    			}
    		}
    	}
    	if(count($good)>=1){
    		return $this->renderPartial('alert_all',['good' => $good]);
    	}
    	$res['status'] = 5;
    	return $this->renderJson($res);
    }

    public function actionAutomatch(){
    	if(!Yii::$app->request->getIsAjax()) return $this->errorshow();  //以后换成行为验证
		$data = Yii::$app->request->post('val');
		// [0] => 59,60
	    // [1] => 61,71
	    if( is_array($data) && count($data) != 0 ){
			foreach($data as $value){
				$res = explode(',', $value);
				if(is_numeric($res[0]) && is_numeric($res[1]) ){
					$model1 = Orders::findOne( $res[0] );
					$model2 = Orders::findOne( $res[1] );
					$return = $this->matchd($model1, $model2);
				}else{
					$return['status']  = 0;
				    $return['message'] = 'UNKONW ERROR';
				}
			}
		}else{
			$return['status']  = 0;
			$return['message'] = 'UNKONW ERROR';
		}
		return $this->renderJson($return);
    }
}
