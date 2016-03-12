<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Level;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
    $this->title = '未激活用户列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index" style="background:#fff;padding:10px;">

    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> &nbsp; <?= Html::encode($this->title) ?></h2>
    </div>
    <div class="input-group h_search">
        <input  type="text" placeholder="请输入关键词" class="inputid input-sm form-control"> <span class="input-group-btn">
        <?= Html::submitButton('搜索', ['class' => 'leslie btn btn-sm  btn-primary langse']) ?></span>
    </div>
    <br>
    <br>
   <!--  <hr>
    <hr> -->
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
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{avtive} {delete}',
                'header' => '操作',
                'buttons'=>[
                    'avtive'=> function ($url, $model, $key) {
                        return Html::a('激活', ['user/actived','id'=>$model->user_id], ['class' => 'btn btn-primary','data-confirm'=>'您真的要激活?']);

                    },
                    'delete'=>function ($url,$model,$key){
                        return Html::a('删除', ['user/deleted','id'=>$model->user_id], ['class' => 'btn btn-warning','data-confirm'=>'您真的要删除?']);
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
