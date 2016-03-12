<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hl_bonus_type".
 *
 * @property integer $bonus_type_id
 * @property integer $tx_days
 * @property integer $money
 * @property integer $exceed_money
 */
class BonusType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hl_bonus_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tx_days', 'money', 'exceed_money'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bonus_type_id' => '佣金类别id（1为奖金推荐,2为经理 )）',
            'tx_days' => '每月提现次数',
            'money' => '每次体现金额',
            'exceed_money' => '每轮投资额度超过XX元(既是 每轮已经完成舍的订单的金钱超过XX元),																			就不限制额度跟次数',
        ];
    }
}
