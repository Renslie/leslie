<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hl_payhelp".
 *
 * @property integer $pay_id
 * @property integer $user_id
 * @property integer $money
 * @property string $match_time
 * @property string $create_time
 * @property integer $status
 * @property integer $accrual
 * @property integer $is_tx
 */
class Payhelp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hl_payhelp';
    }

    public function getOrders(){
         return $this->hasMany(Orders::className(), ['pay_id' => 'pay_id']);
    }

    public function getUser(){
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'money', 'match_time', 'create_time', 'status', 'accrual', 'is_tx'], 'integer'],
            [['pay_type'],'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pay_id' => '帮助订单id',
            'user_id' => '用户id',
            'money' => '提供帮助金钱',
            'match_time' => '匹配成功时间',
            'create_time' => '匹配时间',
            'status' => '1.匹配中，2.交易未完成，3交易完成',
            'accrual' => '利息 （本金×利率）',
            'is_tx' => '是否提现。0未提现，1为提现成功',
            'pay_type' => '支付方式',
        ];
    }
}
