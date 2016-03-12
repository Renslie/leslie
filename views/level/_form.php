<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\Models\Level */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins" style="width:100%;height:400px;background:#fff;">

            <div class="ibox-content" >
                <?php $form = ActiveForm::begin([
                        'options' =>[
                            'class' => 'form-horizontal',
                        ]
                  ]);
                ?>
                <div class="form-group">
                    <label class="col-lg-4 control-label">等级名称：</label>
                    <div class="col-lg-3">
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(FALSE) ?></div>
                </div>

                <div class="form-group">
                    <label class="col-lg-4 control-label">推荐人数：</label>
                    <div class="col-lg-3">
                        <?= $form->
                        field($model, 'recommend')->textInput(['maxlength' => true])->label(FALSE) ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-4 control-label">投资额度（元）：</label>
                    <div class="col-lg-3">
                        <?= $form->
                        field($model, 'tz_money')->textInput(['maxlength' => true])->label(FALSE) ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-4 control-label">佣金类别：</label>
                    <div class="col-lg-3">
                        <?= $form->
                        field($model, 'bonus_type')->dropDownList(['1'=>'推荐奖金', 2=>'经理奖金'],[],[],['class'=>'input-sm form-control input-s-sm inline'])->label(FALSE) ?>
                    </div>
                </div>
                
                <div id="moneylog">
                    <?php if(!$model->isNewRecord){ foreach($model->num as $k=>$v){ ?>
                    <div class="form-group">
                        <label class="col-lg-4 control-label"><?=$k+1?> 代佣金（%）：</label>
                        <div class="col-lg-3">
                           <input type="text" value="<?=$v?>" name="Level[num][]" class="form-control" id="level-tz_money">
                        </div>
                    </div>
                    <?php }}else{ ?>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">1 代佣金（%）：</label>
                            <div class="col-lg-3">
                               <input type="text" value="0" name="Level[num][]" class="form-control" id="level-tz_money">
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label"></label>
                    <div class="col-lg-3">
                        <a class="btn btn-primary" id="add" href="javascript:;">新增代数</a>
                        <a class="btn btn-primary" id="del" href="javascript:;">减去代数</a>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-4 control-label">如下级一个会员投资额度减少，对该会员的佣金减少额度（%）：</label>
                    <div class="col-lg-3">
                        <?= $form->field($model, 'next_money_less')->textInput()->label(FALSE)?></div>
                </div>

                <div class="form-group">
                    <label class="col-lg-4 control-label">月投资金额减少，扣除本月佣金奖励额度（%）：</label>
                    <div class="col-lg-3">
                        <?= $form->field($model, 'month_money_less')->textInput()->label(FALSE) ?></div>
                </div>
                 <p class="h_btns" style="width:20%;margin:0 auto;height:40px;">
                     <button type="button" onclick="history.go(-1)" class="btn btn-w-m btn-default cancle">取消</button>
                     <?= Html::submitButton('确定', ['class' => 'btn btn-w-m btn-primary']) ?>
                 </p>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>