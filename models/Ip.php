<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hl_ip".
 *
 * @property string $id
 * @property string $name
 * @property string $create_time
 * @property integer $count
 */
class Ip extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hl_ip';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['count'], 'integer'],
            [['name'], 'string', 'max' => 16],
            [['create_time'], 'string', 'max' => 11]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '记录ip 地址',
            'create_time' => 'Create Time',
            'count' => 'Count',
        ];
    }
}
