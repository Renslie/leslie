<div id="id" name="<?=$model->user_id?>"></div>
<div class="form-group">
    <label class="col-lg-4 control-label">姓名：</label>
    <div class="col-lg-3">
        <p class="form-control-static"><?=$model->account?></p>
    </div>
</div>

<div class="form-group">
    <label class="col-lg-4 control-label">电话：</label>
    <div class="col-lg-3">
        <p class="form-control-static"><?=$model->phone?></p>
    </div>
</div>

<div class="form-group">
    <label class="col-lg-4 control-label">金币</label>
    <div class="col-lg-3">
        <p class="form-control-static"><?=$model->flow_money?></p>
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
