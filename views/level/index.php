<?php
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '等级管理表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="level-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('创建新等级', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'level_id',
            'name',
            'tz_money',
            'recommend',
            [
                'attribute' => 'commission',
                'value'     => function ($model){
                    return json_decode($model->commission)->count;
                }
            ],
             [
                'attribute' => 'bonus_type',
                'value'     => function ($model){
                    return $model->bonus_type ==1? '推荐奖金' : '经理奖金';
                }
            ],
            'next_money_less',
            [   
                'header'    => '月投资金额减少，扣除本月佣金奖励',
                'attribute' => 'level_id',
                'value'     => function ($model){
                    return $model->level_id ==4? '是' : '否';
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{avtive} {delete}',
                'header' => '操作',
                'buttons'=>[
                    'avtive'=> function ($url, $model, $key) {
                        return Html::a('修改', ['level/update','id'=>$model->level_id], ['class' => 'btn btn-primary']);

                    },
                    'delete'=>function ($url,$model,$key){
                        return Html::a('删除', ['level/delete','id'=>$model->level_id], ['class' => 'btn btn-warning']);
                    }
                ]
            ],
        ],
        'tableOptions'=>['class' => 'table table-striped h_table'],  //自定义样式
    ]); ?>
</div>
