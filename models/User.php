<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hl_user".
 *
 * @property string $user_id
 * @property string $nickname
 * @property string $account
 * @property string $pwd_log
 * @property string $pwd_tra
 * @property string $weixin
 * @property string $alipay
 * @property string $bank
 * @property string $phone
 * @property integer $last_log
 * @property integer $status
 * @property integer $reg_ip
 * @property string $create_time
 * @property integer $is_active
 * @property integer $fixation_money
 * @property integer $money_manager
 * @property integer $money_rec
 * @property integer $level_id
 * @property integer $wdk_count
 * @property integer $flow_money
 * @property integer $flow_money_manager
 * @property integer $flow_money_rec
 * @property string $headicon
 */
class User extends \yii\db\ActiveRecord
{
    public $sameip;
    public $parent_id;
    public $pname;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hl_user';
    }

    public function beforeSave($insert){
        if(parent::beforeSave($insert)){
            if(strlen($this->pwd_log) <= 30){
                $this->pwd_log = md5($this->pwd_log);
            }
            if(strlen($this->pwd_tra) <= 30){
                $this->pwd_tra = md5($this->pwd_tra);
            }
            return true;
        }
        return false;
    }

    public function getLevel(){
        return $this->hasOne(Level::className(), ['level_id' => 'level_id']);
    }

    public function getIp(){
        return $this->hasOne(Ip::className(), ['id' => 'ip_id']);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account', 'pwd_log', 'pwd_tra', 'phone'], 'required'],
            [['bank', 'status'], 'string'],
            [['phone', 'last_log', 'create_time', 'is_active', 'fixation_money', 'money_manager', 'money_rec', 'level_id', 'wdk_count', 'flow_money', 'flow_money_manager', 'flow_money_rec','ip_id'], 'integer'],
            [['nickname'], 'string', 'max' => 32],
            [['account', 'pwd_log', 'pwd_tra', 'weixin', 'alipay', 'headicon'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id'            => '用户id',
            'nickname'           => '昵称',
            'account'            => '用户名',
            'pwd_log'            => '登陆密码',
            'pwd_tra'            => '交易密码',
            'weixin'             => '微信账号',
            'alipay'             => '支付宝账号',
            'bank'               => '银行信息(以json格式输出(依次为银行账号.用户银行.开户名))',
            'phone'              => '手机号码',
            'last_log'           => '最后一次登陆时间',
            'status'             => '登陆状态(0为正常状态，1为封号)',
            'reg_ip'             => '注册ip',
            'create_time'        => '注册时间',
            'is_active'          => '是否激活 1为激活，0为未激活',
            'fixation_money'     => '个人待定总额',
            'money_manager'      => '经理待定奖金',
            'money_rec'          => '推荐待定奖金',
            'level_id'           => '等级',
            'wdk_count'          => '未打款次数（三次封号）',
            'flow_money'         => '个人钱包',
            'flow_money_manager' => '经理奖金流动钱包',
            'flow_money_rec'     => '推荐奖金流动钱包',
            'headicon'           => '头像',
            'sameip'             =>'相同IP',
            'ip_id'              => 'ipID',
            'parent_id'          => '',
            'pname'              => '',
        ];
    }
}
