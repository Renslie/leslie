<?php 
use yii\helpers\Url;
 ?>                                            
<div id="wrapper">
    <div id="page-wrapper" class="gray-bg dashbard-1" style="margin:0;">
        <div class="wrapper wrapper-content animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel blank-panel">
                        <div class="panel-heading">
                            <div class="panel-title m-b-md">
                                <h4><b>封号操作</b></h4>
                            </div>
                            <p> 
                                <b>请输入要封号的姓名或用户名：</b>                        
                                <div class="input-group " style="width:30%;">
                                    <input type="text" id="name" class="input-sm form-control"> <span class="input-group-btn">
                                    <button type="button" data-url="<?=Url::toRoute('user/fenghao')?>" class="sure btn btn-sm btn-primary langse"> 搜索</button> </span>
                                </div>
                            </p>

                            <div id="my" class="row">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
$js = <<<JS
    $('.sure').on('click',function(){
        var url  = $(this).attr('data-url'),
            find = $('#name').val();
        $.get(url,{find:find},function(res){
            $('#my').html(res);
        })
    })
    
    $('#my').on('click', '.fenghao', function(){

        var liyou;
            the = $(this);
        layer.prompt({
            title: '输入封号理由，并确认',
            formType: 0 
        }, function(pass){
            var url = the.attr('data-url');
            $.get(url,{liyou:pass},function(ret){
                if(ret.status == 1){
                    $('#my').empty();
                }
                layer.alert(ret.msg);
            })
        });
    })

JS;
$this->registerJs($js);
?>

