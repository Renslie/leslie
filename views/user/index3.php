<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Level;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
    $this->title = '已封号会员';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <div class="box-header well" data-original-title="" style="margin-top:20px;">
        <h2><i class="glyphicon glyphicon-user"></i> &nbsp; <?= Html::encode($this->title) ?></h2>
    </div>
    <div class="input-group h_search">
        <input  type="text" placeholder="请输入关键词" class="inputid input-sm form-control"> <span class="input-group-btn">
        <?= Html::submitButton('搜索', ['class' => 'leslie btn btn-sm  btn-primary langse']) ?></span>
    </div>
    <hr>
    <hr>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'user_id',
            'nickname',
            'account',
            'flow_money',
            'create_time',
            'reg_ip',
            [
                'attribute' => 'level_id',
                'value'     => function ($model){
                    return $model->level->name;
                }
            ],
            [
                'attribute' => 'status',
                'header' => '封号理由',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{avtive} {delete}',
                'header' => '操作',
                'buttons'=>[
                    'avtive'=> function ($url, $model, $key) {
                        return Html::a('恢复',['user/huifu','id'=>$model->user_id],['class'=>'btn btn-primary','data-confirm'=>'您真的要恢复?']);
                    },
                    'delete'=>function ($url,$model,$key){
                        return Html::a('删除',['user/deleted','id'=>$model->user_id],['class'=>'btn btn-warning','data-confirm'=>'您真的要删除?']);
                    }
                ]
            ],
        ],
        'tableOptions'=>['class' => 'table table-striped h_table'],  //自定义样式
    ]); ?>

</div>
<?php
$js = <<<JS
$('.leslie').on('click',function(){
    var url;
    if($('.inputid').val() != ''){
        url = '&id='+ $('.inputid').val();
        location.href = '?r=user/index&type=2'+url;
    }
})

JS;
$this->registerJs($js);
 ?>
