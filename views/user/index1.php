<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Json;
use app\models\UserRelation;
use app\models\User;
?>
<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel blank-panel">
                <div class="panel-heading">
                    <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-user"></i> &nbsp; 正常会员管理</h2>
                    </div>
                    <p>
                        <div class="input-group h_search">
                            <input  type="text" placeholder="请输入关键词" class="inputid input-sm form-control"> <span class="input-group-btn">
                            <?= Html::submitButton('搜索', ['class' => 'leslie btn btn-sm  btn-primary langse']) ?></span>
                        </div>

                        <b class="h_title">等级：</b>
                        <select  name="level" class="level input-sm form-control input-s-sm inline h_slect" >
                            <option value="">请选择等级</option>
                            <?php foreach($level as $v){ ?>
                                 <option value="<?=$v->level_id?>"><?=$v->name?></option>
                            <?php } ?>
                            <!-- <option value="1">VIP会员</option>
                            <option value="2">黄金会员</option>
                            <option value="3">铂金会员</option>
                            <option value="4">钻石会员</option> -->
                        </select>

                        <b class="h_title">激活:</b>
                        <select name="is_active" class="is_active input-sm form-control input-s-sm inline h_slect" style="width:6%;" >
                            <option value="">是否激活</option>
                            <option value="1">是</option>
                            <option value="0">否</option>
                        </select>
                    </p>
                    <div class="table-responsive" style="border:1px solid #ddd;">
                        <table class="table table-striped h_table">
                            <thead>
                                <tr>
                                    <th>编号</th>
                                    <th>姓名</th>
                                    <th>会员用户名</th>
                                    <th>推荐人</th>
                                    <th>金币</th>
                                    <th>注册时间</th>
                                    <th>注册IP</th>
                                    <th>相同IP</th>
                                    <th>等级</th>
                                    <th>激活</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($dataProvider->models as $user){ ?>
                                <tr data-id="<?=$user->user_id?>">
                                    <td><?=$user->user_id?></td>
                                    <td><?=$user->nickname ?></td>
                                    <td><?=$user->account ?></td>
                                    <td>
                                        <?php
                                        $id = UserRelation::findOne($user->user_id)->parent_id;
                                        $par =  $id == 0 ? $user->account :User::findOne($id)->account;
                                        echo $par;
                                        ?>
                                    </td>
                                    <td><?=$user->flow_money ?></td>
                                    <td><?=date('Y-m-d',$user->create_time); ?></td>
                                    <td><?=$user->reg_ip?></td>
                                    <td><a onclick="count(<?=($user->ip_id)?:0;?>)" style="color:red;" href="#"><?=($user->ip_id)? $user->ip->count  : 0 ;?></a></td>
                                    <td><?=$user->level->name?></td>
                                    <td><?=$user->is_active==1?'是':'否';?></td>
                                    <td>
                                        <a class="btn btn-primary tan1" data-time="<?=date('Y-m-d',$user->create_time)?>" data-parent='<?=Json::encode(['id'=>$id,'name'=>$par])?>'  data-data='<?=Json::encode($user)?>' href="javascript:;">修改</a>
                                        <a class="btn btn-info" target="_blank" href="?r=site/user-login&uid=<?=$user->user_id?>">登入</a>
                                        <a class="btn btn-success"  href="<?=Url::toRoute(['orders/orderlist', 'id' => $user->user_id])?>">查看交易明细表</a>
                                        <a class="btn btn-warning tan3"  data-fh="<?=Url::toRoute('user/fenghao').'&id='.$user->user_id?>" href="javascript:;">封号</a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>

                        <div class="pages" style="width:80%;margin:0 auto;text-align: center;">
                             <?=
                             LinkPager::widget([
                                'pagination' => $dataProvider->pagination,
                                'options' => ['class' => 'pagination pull-center', 'style' => 'margin:0px']
                            ]);
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                <div class="theme-popover-mask" ></div><!-- 遮罩 -->

                <!-- 修改弹框内容 -->
                <div class="pop them1" style="height:auto;padding-bottom:3rem;width:71%;position:absolute;margin-left:-35%;">
                    <div class="pop_title pr">修改<span class="close "></span></div>

                    <div class="pop_all" style="padding-bottom:40px;">
                          <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-content" >
                                    <?php $form = ActiveForm::begin([
                                        'id' => 'edit-form',
                                        'action' => Url::toRoute('user/edituser'),
                                    ]); ?>
                                        <div  class="form-horizontal" style="width:50%;float:left;">
                                            <div class="form-group">
                                                <label class="col-lg-4 control-label">会员用户名：</label>
                                                <div class="col-lg-3">
                                                    <p  id="account" class="form-control-static">ajhqw</p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">姓名：</label>
                                                <div class="col-sm-5">
                                                    <?= $form->field($model,'nickname',['inputOptions'=>['class'=>'form-control']])->label(FALSE); ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">金币：</label>
                                                <div class="col-sm-5">
                                                    <?= $form->field($model,'fixation_money',['inputOptions'=>['class'=>'form-control']])->label(FALSE); ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-4 control-label">推荐人：</label>
                                                <div class="col-lg-5">
                                                    <p class="form-control-static"><a id="pare" href="#">鼠打王</a></p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-4 control-label">注册时间：</label>
                                                <div class="col-lg-5">
                                                    <p id="user-create_time" class="form-control-static">2016-1-3</p>
                                                </div>
                                            </div>

                                             <div class="form-group">
                                                <label class="col-lg-4 control-label">注册IP：</label>
                                                <div class="col-lg-5">
                                                    <p id="user-reg_id" class="form-control-static">广东 广州</p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-4 control-label">相同IP：</label>
                                                <div class="col-lg-5">
                                                    <p class="form-control-static">5</p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">电话：</label>
                                                <div class="col-sm-5">
                                                    <?= $form->field($model,'phone',['inputOptions'=>['class'=>'form-control']])->label(FALSE); ?>
                                                </div>
                                            </div>
                                        </div>
                                         <div method="get" class="form-horizontal" style="width:50%;float:left;">
                                            <div class="form-group">
                                                <label class="col-lg-4 control-label">微信号：</label>
                                                 <div class="col-sm-5">
                                                    <?= $form->field($model,'weixin',['inputOptions'=>['class'=>'form-control']])->label(FALSE); ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">支付宝：</label>
                                                <div class="col-sm-5">
                                                    <?= $form->field($model,'alipay',['inputOptions'=>['class'=>'form-control']])->label(FALSE); ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">银行账号：</label>
                                                <div class="col-sm-5">
                                                    <input type="text" value="0" name="User[bank][bk1]" class="form-control" id="bk1">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">开户银行：</label>
                                                <div class="col-sm-5">
                                                    <input type="text" value="0" name="User[bank][bkc1]" class="form-control" id="bkc1">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">开户支行：</label>
                                                <div class="col-sm-5">
                                                    <input type="text" value="0" name="User[bank][bk_zh1]" class="form-control" id="bk_zh1">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">开户名：</label>
                                                <div class="col-sm-5">
                                                    <input type="text" value="0" name="User[bank][name1]" class="form-control" id="bname1">
                                                </div>
                                            </div>

                                             <div class="form-group">
                                                <label class="col-sm-4 control-label">银行账号2：</label>
                                                <div class="col-sm-5">
                                                    <input type="text" value="0" name="User[bank][bk2]" class="form-control" id="bk2">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">开户银行2：</label>
                                                <div class="col-sm-5">
                                                    <input type="text" value="0" name="User[bank][bkc2]" class="form-control" id="bkc2">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">开户支行：</label>
                                                <div class="col-sm-5">
                                                    <input type="text" value="0" name="User[bank][bk_zh2]" class="form-control" id="bk_zh2">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">开户名2：</label>
                                                <div class="col-sm-5">
                                                    <input type="text" value="0" name="User[bank][name2]" class="form-control" id="bname2">
                                                </div>
                                            </div>

                                             <div class="form-group">
                                                <label class="col-lg-4 control-label">登录密码：</label>
                                                <div class="col-lg-5">
                                                    <p class="form-control-static"><a href="javascript:;" name="log" class="tan2">重置</a></p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-4 control-label">交易密码：</label>
                                                <div class="col-lg-5">
                                                    <p class="form-control-static"><a href="javascript:;" name="tra" class="tan2">重置</a></p>
                                                </div>
                                            </div>

                                             <div class="form-group">
                                                <label class="col-lg-4 control-label">等级：</label>
                                                <div class="col-lg-5">
                                                    <select id="user-level_id" name="User[level]" class="form-control" >
                                                        <?php foreach($level as $v){ ?>
                                                             <option value="<?=$v->level_id?>"><?=$v->name?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" value="0" name="User[user_id]" class="form-control" id="pwd_user_id">
                                     <p class="h_btns">
                                        <button type="button" class="btn btn-w-m btn-default cancle">取消</button>
                                        <button type="submit" class="btn btn-w-m btn-primary">确定</button>
                                    </p>
                                    <?php ActiveForm::end(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 修改弹框内容 -->

                 <!-- 重置密码弹框内容 -->
                <div class="pop them2" style="top:50%;padding-bottom:3rem;">
                    <div class="pop_title pr">重置密码<span class="close "></span></div>
                    <div class="pop_all">
                         <div class="ibox-content" >
                         <?php ActiveForm::begin([
                            'id'     => 'pwd-form',
                            'action' => Url::toRoute('user/edituser'),
                            'options'=>['class' => 'form-horizontal']
                         ]) ?>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">新密码：</label>
                                <div class="col-sm-5">
                                    <input id="passd" value="" placeholder="请输入新密码" type="password" name=""  class="form-control">
                                </div>
                            </div>
                        </div>
                        <p class="h_btns">
                            <button type="button" class="btn btn-w-m btn-default cancle">取消</button>
                            <?= Html::submitButton('确定',['class'=>'btn btn-w-m btn-primary']); ?>
                        </p>
                        <?= $form->field($model,'user_id')->hiddenInput()->label(FALSE); ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>

                <!-- 重置密码弹框内容 -->

                <!-- 输入封号理由弹框内容 -->
                <div class="pop them3" style="top:30%;padding-bottom:3rem;width:20%;margin-left:-10%;">
                    <div class="pop_title pr">请输入封号理由<span class="close "></span></div>

                    <div class="pop_all">
                        <textarea class="h_chai"></textarea>
                        <p class="h_btns" style="width:272px;height:79px;position:absolute;left:10%;">
                            <button type="button" class="btn btn-w-m btn-default cancle">取消</button>
                            <button type="button" class="sure btn btn-w-m btn-primary">确定</button>
                        </p>
                    </div>
                </div>

                <!-- 输入封号理由弹框内容 -->


            <!-- 弹窗 -->
<?php
$js = <<<JS

//修改资料弹窗
$("body").on('click', '.tan1', function(event) {
    var data = JSON.parse($(this).attr('data-data')),
        parent = JSON.parse($(this).attr('data-parent'));
        bank   = JSON.parse(data.bank);
    $('#account').text(data.account);
    $('#user-create_time').text($(this).attr('data-time'));
    $('#user-fixation_money').val(data.fixation_money);
    $('#user-nickname').val(data.nickname);
    $('#pare').text(parent.name);
    $('#user-reg_id').val(data.reg_id);
    $('#user-phone').val(data.phone);
    $('#user-weixin').val(data.weixin);
    $('#user-alipay').val(data.alipay);
    $('#user-user_id').val(data.user_id);
    $('#pwd_user_id').val(data.user_id);
    if(bank){
        $('#bk1').val(bank.bk1);
        $('#bk2').val(bank.bk2);
        $('#bkc1').val(bank.bkc1);
        $('#bkc2').val(bank.bkc2);
        $('#bk_zh1').val(bank.bk_zh1);
        $('#bk_zh2').val(bank.bk_zh2);
        $('#bname1').val(bank.name1);
        $('#bname2').val(bank.name2);
    }
    pop_Up1();
    $('#edit-form').on('beforeSubmit',function(){
        ajaxSubmitForm($(this),function(data){
            if(data.status == 1){
                location.reload();
            }
        })
        return false;
    })
});

//重置密码弹窗
$("body").on('click', '.tan2', function(event) {
    var type = $(this).attr('name');
    pop_Up2();
    $('#passd').attr('name','User[pwd_'+type+']');
    $('#passd').val('');
    $('#pwd-form').on('beforeSubmit',function(){
        if($('#passd').val() == '') {
            layer.msg('请输入新密码')
            return false
        }
        ajaxSubmitForm($(this),function(){
            $('.them2').hide();
        })
        return false
    })
});

//封号弹窗
$("body").on('click', '.tan3', function(event) {
    var the = $(this);
    var url = $(this).attr('data-fh'),
        data={
            liyou : $('.h_chai').val()
        }
    pop_Up3();
    $('.sure').unbind().on('click',function(msg){
        data.liyou = $('.h_chai').val();
        $.get(url,data,function(ret){
            if(ret.status ==1){
                the.parents('tr').remove();
            }
            layer.alert(ret.msg);
            $(".cancle").trigger('click');
        })
    })
});

$('.leslie').on('click',function(){
    var url = '';
    url += '&level='+ $('.level').val();
    url += '&is_active='+ $('.is_active').val();
    url += '&id='+ $('.inputid').val();
    location.href = '?r=user/index'+url;
})

window.count = function( id ){
    if(id == 1){
        layer.msg('该ip地址只有此用户')
        return false;
    }
    var url = '';
    url += '&ip='+ id;
    location.href = '?r=user/index&type=4'+url;
}

JS;
$this->registerJs($js);
 ?>
