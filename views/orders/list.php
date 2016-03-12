<?php
use yii\widgets\LinkPager;
use app\models\JihuoPrompt;
 ?>
<table class="table table-striped h_table">
    <thead>
        <tr>
            <th width="5%">订单号</th>
            <th width="10%">会员名</th>
            <th>姓名</th>
            <th>支付方式</th>
            <th>金额（元）</th>
            <th>帮助类型</th>
            <th>状态</th>
            <th>匹配人</th>
            <th>匹配时间</th>
            <th>注册IP</th>
            <th>等级</th>
            <th width="20%">操作</th>
        </tr>
    </thead>
    <tbody>
<?php if(count($provider->models)){foreach($provider->models as $model){
    if($model->pay_id != 0) {
        $uid = $model->pay->user_id;
    }else{
        $uid = $model->get->user_id;
    }
    ?>
        <tr class="tr<?=$model->mate_id?>">
            <td><?=$model->mate_id?></td>
            <td><?php if($model->pay_id != 0) {
                echo  $model->pay->user->nickname;
            }else{
                echo  $model->get->user->nickname;
             } ?></td>

            <td><?php if($model->pay_id != 0){
                echo $model->pay->user->account;
            }else{
                echo $model->get->user->account;
            }
            ?></td>

            <td><?php
                $arr = ($model->pay_id != 0) ?$model->pay->pay_type :$model->get->pay_type;
                $arr = explode(',',$arr);
                foreach ($arr as $key => $value) {
                    switch ($value) {
                        case 1: echo  '支付宝 '; break;
                        case 2: echo  '微信 '; break;
                        default: echo  '银行 '; break;
                    }
                }
            ?></td>
            <td><?=$model->money?></td>
            <td><?=($model->pay_id != 0)? '提供帮助' : '接受帮助';?></td>
            <td><?php
               switch ($model->status) {
                      case 1:
                          echo '匹配中';
                          break;
                      case 2:
                          echo ($model->pay_id != 0)? '等待受方确认' : '等待供方付款';
                          break;

                       case 3:
                          echo ($model->pay_id != 0)? '已打款' : '代确认收款';
                          break;

                       case 4:
                          echo ($model->pay_id != 0)? '虚假打款' : '被举报';
                          break;

                       case 5:
                          echo ($model->pay_id != 0)? '未准时打款' : '代确认收款';
                          break;

                       case 6:
                        echo ($model->pay_id != 0)? '已打款' : '未准时确认收款';
                        break;

                       case 7:
                          echo '交易成功';
                          break;
                      default:
                          echo '未知状态';
                          break;
                  }
            ?></td>
            <td>
            <?php
            if($model->get_id && $model->pay_id){
                if($model->get_id != 0){
                    echo $model->get->user->account;
                }else{
                    echo $model->pay->user->account;
                }
            }else{
                echo '暂无';
            }
            ?></td>
            <td><?php
            if($model->status == 7){
                echo '订单已完成';
            }else{
                $jp = JihuoPrompt::findOne(1);
                if($model->status == 1){
                    $time = $jp->limt_time;
                }elseif($model->status == 2){
                    $time = $jp->get_time;
                }else{
                    $time = $jp->pay_time;
                }
                $time = $time*86400;
                if( $time < (time()-($model->create_time))){
                    echo '超出匹配时间';
                }else{
                    $hour = floor(($time-(time()-($model->create_time)))/3600);  //剩余小时
                    echo '剩余时间：',$hour,'小时';
                }
            }
            ?></td>
            <td><?php if($model->pay_id != 0) {
                echo $model->pay->user->reg_ip;
            }else{
                echo $model->get->user->reg_ip;
            }
            ?></td>
            <td><?php if($model->pay_id != 0){
                echo $model->pay->user->level->name;
            }else{
                echo $model->get->user->level->name;
             }?></td>
            <?php if ($type == 1 || $type ==2 || $type ==8){ ?>
            <td>
                <a class="btn btn-primary tan2"  onclick="split(<?=$model->mate_id?>,<?=$model->money?>)"  href="javascript:;">拆分</a>
                <a class="btn btn-info tan3"  onclick="searchOrder(<?=$model->mate_id.','.$model->money?>)" href="javascript:;">匹配</a>
                <a class="btn btn-success"  onclick="combine(<?=$model->mate_id?>)"  href="javascript:;">合并</a>
                <a class="btn btn-warning " target="_blank" href="?r=site/user-login&uid=<?=$uid?>">登入</a>
            </td>
            <?php }elseif( $type == 3 ){ ?>
                <td>
                    <a class="btn btn-default" onclick="del(<?=$model->mate_id?>)" href="javascript:;">删除</a>
                </td>
            <?php }elseif( $type == 4 ){ ?>
                <td>
                    <a class="btn btn-primary" onclick="replay(<?=$model->mate_id?>)" href="javascript:;"><?=
                        ($model->status == 6)? '确认收款' : '重新分配';
                    ?></a>
                </td>
            <?php } ?>

        </tr>
<?php }}else{
    //echo '暂无数据';
    } ?>
    </tbody>
</table>
<?=
    LinkPager::widget([
    'pagination' => $provider->pagination,
    'options' => ['class' => 'pagination pull-left', 'style' => 'margin:0px'],

    ]);
?>
