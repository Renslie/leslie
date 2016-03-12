<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hl_news".
 *
 * @property integer $news_id
 * @property string $title
 * @property integer $content
 * @property string $cover
 * @property integer $type
 * @property string $create_time
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hl_news';
    }

    public function beforeSave( $insert ){
        if( parent::beforeSave( $insert ) ){
            if( $this->isNewRecord ){
                $this->create_time = time();
            }
            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'create_time'], 'integer'],
            ['content','required'],
            [['title','cover'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'news_id' => '编号',
            'title' => '公告标题',
            'type' => '分类',
            'content' => '公告内容',
            'cover' => '封面',
            'create_time' => '发布时间',
        ];
    }
}
