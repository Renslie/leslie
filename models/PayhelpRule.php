<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hl_payhelp_rule".
 *
 * @property integer $prid
 * @property integer $mlutiple
 * @property integer $min_money
 * @property integer $max_money
 * @property integer $rate
 * @property integer $limit_days
 * @property integer $interest_days
 * @property integer $Help_money_month
 * @property integer $after_pay_days
 */
class PayhelpRule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hl_payhelp_rule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mlutiple', 'min_money', 'max_money', 'rate', 'limit_days', 'interest_days', 'help_money_month', 'after_pay_days'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'prid' => '规则id',
            'mlutiple' => '金额输入倍数',
            'min_money' => '最小金额',
            'max_money' => '最大金额',
            'rate' => '利率',
            'limit_days' => '不得提现天数(从用户提供帮助操作成功后开始算。)',
            'interest_days' => '利息天数(达到该天数后，不再获得利息，本金与利息也自动转回钱包。)',
            'help_money_month' => '每月提供帮助总额度',
            'after_pay_days' => '每次提供帮助N天后，可进行第二次提供帮助',
        ];
    }
}
