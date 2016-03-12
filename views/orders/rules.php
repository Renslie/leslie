<?php 
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div id="wrapper">

    <div id="page-wrapper" class="gray-bg dashbard-1" style="margin:0;">

        <div class="row wrapper border-bottom white-bg page-heading" style="width:100%;">
            <div class="col-lg-10" style="margin-top:20px;">
                <h3>规则设置</h2>

            </div>

        </div>
        <div class="wrapper wrapper-content  animated fadeInRight">
                <div class="row">
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>接受帮助</h5>

                        </div>
                        <div class="ibox-content">
                            <?php
                                $form = ActiveForm::begin([
                                    'id' => 'get-form',
                                    'options' => [
                                        'class' => 'form-horizontal',
                                    ],
                                ]);
                            ?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">金额范围（元）：</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <?= $form->field($get,'min_money',['inputOptions'=>['placeholder'=>'最小金额','class' => 'form-control']])->label(false) ?>
                                        </div>
                                        <div class="col-md-1" style="margin-top:8px;">----</div>
                                        <div class="col-md-2">
                                            <?= $form->field($get,'max_money',['inputOptions'=>['placeholder'=>'最大金额','class' => 'form-control']])->label(false) ?>
                                        </div>
                                        <?= $form->field($get, 'grid')->hiddenInput()->label(false) ?></div>
                                </div>
                            </div>
                    
                            <div class="form-group">
                                <label class="col-sm-3 control-label">金额输入倍数：</label>

                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <?= $form->field($get,'mlutiple',['inputOptions'=>['placeholder'=>'金额输入倍数','class' => 'form-control']])->label(false) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">每月接受帮助总额度（元）：</label>

                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <?= $form->field($get,'help_money_month',['inputOptions'=>['placeholder'=>'300','class' => 'form-control']])->label(false) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                <div class="form-group">
                                    <label class="col-sm-1 control-label"></label>

                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-md-2" style="width:20%;margin-top:5px;">每次接受帮助</div>
                                            <div class="col-md-2">
                                                <?= $form->field($get,'after_recive_days',['inputOptions'=>['placeholder'=>'300','class' => 'form-control']])->label(false) ?>
                                            </div>
                                            <div class="col-md-4" style="width:40%;margin-top:5px;">天后，可进行第二次接受帮助。</div>
                                        </div>
                                    </div>
                                </div>
                                <?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
                                <?php ActiveForm::end(); ?>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins no-drop">
                            <div class="ibox-title">
                                <h5>推荐奖金</h5>
                            </div>
                            <div class="ibox-content">
                            <?php
                                $form = ActiveForm::begin([
                                    'id' => 'tj-form',
                                    'options' => [
                                        'class' => 'form-horizontal',
                                    ],
                                ]);
                            ?>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">每次提现额度（元）：</label>

                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <?= $form->field($tj,'money',['inputOptions'=>['placeholder'=>'每次提现额度','class' => 'form-control']])->label(false) ?>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">每月最多提现次数：</label>

                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-md-4">
                                                     <?= $form->field($tj,'tx_days',['inputOptions'=>['placeholder'=>'每月最多提现次数','class' => 'form-control']])->label(false) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-1 control-label"></label>

                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-md-2" style="width:23%;margin-top:5px;">每轮投资额度超</div>
                                                <div class="col-md-2">
                                                    <?= $form->field($tj,'exceed_money',['inputOptions'=>['placeholder'=>'投资额度上限','class' => 'form-control']])->label(false) ?>
                                                </div>
                                                <div class="col-md-4" style="width:45%;margin-top:5px;">元，以上两条不成立</div>
                                            </div>
                                        </div>
                                    </div>
                                    <?= $form->field($tj, 'bonus_type_id')->hiddenInput()->label(false) ?>
                            <?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
                            <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>提供帮助</h5>
                                
                            </div>
                            <div class="ibox-content">
                             <?php
                                $form = ActiveForm::begin([
                                    'id' => 'pay-form',
                                    'options' => [
                                        'class' => 'form-horizontal',
                                    ],
                                ]);
                            ?>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">金额范围（元）：</label>

                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-md-2">
                                                <?= $form->field($pay,'min_money',['inputOptions'=>['placeholder'=>'最小金额','class' => 'form-control']])->label(false) ?>
                                                </div>
                                                <div class="col-md-1" style="margin-top:8px;">----</div>
                                                <div class="col-md-2">
                                                 <?= $form->field($pay,'max_money',['inputOptions'=>['placeholder'=>'最大金额','class' => 'form-control']])->label(false) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">金额输入倍数：</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <?= $form->field($pay,'mlutiple',['inputOptions'=>['placeholder'=>'金额输入倍数','class' => 'form-control']])->label(false) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">利率（%）：</label>

                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <?= $form->field($pay,'rate',['inputOptions'=>['placeholder'=>'利率','class' => 'form-control']])->label(false) ?>
                                                </div>

                                                <div class="col-md-7" style="margin-top:8px;">*从用户提供帮助操作成功后开始算。</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">不得提现天数：</label>

                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <?= $form->field($pay,'limit_days',['inputOptions'=>['placeholder'=>'不得提现天数','class' => 'form-control']])->label(false) ?>
                                                </div>

                                                <div class="col-md-7" style="margin-top:8px;">*从用户提供帮助操作成功后开始算。</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">利息天数：</label>

                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <?= $form->field($pay,'interest_days',['inputOptions'=>['placeholder'=>'利息天数','class' => 'form-control']])->label(false) ?>
                                                </div>

                                                <div class="col-md-7" >*达到该天数后，不再获得利息，本金与利息也自动转回钱包。</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">每月提供帮助总额度（元）：</label>

                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <?= $form->field($pay,'help_money_month',['inputOptions'=>['placeholder'=>'每月提供帮助总额度','class' => 'form-control']])->label(false) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-1 control-label"></label>

                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-md-2" style="width:20%;margin-top:5px;">每次接受帮助</div>
                                                <div class="col-md-2">
                                                    <?= $form->field($pay,'after_pay_days',['inputOptions'=>['placeholder'=>'每次接受帮助','class' => 'form-control']])->label(false) ?>
                                                </div>
                                                <div class="col-md-4" style="width:40%;margin-top:5px;">天后，可进行第二次接受帮助。</div>
                                            </div>
                                        </div>
                                    </div>
                            <?= $form->field($pay, 'prid')->hiddenInput()->label(false) ?>
                            <?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
                            <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="ibox float-e-margins no-drop">
                            <div class="ibox-title">
                                <h5>经理奖金</h5>

                            </div>
                            <div class="ibox-content">
                            <?php
                                $form = ActiveForm::begin([
                                    'id' => 'jl-form',
                                    'options' => [
                                        'class' => 'form-horizontal',
                                    ],
                                ]);
                            ?>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">每次提现额度（元）：</label>

                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <?= $form->field($jl,'money',['inputOptions'=>['placeholder'=>'每次提现额度','class' => 'form-control']])->label(false) ?>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">每月最多提现次数：</label>

                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-md-4">
                                                     <?= $form->field($jl,'tx_days',['inputOptions'=>['placeholder'=>'每月最多提现次数','class' => 'form-control']])->label(false) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-1 control-label"></label>

                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-md-2" style="width:23%;margin-top:5px;">每轮投资额度超</div>
                                                <div class="col-md-2">
                                                    <?= $form->field($jl,'exceed_money',['inputOptions'=>['placeholder'=>'投资额度上限','class' => 'form-control']])->label(false) ?>
                                                </div>
                                                <div class="col-md-4" style="width:45%;margin-top:5px;">元，以上两条不成立</div>
                                            </div>
                                        </div>
                                    </div>
                            <?= $form->field($jl, 'bonus_type_id')->hiddenInput()->label(false) ?>
                            <?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
                            <?php ActiveForm::end(); ?>
                            </div>


                            <div class="ibox-title">
                                <h5>时间设置:</h5>
                            </div>
                            <div class="ibox-content">
                             <?php
                                $form = ActiveForm::begin([
                                    'id' => 'time-form',
                                    'options' => [
                                        'class' => 'form-horizontal',
                                    ],
                                ]);
                            ?>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">收款时间（天）</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <?= $form->field($tt,'get_time',['inputOptions'=>['placeholder'=>'金额输入倍数','class' => 'form-control']])->label(false) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">打款时间（天）</label>

                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <?= $form->field($tt,'pay_time',['inputOptions'=>['placeholder'=>'利率','class' => 'form-control']])->label(false) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">匹配中（天）</label>

                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <?= $form->field($tt,'limt_time',['inputOptions'=>['placeholder'=>'不得提现天数','class' => 'form-control']])->label(false) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
                            <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                </div>
            </div>
        </div>
    </div>
<?php 
$js = <<<JS
    $("#get-form,#pay-form,#tj-form,#jl-form,#time-form").on('beforeSubmit',function(e){
        ajaxSubmitForm($(this));
        return false;
    });
JS;
$this->registerJs($js);
?>