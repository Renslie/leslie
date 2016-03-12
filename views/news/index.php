<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> 资讯管理</h2>
            </div>
        </div>
    </div>
</div>
    <p>
        <?= Html::a('新增资讯', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'news_id',
            'title',
            [
                'attribute' => '分类',
                'value'     => function ($model){
                    return $model->type == 1 ? '新闻' : '帮助';
                }
            ],
            [
                'attribute' => 'create_time',
                'value'     => function ($model){
                    return date('Y-m-d H:i:s',$model->create_time);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{avtive} {delete}',
                'header' => '操作',
                'buttons'=>[
                    'avtive'=> function ($url, $model, $key) {
                        return Html::a('修改', ['news/update','id'=>$model->news_id], ['class' => 'btn btn-primary']);

                    },
                    'delete'=>function ($url,$model,$key){
                        return Html::a('删除', ['news/delete','id'=>$model->news_id], ['class' => 'btn btn-warning','data-confirm'=>'您真的要删除?']);
                    }
                ]
            ],
        ],
    ]); ?>

</div>
