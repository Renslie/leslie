<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Level;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
    $this->title = '后台金币操作记录表';
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
            'id',
            'user_id',
            'user_name',
            'target',
            'log',
            [
                'attribute' => 'create_time',
                'value'     => function ($model){
                    return date('Y-m-d H:i:s',$model->create_time);
                }
            ],
        ],
        'tableOptions'=>['class' => 'table table-striped h_table'],  //自定义样式
    ]); ?>
<?php Pjax::end() ?>
</div>
<?php

$this->registerJs(
   '$("document").ready(function(){
        $("#new_country").on("pjax:end", function() {
            $.pjax.reload({container:"#BackMoneyLog"});  //Reload GridView
        });
    });'
);
?>
