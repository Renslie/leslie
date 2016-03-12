<?php
namespace app\models;
use Yii;

/**
 * This is the model class for table "hl_level".
 *
 * @property string $level_id
 * @property string $name
 * @property string $tz_money
 * @property string $recommend
 * @property string $commission
 * @property integer $bonus_type
 * @property integer $next_money_less
 * @property integer $month_money_less
 */
class Level extends \yii\db\ActiveRecord
{
    public $num;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hl_level';
    }

    public function changeCommission( $data ){
        $array = [
            'count' => count($data),
            'num'   => $data
        ];
        return json_encode($array);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'commission'], 'required'],
            [['level_id', 'tz_money', 'recommend', 'bonus_type', 'next_money_less', 'month_money_less'], 'integer'],
            [['commission'], 'string'],
            [['name'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'level_id' => '等级表',
            'name' => '等级名称',
            'tz_money' => '投资金额',
            'recommend' => '推荐人数',
            'commission' => '可获取的佣金代数',  //{\"count\":3,\"num\":[1,2,3]} 佣金格式 json格式，count为可获取的代数，num为代数及所对应的数量
            'bonus_type' => '奖金类型',
            'next_money_less' => '如下级一个会员投资额度减少，对该会员的佣金减少额度（%）：',
            'month_money_less' => '月投资金额减少，扣除本月佣金奖励额度（%）',
        ];
    }
}
