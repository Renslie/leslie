<?php 
use yii\widgets\LinkPager;
 ?>
  <div id="wrapper">
      <div id="page-wrapper" class="gray-bg dashbard-1" style="margin:0;">

          <div class="wrapper wrapper-content animated fadeIn">

              <div class="row">
                  <div class="col-lg-12">
                      <div class="panel blank-panel">

                          <div class="panel-heading">
                              <div class="panel-title m-b-md">
                                  <h4><b><?=$user->account?>(<?=$user->nickname?>)</b>
                                      的交易明细
                                  </h4>
                              </div>
                              <p>

                                  <div class="input-group h_search">
                                      <input type="text" placeholder="请输入关键词" class="name input-sm form-control">  
                                      <span class="input-group-btn">
                                          <button type="button" id="sousuo" class="btn btn-sm btn-primary">搜索</button>
                                      </span>
                                  </div>
                                  <button type="button" class="btn btn-primary btn-sm">导出表格</button>
                              </p>
                              <div class="table-responsive" style="border:1px solid #ddd;">
                                  <table class="table table-striped h_table">
                                      <thead>
                                          <tr>
                                              <th>下单时间</th>
                                              <th>订单号</th>
                                              <th>支付方式</th>
                                              <th>金额（元）</th>
                                              <th>帮助类型</th>
                                              <th>状态</th>
                                              <th>匹配人</th>
                                              <th>匹配时间</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <?php foreach ($provider->models as $order): ?>
                                          <tr>
                                              <td><?=date('Y-m-d',$order->create_time)?></td>
                                              <td><?=$order->mate_id?></td>
                                              <td>
                                                    <?php
                                                    $aa = ($order->pay_id != 0) ?$order->pay->pay_type :$order->get->pay_type;
                                                    switch ($aa) {
                                                        case 1: echo  '支付宝'; break;
                                                        case 2: echo  '微信'; break;
                                                        default: echo  '银行'; break;
                                                    }
                                                ?>        
                                              </td>
                                              <td><?=$order->money?></td>
                                              <td><?=($order->pay_id != 0)? '提供帮助' : '接受帮助';?></td>
                                              <td><?php 
                                              switch ($order->status) {
                                                  case 1:
                                                      echo '匹配中';
                                                      break;
                                                  case 2:
                                                      echo ($order->pay_id != 0)? '等待受方确认' : '等待供方付款';
                                                      break;

                                                   case 3:
                                                      echo ($order->pay_id != 0)? '已打款' : '代确认收款';
                                                      break;
                                                   
                                                   case 4:
                                                      echo ($order->pay_id != 0)? '虚假打款' : '被举报';
                                                      break;
                                                   
                                                   case 5:
                                                      echo ($order->pay_id != 0)? '未准时打款' : '代确认收款';
                                                      break;

                                                   case 6:
                                                    echo ($order->pay_id != 0)? '已打款' : '未准时确认收款';
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
                                                  <?php if($order->pay_id != 0) {
                                                    echo  $order->pay->user->nickname; 
                                                }else{
                                                    echo  $order->get->user->nickname;
                                                 } ?>
                                              </td>
                                              <td>剩余12：00小时</td>
                                          </tr>
                                        <?php endforeach ?>
                                      </tbody>
                                  </table>
                                  <?=
                                        LinkPager::widget([
                                        'pagination' => $provider->pagination,
                                        'options' => ['class' => 'pagination pull-left', 'style' => 'margin:0px'],
                                        ]);
                                    ?>
                              </div>
                                <a href="?r=orders/index"><botton class="btn btn-primary" style="margin-top:20px;">返回</botton></a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <?php 
$js = <<<JS
    $('#sousuo').click(function(){
        var url = location.search
        location.href = url+'&mid='+$('.name').val();
    })
JS;
$this->registerJS($js);
?>