<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hl_message".
 *
 * @property integer $mess_id
 * @property integer $user_id
 * @property string $title
 * @property integer $target_id
 * @property string $content
 * @property string $img
 * @property integer $status
 * @property integer $type
 * @property string $create_time
 * @property integer $error_type
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hl_message';
    }

    public function getUser(){
        return $this->hasOne(User::className(),['user_id'=>'user_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'target_id', 'status', 'type', 'create_time','parent_id'], 'integer'],
            [['title', 'content', 'img'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mess_id' => '留言id',
            'user_id' => '用户id',
            'title' => '留言标题',
            'target_id' => '留言用户的id ----0为管理员留言',
            'content' => '留言内容',
            'img' => '留言图片',
            'status' => '1未处理，2为已经处理',
            'type' => '1.通知用户的留言,  2为（联系我们模块）的留言',
            'create_time' => '留言时间',
            'parent_id'  =>'回复上一条信息的id',
        ];
    }

    public function replay( $data ){
        $model = new Message();
        $model->user_id     = $this->user_id;
        $model->content     = $data['con'];
        $model->title       = '后台信息';
        $model->type        = 1;
        $model->create_time = time();
        $model->parent_id   = $this->mess_id;
        $connection  = Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            $model->save();
            $transaction->commit();
            $return['status'] = 1;
            $return['msg']    = '回复成功！';
        } catch (Exception $e) {
            $return['status'] = 0;
            $return['msg']    = '程序出现错误';
            $transaction->rollBack();
        }
        return $return;
    }

    public function getLast(){
        $arr = [];
        $model = Message::findOne($this->parent_id);
        $arr['content']   = $model->content;
        $arr['parent_id'] = $model->parent_id;
        if($model->title == '后台信息'){
            $arr['name']      = '后台';
        }else{
            $arr['name']      = $model->user->account;
        }
        return $arr;
    }
}
