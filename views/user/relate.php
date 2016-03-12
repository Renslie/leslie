   <?php use yii\helpers\Url;?>

    <link href="css/plugins/treeview/bootstrap-treeview.css" rel="stylesheet">

    <div id="wrapper">



            <div class="wrapper wrapper-content animated fadeIn">

                <div class="row">
                    <div class="ibox float-e-margins">
                        <div class="box-header well" data-original-title="">
                        <h2><i class="glyphicon glyphicon-user"></i> &nbsp; 会员关系图</h2>
                        </div>
                        <div class="ibox-content" style="height:auto;overflow:hidden;">
                            <div class="col-sm-4">
                                <h2>关系图</h2>
                                <div id="tree_source" class="test"></div>
                            </div>
                            <div class="col-sm-4">
                                <h2>基本信息</h2>
                                <div id="user_info" class="ibox-content ">

                                </div>
                            </div>
                            <div class="col-sm-4">
                                <h2>修改</h2>
                                <div id="tree_edit" class="test"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>



    </div>

<?php
$js = <<<JS

    var tree_data = $tree_data;
    var parent_id = 0;
    var source_user_id = 0;
    //生成树
    $('#tree_source').treeview({
        data: tree_data,
        onNodeSelected: function (event, node) {
            $("#user_info").empty();
            $("#tree_edit").empty();
            $("#tree_edit").unbind();



            get_user_info(node.user_id);
            source_user_id = node.user_id;
        }
    });

    //获取用户信息
    function get_user_info(user_id){
        var url = "index.php?r=user/userinfo";

        var data = {user_id:user_id};

        $.get(url,data,function(msg){
            $("#user_info").html(msg);
        });
    }

    //生成右边树
    $("#user_info").on('click','.edit_view',function(){

        $("#tree_edit").empty();


        //生成树
        $('#tree_edit').treeview({
            data: tree_data,
            onNodeSelected: function (event, node) {
                edit_show(node.user_id);
                $("li[data-nodeid="+node.id+"]").remove();
            }
        });

        //禁用『修改上线按钮』
        $("#user_info .edit_view").attr("disabled","disabled");


    });

    //修改上线--视图展现
    function edit_show(pid){
        //显示确认修改按钮
        $("#user_info .edit_commit").show(true);
        //定位要修改到的父id
        parent_id  = pid;
    }

    //修改上线--提交服务器
    $("#user_info").on('click','.edit_commit',function(){
        var url = "index.php?r=user/relationedit";

        var data = {
                user_id     :   source_user_id,
                parent_id   :   parent_id
            };
        if(source_user_id == 0){
            alert("根关系不可以更改!");
            return ;
        }
        if(source_user_id == parent_id){
            alert("自己不能成为自己的上线!");
            return ;
        }
        $.get(url,data,function(msg){
            if(msg.status){
                alert("『更新关系成功』");
                location.reload();
            }else{
                alert(msg.error);
            }
        },'json');
    });
JS;

$this->registerJs($js);
 ?>
