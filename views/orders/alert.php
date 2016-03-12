<?php foreach($orders as  $model){ ?>
<tr>
    <td>
        <input type="checkbox"  name="<?=$model->money?>" value="<?=$model->mate_id?>" class="i-checks" />
    </td>
    <td><?=$model->mate_id?></td>
    <td>
        <?php if($model->pay_id != 0) {
            echo  $model->pay->user->nickname;
        }else{
            echo  $model->get->user->nickname;
         } ?>
    </td>
    <td>
        <?php if($model->pay_id != 0){
            echo $model->pay->user->account;
        }else{
            echo $model->get->user->account;
        }
        ?>
    </td>
    <td>
        <?php
            $arr = ($model->pay_id != 0) ?$model->pay->pay_type :$model->get->pay_type;
            $arr = explode(',',$arr);
            foreach ($arr as $key => $value) {
                switch ($value) {
                    case 1: echo  '支付宝 '; break;
                    case 2: echo  '微信 '; break;
                    default: echo  '银行 '; break;
                }
            }
        ?>
    </td>
    <td><?=$model->money?> </td>
    <td><?php
        echo ($model->pay_id != 0)? '提供帮助' : '接受帮助';
        ?>
    </td>
    <td>匹配中</td>
    <td>暂无</td>
    <td>剩余时间： <?=date('H:i:s',86400-time()-$model->create_time)?></td>
    <td>
   <?=($model->count == 0) '否':'是'; ?>
    </td>
</tr>
<?php } ?>
