<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hl_back_money_log".
 *
 * @property string $id
 * @property integer $user_id
 * @property integer $user_name
 * @property integer $target
 * @property string $log
 * @property integer $create_time
 */
class BackMoneyLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hl_back_money_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'target', 'log', 'create_time'], 'required'],
            [['user_id', 'create_time'], 'integer'],
            [['log'], 'string', 'max' => 100],
            [['target','user_name'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'user_id' => '用户编号',
            'user_name' => '会员名',
            'target' => '操作者',
            'log' => '操作记录',
            'create_time' => '操作时间',
        ];
    }

    // public function fields(){
    //     $fields = parent::fields();
    //     $fields['create_time'] = function() {
    //         return date('Y-m-d H:i:s',$fields['create_time']);
    //     };
    //     return $fields;
    // }
}
