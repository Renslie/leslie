<?php
use app\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
    <title>互利系统</title>
</head>

<body>
<?php $this->beginBody() ?>
    <div id="wrapper">

        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">

                        <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="img/profile_small.jpg" />
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?= Yii::$app->user->identity->username ?></strong>
                             </span> <span class="text-muted text-xs block">管理员<b class="caret"></b></span> </span>
                            </a>
                            <ul class="leslie dropdown-menu animated fadeInRight m-t-xs">
                                <li class="divider"></li>
                                <li><a href="<?=Url::toRoute('site/logout');?>">安全退出</a>
                                </li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            Hy
                        </div>

                    </li>
                    <?php if(Yii::$app->user->can('orders/index') || Yii::$app->params['admin'] == Yii::$app->user->identity->username){ ?>
                    <li>
                        <a href="<?=Url::toRoute('orders/index');?>" class="menu_index menu_top" menu_index="menu_top"><i class="fa fa-columns"></i> <span class="nav-label">首页-帮助管理</span></a>
                        
                    </li>
                    <?php } ?>
                   <!--  <li>
                        <a href="layouts.html"><i class="fa fa-columns"></i> <span class="nav-label">布局</span><span class="label label-danger pull-right">2.0</span></a>
                    </li> -->
                    <?php if(Yii::$app->user->can('User')  || Yii::$app->params['admin'] == Yii::$app->user->identity->username){ ?>
                    <li>
                        <a href="#" class="menu_index menu_user" menu_index="menu_user"><i class="fa fa fa-globe"></i> <span class="nav-label">会员管理</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level leslie">
                            <?php if(Yii::$app->user->can('User') || Yii::$app->params['admin'] == Yii::$app->user->identity->username){ ?>
                            <li><a href="<?=Url::toRoute('user/index').'&type=2'?>">未激活会员列表</a></li>
                            <?php } ?>
                            <?php if(Yii::$app->user->can('user/editactive')  || Yii::$app->params['admin'] == Yii::$app->user->identity->username){ ?>
                            <li><a href="<?=Url::toRoute('user/editactive')?>">修改未激活的提示内容</a></li>
                            <?php } ?>
                            <?php if(Yii::$app->user->can('user/index')  || Yii::$app->params['admin'] == Yii::$app->user->identity->username){ ?>
                            <li><a href="<?=Url::toRoute('user/index')?>">正常会员列表</a></li>
                            <?php } ?>
                            <?php if(Yii::$app->user->can('user/disable')  || Yii::$app->params['admin'] == Yii::$app->user->identity->username){ ?>
                            <li><a href="<?=Url::toRoute('user/index').'&type=3'?>">已封号会员</a></li>
                            <?php } ?>

                            <?php if(Yii::$app->user->can('user/fenghao')  || Yii::$app->params['admin'] == Yii::$app->user->identity->username){ ?>
                            <li><a href="<?=Url::toRoute('user/fenghao')?>">封号操作</a></li>
                            <?php } ?>
                            <?php if(Yii::$app->user->can('user/addmoney')  || Yii::$app->params['admin'] == Yii::$app->user->identity->username){ ?>
                            <li><a href="<?=Url::toRoute('user/addmoney')?>">金币增减</a></li>
                            <li><a href="<?=Url::toRoute('user/money-log')?>">金币增减记录</a></li>
                            <?php } ?>
                            <?php if(Yii::$app->user->can('user/relate')  || Yii::$app->params['admin'] == Yii::$app->user->identity->username){ ?>
                            <li><a href="<?=Url::toRoute('user/relate')?>">会员关系图</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php } ?>
                    <?php if(Yii::$app->user->can('news/index')  || Yii::$app->params['admin'] == Yii::$app->user->identity->username){ ?>
                    <li>
                        <a href="?"  class="menu_index menu_news" menu_index="menu_news"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">资讯管理</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level leslie">
                            <li><a href="<?=Url::toRoute('news/index')?>">资讯列表</a></li>
                            <li><a href="<?=Url::toRoute('news/newtips')?>">新人通知信息修改</a></li>
                            <li><a href="<?=Url::toRoute('news/comment')?>">评论审核列表</a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                    <?php if(Yii::$app->user->can('Message')  || Yii::$app->params['admin'] == Yii::$app->user->identity->username){ ?>
                    <li>
                        <a href="?" class="menu_index menu_message" menu_index="menu_message"><i class="fa fa-envelope"></i> <span class="nav-label">留言管理 </span><span class="fa arrow"></span><!-- <span class="label label-warning pull-right">16</span> --></a>
                        <ul class="nav nav-second-level leslie">
                            <li><a href="<?=Url::toRoute('message/index')?>">未处理留言</a>
                            </li>
                            <li><a href="<?=Url::toRoute('message/done')?>">已处理留言</a>
                            </li>
                            <li><a href="<?=Url::toRoute('message/liuyan')?>">给用户留言</a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                    <?php if(Yii::$app->user->can('Rule')  || Yii::$app->params['admin'] == Yii::$app->user->identity->username){ ?>
                    <li>
                        <a href="?" class="menu_index menu_rules" menu_index="menu_rules"><i class="fa fa-edit"></i> <span class="nav-label">规则设置</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level leslie">
                            <li><a href="<?=Url::toRoute('orders/rules')?>">规则设置</a>
                            </li>
                            <?php if(Yii::$app->user->can('Level')  || Yii::$app->params['admin'] == Yii::$app->user->identity->username){ ?>
                            <li><a href="<?=Url::toRoute('level/index')?>">等级设置</a>
                            <?php } ?>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                    <?php if(Yii::$app->user->can('Admin')  || Yii::$app->params['admin'] == Yii::$app->user->identity->username){ ?>
                    <li>
                        <a href="?" class="menu_index menu_manager" menu_index="menu_manager"><i class="fa fa-desktop"></i> <span class="nav-label">管理员管理</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level leslie">
                            <li><a href="<?=Url::toRoute('admin/index');?>">管理员列表</a></li>
                             <?php if(Yii::$app->user->can('Role')  || Yii::$app->params['admin'] == Yii::$app->user->identity->username){ ?>
                            <li><a href="<?=Url::toRoute('admin/role');?>">角色管理表列表</a></li>
                             <?php } ?>
                        </ul>
                    </li>
                    <?php } ?>
                    <li>
                        <a href="?" class="menu_index menu_system" menu_index="menu_system"><i class="fa fa-flask"></i> <span class="nav-label">系统管理</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level leslie">
                            <li><a href="<?=Url::toRoute('admin/editself')?>">修改密码</a>
                            </li>
                            <li><a href="<?=Url::toRoute('site/logout');?>">退出</a>
                            </li>
                        </ul>
                    </li>

                </ul>

            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        <form role="search" class="navbar-form-custom"  action="search_results.html">
                            <div class="form-group">
                                <input type="text" placeholder="" class="form-control" name="top-search" id="top-search">
                            </div>
                        </form>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message"><a href="#" title="返回首页"><i class="fa fa-home"></i></a>欢迎使用互利系统后台</span>
                        </li>
                        <li>
                            <a href="<?=Url::toRoute('site/logout');?>">
                                <i class="fa fa-sign-out"></i> 退出
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>
            <?= $content ?>
        </div>
    </div>


<?php
$js = <<<JS
$(function(){
	var index_path = $.session.get('menu_index');
	if(index_path){
		var target = "."+index_path+" ul";
		$("ul").removeClass('in');
		$("."+index_path).next().addClass("in");
        $("."+index_path).parent().addClass("active");
	}

})

$('.menu_index').on('click',function(){
    var index_path = $(this).attr('menu_index');
    $.session.set('menu_index',index_path);
});


JS;
$this->registerJs($js);
?>


</body>
<?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>
