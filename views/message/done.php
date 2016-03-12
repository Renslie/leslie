 <?php 
use yii\widgets\LinkPager;
use yii\helpers\Url;
  ?>  
    <div id="wrapper">

        <div id="page-wrapper" class="gray-bg dashbard-1" style="margin:0;">

            <div class="wrapper wrapper-content animated fadeIn">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel blank-panel">

                            <div class="panel-heading">
                                <div class="panel-title m-b-md">
                                    <h4>已处理留言</h4>
                                </div>
                                <div class="table-responsive" style="border:1px solid #ddd;">
                                    <table class="table table-striped h_table">
                                        <thead>
                                            <tr>

                                                <th>编号</th>
                                                <th>会员用户名</th>
                                                <th>留言分类</th>
                                                <th width="10%">标题</th>
                                                <th>回复内容</th>
                                                <th>留言时间</th>
                                                <th width="20%">留言内容</th>
                                                <th>处理状态</th>
                                                <th width="20%">图片</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($provider->models as $model){ ?>
                                            <tr>
                                                <td><?=$model->mess_id?></td>
                                                <td><?=$model->user->account?></td>
                                                <td><?=$model->error_type?></td>
                                                <td>
                                                    <?=$model->title?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        if($par = app\models\Message::find()->where(['parent_id'=>$model->mess_id])->one())
                                                            echo $par->content;
                                                    ?>
                                                </td>
                                                <td><?=date('Y-m-d H:i:s',$model->create_time)?></td>
                                                <td>
                                                   <?=$model->content?>
                                                </td>
                                                <td>已处理</td>
                                                <td>
                                                    <div class="photos">
                                                        <a target="_blank" href="http://24.media.tumblr.com/20a9c501846f50c1271210639987000f/tumblr_n4vje69pJm1st5lhmo1_1280.jpg">
                                                            <img alt="image" class=" feed-photo" src="<?=$model->img?>"></a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a class="dele btn btn-default" data-url="<?=Url::toRoute(['message/del','id'=>$model->mess_id])?>" href="javascript:;">删除</a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <?=
                                    LinkPager::widget([
                                        'pagination' => $provider->pagination,
                                        'options' => ['class' => 'btn-group pagination pull-left', 'style' => 'width:80%;margin:0 auto;text-align: center;']
                                        ]);
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

            <!-- 弹窗 -->    
            <div class="theme-popover-mask" ></div>
            <!-- 遮罩 -->    

            <!-- 修改弹框内容 -->    
            <div class="pop them1" style="height:auto;padding-bottom:3rem;width:50%;">
                <div class="pop_title pr">
                    修改
                    <span class="close "></span>
                </div>

                <div class="pop_all">

                    <p class="h_btns">
                        <button type="button" class="btn btn-w-m btn-default cancle">取消</button>
                        <button type="button" class="btn btn-w-m btn-primary">确定</button>
                    </p>
                </div>
            </div>

            <!-- 修改弹框内容 -->    

            <!-- 弹窗 --> </div>
    </div>
<?php 
$js = <<<JS
$('table').on('click', '.dele', function(){
    var url = $(this).attr('data-url'),
        the = $(this);
    layer.confirm('确定删除这条数据?', {icon: 2, title:'删除提示'}, function(index){
        layer.load()
        $.get(url,function(res){
            if(res.status ==1){
                the.parents('tr').remove();
            }
            layer.msg(res.msg)
        })
        layer.closeAll(); 
    });
})
JS;
$this->registerJs($js);
 ?>