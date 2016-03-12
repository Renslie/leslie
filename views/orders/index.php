            <div class="wrapper wrapper-content animated fadeIn">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel blank-panel">

                            <div class="panel-heading">
                                <div class="panel-title m-b-md">
                                    <h4>首页</h4>
                                </div>
                                <div class="panel-options">

                                    <ul class="nav nav-tabs">
                                        <li class="tab1">
                                            <a data-toggle="tab" href="tabs_panels.html#tab-1">帮助管理</a>
                                        </li>
                                        <li class="tab2">
                                            <a data-toggle="tab" href="tabs_panels.html#tab-2">订单管理</a>
                                        </li>
                                        <li class="tab3">
                                            <a data-toggle="tab" href="tabs_panels.html#tab-3">打款异常处理</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane active" >
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="ibox float-e-margins">
                                                    <div class="ibox-title">
                                                        <h5>帮助管理</h5>
                                                    </div>
                                                    <div class="ibox-content">
                                                        <div>

                                                            <b class="h_title" style="float:left;margin-top:5px;">帮助类型:</b>
                                                            <select con="1" class="sub1-type input-sm form-control input-s-sm inline h_slect" style="float:left;">
                                                                <option value="1">提供帮助</option>
                                                                <option value="2">接受帮助</option>
                                                            </select> <b class="h_title" style="float:left;margin-top:5px;">时间：</b>
                                                            <select class="sub1-time1 input-sm form-control input-s-sm inline h_slect" style="width:6%;float:left;" >
                                                                <option value="0">选择年</option>
                                                                <option value="2015">2015</option>
                                                                <option value="2016">2016</option>
                                                                <option value="2017">2017</option>
                                                            </select>
                                                            <b style="float:left;margin-top:5px;">年</b>
                                                            <select class="sub1-time2 input-sm form-control input-s-sm inline h_slect" style="width:6%;float:left;" >
                                                                <option value="0">选择月</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                                <option value="7">7</option>
                                                                <option value="8">8</option>
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                                <option value="12">12</option>
                                                            </select>
                                                            <b style="float:left;margin-top:5px;">月</b>

                                                            <b class="h_title fl" style="float:left;margin-top:5px;">状态:</b>
                                                            <select con="1" type="1" class="sub1-status input-sm form-control input-s-sm inline h_slect" style="float:left;">
                                                                <option value="1">匹配中</option>
                                                                <option value="2">等待供方付款</option>
                                                            </select>

                                                            <div class="input-group h_search" style="float:left;margin-left:20px;">
                                                                <input type="text" placeholder="订单号搜索" class="sub1-name input-sm form-control">
                                                                <span class="input-group-btn">
                                                                    <button id="sub1" type="button" class="btn btn-sm btn-primary langse">搜索</button>
                                                                </span>
                                                            </div>

                                                            <button type="button"  id="auto" class="btn btn-primary btn-sm tan1 langse" style="float:left;margin-bottom:0 !important;margin:0 20px 0 20px">自动操作</button>
                                                            <button type="button" id="excel1" class="btn btn-primary btn-sm langse" style="float:left;margin-bottom:0 !important;">导出表格</button>
                                                        </div>

                                                        <div id="index1" class="table-responsive" style="width:100%;">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div id="tab-2" class="tab-pane">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="ibox float-e-margins">
                                                    <div class="ibox-title">
                                                        <h5>订单管理</h5>

                                                    </div>
                                                    <div class="ibox-content">



                                                        <div>

                                                            <b class="h_title" style="float:left;margin-top:5px;">时间：</b>
                                                            <select class="sub2-time1 input-sm form-control input-s-sm inline h_slect" style="width:6%;float:left;" >
                                                                <option value="0">选择年</option>
                                                                <option value="2015">2015</option>
                                                                <option value="2016">2016</option>
                                                                <option value="2017">2017</option>
                                                            </select>
                                                            <b style="float:left;margin-top:5px;">年</b>
                                                            <select class="sub2-time2 input-sm form-control input-s-sm inline h_slect" style="width:6%;float:left;" >
                                                                <option value="0">选择月</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                                <option value="7">7</option>
                                                                <option value="8">8</option>
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                                <option value="12">12</option>
                                                            </select>
                                                            <b style="float:left;margin-top:5px;">月</b>

                                                            <b class="h_title fl" style="float:left;margin-top:5px;">状态:</b>
                                                            <select con="2" type="3" class="sub2-status input-sm form-control input-s-sm inline h_slect" style="float:left;">
                                                               <option value="1">交易完成</option>
                                                                <option value="2">未完成交易</option>
                                                            </select>

                                                            <div class="input-group h_search" style="float:left;margin-left:20px;">
                                                                <input type="text" placeholder="订单号搜索" class="sub2-name input-sm form-control">
                                                                <span class="input-group-btn">
                                                                    <button id="sub2" type="button" class="btn btn-sm btn-primary">搜索</button>
                                                                </span>
                                                            </div>


                                                            <button type="button" id="excel2" class="btn btn-primary btn-sm" style="float:left;margin-bottom:0 !important;">导出表格</button>
                                                        </div>

                                                        <div id="index2" class="table-responsive" style="width:100%;">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div id="tab-3" class="tab-pane">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="ibox float-e-margins">
                                                    <div class="ibox-title">
                                                        <h5>打款异常处理</h5>
                                                    </div>
                                                    <div class="ibox-content">

                                                         <div>

                                                            <b class="h_title" style="float:left;margin-top:5px;">时间：</b>
                                                            <select class="sub3-time1 input-sm form-control input-s-sm inline h_slect" style="width:6%;float:left;" >
                                                                <option value="0">选择年</option>
                                                                <option value="2015">2015</option>
                                                                <option value="2016">2016</option>
                                                                <option value="2017">2017</option>
                                                            </select>
                                                            <b style="float:left;margin-top:5px;">年</b>
                                                            <select class="sub3-time2 input-sm form-control input-s-sm inline h_slect" style="width:6%;float:left;" >
                                                                <option value="0">选择月</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                                <option value="7">7</option>
                                                                <option value="8">8</option>
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                                <option value="12">12</option>
                                                            </select>
                                                            <b style="float:left;margin-top:5px;">月</b>

                                                            <b class="h_title fl" style="float:left;margin-top:5px;">状态:</b>
                                                            <select con="3" type="4" class="sub3-status input-sm form-control input-s-sm inline h_slect" style="float:left;">
                                                                <option value="5">未准时未打款</option>
                                                                <option value="6">未准时收款</option>
                                                                <option value="4">虚拟打款/举报</option>
                                                            </select>

                                                            <div class="input-group h_search" style="float:left;margin-left:20px;">
                                                                <input type="text" placeholder="订单号搜索" class="sub3-name input-sm form-control">
                                                                <span class="input-group-btn">
                                                                    <button id="sub3" type="button" class="btn btn-sm btn-primary">搜索</button>
                                                                </span>
                                                            </div>


                                                            <button type="button" id="excel3" class="btn btn-primary btn-sm" style="float:left;margin-bottom:0 !important;">导出表格</button>
                                                        </div>
                                                        <div  id="index3" class="table-responsive" style="width:100%;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- 弹窗 -->
                <div class="theme-popover-mask" ></div><!-- 遮罩 -->

                <!-- 成功匹配的列表弹框内容 -->
                <div class="pop them1" style="height:auto;padding-bottom:3rem;">
                    <div class="pop_title pr">成功匹配的列表<span class="close "></span></div>
                    <p class="h_choose">
                        <button type="button" name="1" class="selAll btn btn-outline btn-primary">全选</button>
                        <button type="button" name="2" class="selNo btn btn-outline btn-info">反选</button>
                    </p>
                    <div class="pop_all">
                        <div class="table-responsive" style="border:1px solid #ddd;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>提供订单</th>
                                        <th>接受订单</th>
                                        <th>提供用户</th>
                                        <th>注册IP</th>
                                        <th>接受用户</th>
                                        <th>注册IP</th>
                                        <th>金额</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                         <p class="h_btns">
                            <button type="button" class="btn btn-w-m btn-default cancle">取消</button>
                            <button type="button" id="sureAotu" class="btn btn-w-m btn-primary">确认匹配</button>
                        </p>
                    </div>
                </div>

                <!-- 成功匹配的列表弹框内容 -->

                 <!-- 可合成的订单列表 -->
                <div class="pop conb" style="height:auto;padding-bottom:3rem;">
                    <div class="pop_title pr">可合成列表<span class="close "></span></div>
                    <div class="pop_all">
                        <div class="table-responsive" style="border:1px solid #ddd;width:100%;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>订单号</th>
                                        <th>会员名</th>
                                        <th>姓名</th>
                                        <th>支付方式</th>
                                        <th>金额（元）</th>
                                        <th>帮助类型</th>
                                        <th>状态</th>
                                        <th>匹配人</th>
                                        <th>匹配时间</th>
                                        <th>是否匹配过</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                         <p class="h_btns">
                            <button type="button" class="btn btn-w-m btn-default cancle">取消</button>
                            <button type="button" id="hecheng" class="btn btn-w-m btn-primary">确认合成</button>
                        </p>
                    </div>
                </div>

                <!-- 可合成的订单列表 -->

                <!-- 拆分弹框内容 -->
                <div class="pop them2" style="top:50%;padding-bottom:3rem;">
                    <div class="pop_title pr">请输入拆分情况<span class="close "></span></div>
                   <style>
                        .h_shuru{width:80%;height:24px;border-radius: 4px;border:1px solid #ddd;float: left;}
                        .he_shu{width:auto;height:24px;}
                        .he_shu b{width:10%;line-height: 24px;float: left;}
                   </style>
                    <div class="pop_all">
                        <div id="chai">
                            <div class="he_shu">
                                <b>dzgf</b><input class="h_shuru">
                            </div><br />
                        </div>
                        <b>剩余可拆数: </b><span id="shengyu" class="text-danger"></span>
                        <p class="h_btns">
                            <button type="button" class="btn btn-w-m btn-default cancle">取消</button>
                            <button type="button" id="chaiSure" class="btn btn-w-m btn-primary">确定</button>
                        </p>
                    </div>
                </div>

                <!-- 拆分弹框内容 -->

                <!-- 成功匹配的列表弹框内容 -->
                <div class="pop them3" style="height:auto;padding-bottom:3rem;position:absolute;">
                    <div class="pop_title pr">匹配列表<span class="close "></span></div>
                    <div class="pop_all">
                        <div class="table-responsive" style="border:1px solid #ddd;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>订单号</th>
                                        <th>会员名</th>
                                        <th>姓名</th>
                                        <th>支付方式</th>
                                        <th>金额（元）</th>
                                        <th>帮助类型</th>
                                        <th>状态</th>
                                        <th>匹配人</th>
                                        <th>匹配时间</th>
                                        <th>是否匹配过</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                         <p class="h_btns" style="overflow:hidden;bottom:0;left:35%;">
                            <button type="button" class="btn btn-w-m btn-default cancle">取消</button>
                            <button type="button" id="pipei" class="btn btn-w-m btn-primary">确认匹配</button>
                        </p>
                    </div>

                </div>

                <!-- 成功匹配的列表弹框内容 -->
            <!-- 弹窗 -->
<?php
$js = <<<JS
    window.del = function( id ){
        layer.confirm('将会删除双方该订单信息，是否删除该条订单', {icon: 5, title:'提示'},function(){
            $.post('?r=orders/delorder',{id:id},function(res){
                if( res.status == 1 ){
                    $('.tr'+id).remove();
                }
                layer.alert(res.message);
            })
        })

    }

    window.getList = function( obj, data){
        $.get('?r=orders/list', data, function(ret){
            $(obj).html(ret);
        })
        return false;
    }
    // window.excel = function(obj1,obj2){
    //     $(obj1).click(function(){
    //         var tr  = $(obj2).find('tbody tr'),
    //             str = {};
    //         if(tr.length == 0){
    //             layer.msg('无数据需要导出!');
    //             return false;
    //         }
    //         tr.each(function(index,ele){
    //             var arr = [];
    //             $(ele).find('td').each(function(aa,td){
    //                 if(aa == 11) return;
    //                 arr[aa] = $(td).text();
    //             })
    //             str[index] = arr;
    //         })
    //         str = JSON.stringify(str);
    //         layer.prompt({value: '订单表',title:'请输入表格的名字'},function(value, index, elem){
    //             location.href="?r=orders/excel&data="+str+'&title='+value;
    //             layer.close(index);
    //         });
    //         //$.get('?r=orders/excel',{data:str},function(){}) //调试
    //     })
    // }

    window.excel = function(obj1,str){
        $(obj1).click(function(){
            layer.prompt({value: '订单表',title:'请输入表格的名字'},function(value, index, elem){
                var url = "?r=orders/list&type="+data.type+'&title='+value;
                if( data.status  ){
                    url += '&status=' + data.status
                }
                if( $('.sub'+str+'-name').val() != '' ){
                    url += '&id=' + data.id
                }
                if($('.sub'+str+'-time1').val() != 0){
                    url += '&time1=' + data.time1
                }
                if($('.sub'+str+'-time2').val() != 0){
                    url += '&time2=' + data.time2
                }
                location.href = url;
                layer.close(index);
             });
        })
    }

    var data  = {};
    $(function(){
        //初始化数据
        data.type = 1;
        getList($('#index1'),data);
        //初始化绑定事件
        excel($('#excel1'), '1');
        excel($('#excel2'), '2');
        excel($('#excel3'), '3');
    })

    $('.tab1').click(function(){
        data = {};
        getList($('#index1'));
    })

    $('.tab2').click(function(){
        data.type = 3;
        data.status = 1;
        getList($('#index2'),data);
    })

    $('.tab3').click(function(){
        data.type = 4;
        data.status = 5;
        getList($('#index3'),data);
    })

    $('.sub1-status,.sub2-status,.sub3-status').on('change',function(){
        data.status = $(this).val()
        if(data.type == 8){
            data.type = 1
        }
        if($(this).val() == 1){
            $('#auto').removeAttr('disabled');
        }else{
            $('#auto').attr('disabled','disabled');
        }
        getList($('#index'+$(this).attr('con')),data);
    })

    $('.sub1-type').on('change',function(){
        data.type = $(this).val()
        $('.sub1-status').html('<option value="1">匹配中</option><option value="3">等待受方确认</option>');
        getList($('#index1'),data);
    })

    //异常订单管理搜索
    $('#sub3').click(function(){
        data = {
            type   : 4,
            status : $('.sub3-status').val(),
        }
        if( $('.sub3-name').val() != '' ){
            data.id  =  $('.sub3-name').val();
        }
        if($('.sub3-time1').val() != 0){
            data.time1 = $('.sub3-time1').val();
        }
        if($('.sub3-time2').val() != 0){
            data.time2 = $('.sub3-time2').val();
        }
        getList($('#index3'),data);
    })

    //订单管理搜索
    $('#sub2').click(function(){
        data = {
            type   : 3,
            status : $('.sub2-status').val(),
        }
        if( $('.sub2-name').val() != '' ){
            data.id  =  $('.sub2-name').val();
        }
        if($('.sub2-time1').val() != 0){
            data.time1 = $('.sub2-time1').val();
        }
        if($('.sub2-time2').val() != 0){
            data.time2 = $('.sub2-time2').val();
        }

        getList($('#index2'),data);
    })

    //帮助表单搜索
    $('#sub1').click(function(){
        data = {
            type   : $('.sub1-type').val(),
            status : $('.sub1-status').val(),
        }
        if( $('.sub1-name').val() != '' ){
            data.id  =  $('.sub1-name').val();
        }
        if($('.sub1-time1').val() != 0){
            data.time1 = $('.sub1-time1').val();
        }
        if($('.sub1-time2').val() != 0){
            data.time2 = $('.sub1-time2').val();
        }
        getList($('#index1'),data);
    })
    //分页
    $('body').on('click','.pagination a', function(){
        data.page = $(this).data('page') + 1;
        getList($(this).parents('.table-responsive'), data)
        return false;
    })
JS;
$this->registerJs($js);
app\assets\AppAsset::addJs($this,'/js/orders/orders.js');
?>
