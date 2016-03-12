<?php
use yii\helpers\Url;
use app\models\Message;
 ?><div id="wrapper">

    <div id="page-wrapper" class="gray-bg dashbard-1" style="margin:0;">

        <!-- <div class="row wrapper border-bottom white-bg page-heading">

            <div class="col-lg-5" style="margin-top:20px;"> <b style="float:left;margin:8px 8px 0 0">问题:</b>
                <select class="input-sm form-control input-s-sm inline h_slect" style="float:left;width:80%;height:40px;">
                    <option value="0">系统错误</option>
                    <option value="1">参与者拒绝汇款</option>
                    <option value="0">经理操作不合理</option>
                    <option value="1">接款者不愿确认</option>
                    <option value="0">汇款时银行提供的资料与系统有差别</option>
                    <option value="1">参与者账号被封</option>
                    <option value="0">未确认收款</option>
                    <option value="1">错误的操作</option>
                    <option value="0">无法接受手机短信</option>
                    <option value="1">无法提交提供帮助</option>
                    <option value="0">无法提交接受帮助</option>
                    <option value="1">系统显示的金额有误</option>
                    <option value="0">更改邮箱</option>
                    <option value="1">更换手机号码</option>
                    <option value="0">举报诈骗行为</option>
                    <option value="1">无法更新汇款状态</option>
                    <option value="1">无法更新接款状态</option>
                    <option value="0">未获得款项</option>
                    <option value="1">我需要更换我的经理</option>
                </select>
            </div>
        </div> -->
        <div class="wrapper wrapper-content">
            <div class="row animated fadeInRight">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>未处理留言</h5>
                        </div>

                        <div id="content" count="<?=ceil($count/3)?>" data-url="<?=Url::toRoute('message/index')?>" class="ibox-content timeline">
                            <?php foreach($provider->models as $model){ ?>
                            <div class="timeline-item">
                                <div class="row">
                                    <div class="col-xs-3 date">
                                        <i class="fa fa-briefcase"></i>
                                        <?=date('Y-m-d H:i:s',$model->create_time)?>
                                        <br>
                                        <small class="text-navy"><?=from_time($model->create_time)?></small>
                                    </div>
                                    <div class="col-xs-7 content no-top-border">
                                        <div class="feed-activity-list">
                                            <div class="feed-element" style="border-bottom:0;">
                                                <a href="profile.html" class="pull-left">
                                                    <img alt="image" class="img-circle" src="img/profile.jpg"></a>
                                                <div class="media-body "> <strong><?= $model->user->account?></strong>
                                                    <button type="button" class="btn btn-primary btn-xs">
                                                    <?=$model->user->level->name?></button>
                                                    <?php if ($model->parent_id != 0): ?>
                                                        <p>
                                                            <strong>往期留言：</strong>
                                                            <br />
                                                            <?php 
                                                                $news = $model;
                                                                $arr  = [];
                                                                while (1) {
                                                                    $res = $news->last;
                                                                    $arr[] = $res;
                                                                    if($res['parent_id'] == 0) break;
                                                                    $news = Message::findOne($res['parent_id']);
                                                                }
                                                                foreach (array_reverse($arr) as $v) {
                                                                    echo '<strong>',$v['name'],'</strong> : <b>&nbsp; ',$v['content'],'<br />';
                                                                }
                                                            ?>
                                                        </p>
                                                    <?php endif ?>
                                                    <br>
                                                    <br>
                                                    <p>
                                                        <strong>标题：</strong>
                                                        <?=$model->title?>
                                                    </p>

                                                    <p>
                                                        <strong>内容：</strong>
                                                         <?=$model->content?>
                                                    </p>
                                                    <?php if($model->img){ ?>
                                                    <div class="photos">
                                                        <a href="javascript:;">
                                                            <img alt="image" class="feed-photo" src="<?=$model->img?>"></a>
                                                    </div>
                                                    <?php } ?>
                                                    <div class="form-group">
                                                        <textarea class="form-control"  style="resize:none;"></textarea>
                                                    </div>
                                                    <div class="text-right">
                                                        <button type="submit" data-url="<?=Url::toRoute(['message/reply', 'id'=>$model->mess_id])?>" class="submitd btn btn-sm btn-primary m-t-n-xs">
                                                            <strong>回复</strong>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php
$js = <<<JS
    var per_page = 1;
    $(window).on("scroll", function() {
        //判断到达底部时，自动加载
        var sct = ($(document).height() - $(window).height()),
            sct2 = $(document).scrollTop()+10;
            pages    = $('#content').attr('count'),
            url   =  $('#content').attr('data-url');
        if (sct2 >= sct) {
            ++per_page;
            if(per_page <=pages){
                $.get(url,{page:per_page}, function(msg){
                    $("#content").append(msg);
                });
            }
        }
    });

    $('#content').on('click', '.submitd', function(){
        var the = $(this),
            url = the.attr('data-url'),
            con = the.parents('.timeline-item').find('textarea').val();
        if(url == '' || con == '') {
            layer.alert('内容不能为空')
            return false;
        }
        $.get(url,{con:con},function(res){
            layer.alert(res.msg,function(index){
                if(res.status ==1){
                    the.parents('.timeline-item').remove()
                     layer.close(index);
                }
            });
        })
    })
JS;
$this->registerJs($js);
?>
