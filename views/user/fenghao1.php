<?php
use yii\helpers\Url;
 ?>
<div class="col-lg-12">
    <div class="ibox float-e-margins" style="width:100%;height:400px;background:#fff;">
        <div class="ibox-content" >
         <form method="get" class="form-horizontal" >
                <div class="form-group">
                    <label class="col-lg-4 control-label">姓名：</label>
                    <div class="col-lg-3">
                        <p class="form-control-static"><?=$model->account?></p>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-lg-4 control-label">用户名：</label>
                    <div class="col-lg-3">
                        <p class="form-control-static"><?=$model->nickname?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">电话：</label>
                    <div class="col-lg-3">
                        <p class="form-control-static"><?=$model->phone?></p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-4 control-label">推荐人</label>
                    <div class="col-lg-3">
                        <p class="form-control-static"><?=$model->user_id?></p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-4 control-label">微信号：</label>
                    <div class="col-lg-3">
                        <p class="form-control-static"><?=$model->weixin?></p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-4 control-label">注册IP：</label>
                    <div class="col-lg-3">
                        <p class="form-control-static"><?=$model->reg_ip?></p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-4 control-label">等级：</label>
                    <div class="col-lg-3">
                        <p class="form-control-static"><?=$model->level->name?></p>
                    </div>
                </div>
        </form>
            <p class="h_btns" style="width:30%;margin:0 auto;height:40px;">
                <button type="button" onclick="history.go(-1)" class="btn btn-w-m btn-default cancle">取消</button>
                <button type="button" name="<?=$model->user_id?>" data-url="<?=Url::toRoute('user/fenghao').'&id='.$model->user_id?>" class="fenghao btn btn-w-m btn-primary">确认操作</button>
            </p>
        </div>
    </div>
</div>
