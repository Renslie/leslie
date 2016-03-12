<?php 
use yii\helpers\Url;
 ?>
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
                                <br> <strong>留言类型</strong>
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
                                <div class="photos">
                                    <a target="_blank" href="javascript:;">
                                        <img alt="image" class="feed-photo" src="<?=$model->img?>"></a>

                                    </div>
                                    <form role="form">
                                        <div class="form-group">
                                            <textarea class="form-control "  style="resize:none;"></textarea>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" data-url="<?=Url::toRoute(['message/reply', 'id'=>$model->mess_id])?>" class="submitd btn btn-sm btn-primary m-t-n-xs">
                                                <strong>回复</strong>
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <?php } ?>