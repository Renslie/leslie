<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Level;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
    $this->title = '评论审核表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index" style="background:#fff;padding:10px;">

    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> &nbsp; <?= Html::encode($this->title) ?></h2>
    </div>
    <br>
    <br>
   <!--  <hr>
    <hr> -->
<?php Pjax::begin(['id' => 'BackMoneyLog']) ?>
    <?= GridView::widget([
        'dataProvider' => $provider,
        'columns' => [
        	'cid',
            [
                'attribute' => 'new_id',
                'value'     => function ($model){
                    return $model->new->title;
                }
            ],
            [
                'attribute' => 'user_id',
                'value'     => function ($model){
                    return $model->user->account;
                }
            ],
            'content',
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
                'avtive'=>function ($url, $model, $key) {
                        return '<a href="javascript:;" cid="'.$model->cid.'" type="pass" class="deal btn btn-primary" >审核通过</a>';
                    },
                    'delete'=>function ($url,$model,$key){
                    	return '<a href="javascript:;" cid="'.$model->cid.'" type="del" class="deal btn btn-warning" >删除</a>';
                    }
                ]
            ],
        ],
        'tableOptions'=>['class' => 'table table-striped h_table'],  //自定义样式
    ]); ?>
<?php Pjax::end() ?>
</div>
<?php
$js = <<<JS
$("document").ready(function(){
    $("#new_country").on("pjax:end", function() {
        $.pjax.reload({container:"#BackMoneyLog"});  //Reload GridView
    });
});	

$('body').on('click','.deal', function(){
	var data = {
		id  : $(this).attr('cid'),
		type : $(this).attr('type'),
	}
	layer.alert('确定此操作？',function(){
		$.post('?r=news/comment-deal',data, function(msg){
			layer.alert(msg.message);
			if(msg.status == 1){
				location.reload();
			}
		})
	})
	return false;
})

JS;
$this->registerJs($js);
?>
