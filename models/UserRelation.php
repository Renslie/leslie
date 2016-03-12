<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hl_user_relation".
 *
 * @property string $user_id
 * @property string $parent_id
 * @property integer $create_time
 */
class UserRelation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hl_user_relation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'parent_id'], 'required'],
            [['user_id', 'parent_id', 'create_time'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => '用户名',
            'parent_id' => '推荐人 推荐人为0时表示顶级',
            'create_time' => '时间',
        ];
    }

    /**
     * 获取树的数据
     *
     * @param int $user_id
     * @return array
     */
    public function getTreeData($user_id = 0){

        $data = $this->getChildren($user_id);
        $i = 0;
        foreach ($data as $key) {

            $data[$i]['text'] =$key['nickname'];
            //让节点打开
            //$data[$i]['state']['expanded'] = true;

            $res = $this->getTreeData($key['user_id']);
            //unset($data[$i]['user_id']);
            unset($data[$i]['nickname']);
            //unset($data[$i]['parent_id']);
            unset($data[$i]['create_time']);
            if($res){
                $data[$i]['nodes'] = $res;
            }
            $i = $i+1;
        }
        return $data;
    }
    /**
     * @param $user_id
     * @return array 返回用户下线数组（带组织结构）
     */
    public function getTreeUser($user_id){

        $res = $this->getChildren($user_id);

        $child = [];
        if($res){
            foreach($res as $k=>$v){
                if($v['user_id']){
                    $child_res = $this->getTreeUser($v['user_id']);
                    if($child_res){
                        $child[] = $child_res;
                    }

                }
            }
        }

        $res = array_merge($res,$child);

        return $res;
    }

    /**
     * 查找某个用户是否是自己的下线
     *
     * @param $user_id
     * @param $child_id
     * @return bool
     */
    public function checkChild($user_id,$child_id){

        $res = $this->getChildren($user_id);


        if($res){
            foreach($res as $k=>$v){
                if($v['user_id'] == $child_id){
                    return true;
                }else if($v['user_id']){
                    $child_res = $this->checkChild($v['user_id'],$child_id);
                    if($child_res){
                        return true;
                    }
                }
            }
        }

        return false;
    }

    /**
     * 获取用户下线
     * @param $user_id
     * @return array 返回下线
     */
    public function getChildren($user_id){

        $query = $this->find();

        $query->select("hl_user_relation.*,u.nickname");



        $query->andFilterWhere(['hl_user_relation.parent_id'=>$user_id]);
        $query->leftJoin(['u'=>'hl_user'],'u.user_id=hl_user_relation.user_id');
        $res = $query->asArray()->all();

        return $res;
    }




}
