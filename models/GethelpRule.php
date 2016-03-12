<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hl_gethelp_rule".
 *
 * @property string $grid
 * @property integer $min_money
 * @property integer $max_money
 * @property integer $Help_money_month
 * @property integer $after_recive_days
 */
class GethelpRule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hl_gethelp_rule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['grid'], 'required'],
            [['grid', 'min_money', 'mlutiple', 'max_money', 'help_money_month', 'after_recive_days'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'grid' => '得到帮助规则id',
            'mlutiple' => '金额输入倍数',
            'min_money' => '提供最小金额',
            'max_money' => '金额上限',
            'help_money_month' => '每月提供帮助总额度',
            'after_recive_days' => '每次接受帮助N天后，可进行第二次接受帮助',
        ];
    }
}
