<?php
use app\models\Orders;
foreach($good as $v){ 
$get = Orders::findOne($v[0]);
$pay = Orders::findOne($v[1]);
?>
<tr>
    <td>
        <input type="checkbox" value="<?=$get->mate_id.','.$pay->mate_id?>"  class="i-checks" />
    </td>
    <td><?=$pay->mate_id?></td>
    <td><?=$get->mate_id?></td>
    <td><?=$get->get->user->account?></td>
    <td><?=$get->get->user->reg_ip?></td>
    <td><?=$pay->pay->user->account?></td>
    <td><?=$pay->pay->user->reg_ip?></td>
    <td><?=$pay->money?> </td>
</tr>
<?php } ?>