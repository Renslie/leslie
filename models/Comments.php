<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hl_comments".
 *
 * @property string $new_id
 * @property string $user_id
 * @property string $content
 * @property integer $create_time
 * @property string $cid
 * @property string $status
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hl_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['new_id', 'user_id'], 'required'],
            [['new_id', 'user_id', 'create_time', 'status'], 'integer'],
            [['content'], 'string', 'max' => 255]
        ];
    }

    public function getNew(){
        return  $this->hasOne(News::className(), ['news_id' => 'new_id']);
    }

    public function getUser(){
         return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'new_id' => '所属文章编号',
            'user_id' => '评论用户',
            'content' => '评论',
            'create_time' => '回复时间',
            'cid' => '编号',
            'status' => 'Status',
        ];
    }
}
