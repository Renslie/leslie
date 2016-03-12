<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hl_jihuo_prompt".
 *
 * @property integer $id
 * @property string $content
 * @property double $get_time
 * @property double $pay_time
 * @property double $limt_time
 */
class JihuoPrompt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hl_jihuo_prompt';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['content'], 'string'],
            [['get_time', 'pay_time', 'limt_time'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '激活提示id',
            'content' => '激活内容',
            'get_time' => '收款时间（天）',
            'pay_time' => '打款时间（天）',
            'limt_time' => '匹配中（天）',
        ];
    }
}
