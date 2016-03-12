<?php

namespace app\models;
use app\common\sms\Sms;
use Yii;

/**
 * This is the model class for table "hl_orders".
 *
 * @property integer $mate_id
 * @property string $pay_id
 * @property string $get_id
 * @property integer $money
 * @property integer $create_time
 * @property integer $need_time
 * @property integer $status
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hl_orders';
    }

    public function beforeSave( $insert ){
        if( parent::beforeSave( $insert ) ){
            if( $this->isNewRecord ){
                $this->create_time = time();
            }
            return true;
        }
        return false;
    }

    public function getPay(){
        return $this->hasOne(Payhelp::className(),['pay_id' => 'pay_id']);
    }

    public function getGet(){
        return $this->hasOne(Gethelp::className(),['get_id' => 'get_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pay_id', 'get_id', 'money', 'create_time', 'need_time', 'status', 'pipei_count'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mate_id' => '匹配订单id',
            'pay_id' => '提供帮助订单id(当 pay_id不为0,get_id为0时    表示订单为匹配中 针对舍的一方，)',
            'get_id' => '接受帮助订单id(当 get_id不为0时, pay_id为0时  表示订单为匹配中 针对得的一方 )',
            'money' => '交易金额',
            'create_time' => '创建时间',
            'need_time' => '订单完成时间',
            'pipei_count' => '匹配次数',
            'status' => '匹配状态(1.匹配中,2待打款/待收款,3已打款/等待收款确认,4.未打款/举报(未收到款)，5.虚假打款/举报（未收到款）,6.交易成功)',
        ];
    }

    public function searchOrder(){
        if($this->status == 1){
            $money = $this->money;
            if( $this->get_id == 0 ){
                //需要匹配get_id
                $type  = 'pay_id';
                $id    = $this->pay->user_id;
                $whe   = Gethelp::find()->select(['get_id'])->where(['status' => 1, 'user_id' => $id]);
                $where = ['not in' , 'get_id', $whe];
            }else{
                //需要匹配pay_id
                $id    = $this->get->user_id;
                $whe   = Payhelp::find()->select(['pay_id'])->where(['status' => 1, 'user_id' => $id]);
                $type  = 'get_id';
                $where = ['not in' , 'pay_id', $whe];
            }
                unset($whe);  //释放
                unset($this);  //释放

            $model = Orders::find()
                    ->where([ $type => 0])
                    ->andWhere(['<=', 'money', $money])
                    ->andWhere($where)
                    ->orderBy('money desc')
                    ->limit(15)
                    ->all();
            if(count($model)>=1) return $model;
            $return['status']  = 0;
            $return['message'] = '暂无可匹配的订单';
        }else{
            $return['status']  = 0;
            $return['message'] = '此订单不可匹配或已匹配';
        }
        return $return;
    }

    //$data拆分的钱 
    public function splitOrder( $data ,$type = false){
        $mm   = 0;
        if($type){
            foreach($data as $v){
                $mm += $v[1];
            }
        }else{
            $mm = array_sum($data);
        }
        if($this->money == $mm ){
            $connection  = Yii::$app->db;
            $transaction = $connection->beginTransaction();
            try {
                foreach($data as $v){
                    $order = new Orders();
                    if($type){
                        $old = Orders::findOne($v[0]);
                        $order->pay_id = $this->pay_id?:$old->pay_id;
                        $order->get_id = $this->get_id?:$old->get_id;
                        $order->money  = $v[1];
                        $order->status = 2;
                        $order->pipei_count = $this->pipei_count;
                        $old->delete();
                        $return['message'] = '匹配成功！';
                        // $Sms = new Sms();
                        // $Sms->sendMessage($order->pay->user->phone, '尊敬的用户，您有订单号已匹配成功，请登录查看');
                        // $res = $Sms->sendMessage($order->get->user->phone, '尊敬的用户，您有订单号已匹配成功，请登录查看');
                        $return['aa'] = $res;
                    }else{
                        $order->pay_id = $this->pay_id;
                        $order->get_id = $this->get_id;
                        $order->money  = $v;
                        $return['message'] = '拆分成功！';
                    }
                    $order->save();
                }
                $return['status']  = 1;
                $transaction->commit();
            } catch (Exception $e) {
                $return['status']  = 0;
                $return['message'] = '程序发生错误，请检查网络后重试····';
                $transaction->rollBack();
            }
        }else{
            //非法改代码进入·····
            $return['status']  = 0;
            $return['message'] = '输入的金额有误！';
        }
        return $return;
    }

    public function exceldata(){
        $arr = [];
        $title  = [
            '订单号','会员名','姓名','支付方式','金额','帮助类型','状态','匹配人','匹配时间' ,'注册IP','等级'
        ];
        $user  = ($this->pay_id != 0)? $this->pay : $this->get;
        $arr[] = $this->mate_id;
        $arr[] = $user->user->nickname;
        $arr[] = $user->user->account;
        $type = '';
        foreach (explode(',',$user->pay_type) as $key => $value) {
            switch ($value) {
                case 1: $type .=  '支付宝 '; break;
                case 2: $type .=  '微信 '; break;
                default: $type .=  '银行 '; break;
            }
        }
        $arr[] = $type;
        $arr[] = $this->money;
        $arr[] = ($this->pay_id != 0)? '提供帮助' : '接受帮助';
        switch ($this->status) {
              case 1:
                  $arr[] =  '匹配中';
                  break;
              case 2:
                  $arr[] = ($this->pay_id != 0)? '等待受方确认' : '等待供方付款';
                  break;

               case 3:
                  $arr[] =  ($this->pay_id != 0)? '已打款' : '代确认收款';
                  break;

               case 4:
                  $arr[] =  ($this->pay_id != 0)? '虚假打款' : '被举报';
                  break;

               case 5:
                  $arr[] =  ($this->pay_id != 0)? '未准时打款' : '代确认收款';
                  break;

               case 6:
                $arr[] =  ($this->pay_id != 0)? '已打款' : '未准时确认收款';
                break;

               case 7:
                  $arr[] =  '交易成功';
                  break;
              default:
                  $arr[] =  '未知状态';
                  break;
        }
        if($this->get_id && $this->pay_id){
            if($this->get_id != 0){
                $arr[] = $this->get->user->account;
            }else{
                $arr[] = $this->pay->user->account;
            }
        }else{
            $arr[] =  '暂无';
        }
        if($this->status == 7){
                $arr[] =  '订单已完成';
        }else{
            $jp = JihuoPrompt::findOne(1);
            if($this->status == 1){
                $time = $jp->limt_time;
            }elseif($this->status == 2){
                $time = $jp->get_time;
            }else{
                $time = $jp->pay_time;
            }
            $time = $time*86400;
            if( $time < (time()-($this->create_time))){
                $arr[] =  '超出匹配时间';
            }else{
                $hour = floor(($time-(time()-($this->create_time)))/3600);  //剩余小时
                $arr[] =  '剩余时间：'.$hour.'小时';
            }
        }
        $arr[] = $user->user->reg_ip;
        $arr[] = $user->user->level->name;
        return $arr;
    }

    //登录时候检查更新所有超时的订单
    public static function checkOrders(){
        $paytime = JihuoPrompt::findOne(1)->pay_time;
        $gettime = JihuoPrompt::findOne(1)->get_time;
        Orders::updateAll(['status' => 5],  'status=2 and create_time < :time',[':time'=>time()-$paytime*3600]);
        Orders::updateAll(['status' => 6],  'status=3 and create_time < :time',[':time'=>time()-$gettime*3600]);
    }
}
