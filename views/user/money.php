 <?php 
 use yii\helpers\Url;
  ?>
 <div class="row">
     <div class="col-lg-12">
         <div class="panel blank-panel">

             <div class="panel-heading">
                 <div class="panel-title m-b-md">
                     <h4>金币增减</h4>
                 </div>
                 <p> <b>会员账号：</b>
                     <div class="input-group " style="width:30%;">
                         <input type="text"  class="name input-sm form-control"> 
                         <span class="input-group-btn">
                             <button type="button"  data-url="<?=Url::toRoute('user/addmoney')?>" class="sure btn btn-sm btn-primary langse">搜索</button>
                         </span>
                     </div>

                 </p>

                 <div  class="row ">
                     <div class="col-lg-12">
                         <div class="ibox float-e-margins" style="width:50%;height:400px;background:#fff;">
                             <div id="mon" class="form-horizontal">
                                
                            </div>
                             <div class="ibox-content" style="width:100%;">
                                 <select class="input-sm form-control input-s-sm inline h_slect"  style="width:15%;float:left;margin-right:20px;">
                                     <option value="1">赠送金币</option>
                                     <option value="2">扣除金币</option>
                                 </select>
                                 <div class="input-group h_search">
                                     <input type="text" placeholder="为空或0表示不赠送" class="mon input-sm form-control"></div> <b style="margin-top:5px;display:block;">元</b>
                             </div>
                             <p class="h_btns" style="width:10%;margin:0 auto;height:40px;margin-top:20px;">
                                 <button type="button"  data-url="<?=Url::toRoute('user/addmoney')?>" class="sub btn btn-w-m btn-primary langse">确认</button>
                             </p>
                         </div>
                     </div>
                 </div>

             </div>

         </div>
     </div>

 </div>
<?php 
$js = <<<JS
    $('.sure').click(function(){
        var url  = $(this).attr('data-url'),
            name = $('.name').val();
        $.get(url,{name:name},function(data){
            if(data.status){
                layer.alert(data.msg)
            }else{
                $('#mon').html(data);
            }
        })
    })

    $('.sub').on('click',function(){
        var data = {
            id  : $('#id').attr('name'),
            add : $('.inline').val(),
            mon : $('.mon').val()
        }
        if($.trim(data.mon) == '') return  false;
        if($.trim(data.id) == '') return  false;
        $.get($(this).attr('data-url'), data, function(res){
            layer.alert(res.msg,function(){
                location.reload();
            });
        })
    })
JS;
$this->registerJs($js);
?>
