<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hl_gethelp".
 *
 * @property integer $get_id
 * @property integer $user_id
 * @property integer $money
 * @property integer $match_time
 * @property integer $create_time
 * @property integer $status
 * @property string $type
 */
class Gethelp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hl_gethelp';
    }

    public function getOrders(){
         return $this->hasMany(Orders::className(), ['get_id' => 'get_id']);
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
            [['user_id', 'money', 'match_time', 'create_time', 'status', 'type'], 'integer'],
            [['pay_type'],'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'get_id' => '接受帮助id',
            'user_id' => '用户id',
            'money' => '接受帮助金额',
            'match_time' => '匹配成功时间',
            'create_time' => '匹配时间',
            'status' => '1为交易成功，2为交易失败',
            'type' => '1,为个人流动钱包，2为推荐奖金流动钱包，3为经理奖金',
            'pay_type' => '支付方式',
        ];
    }
}
