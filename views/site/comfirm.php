<div id="forms" class="form-horizontal">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-send"></i> &nbsp; 短信验证</h2>
    </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">手机号码</label>
    <div class="col-sm-10">
      <p class="form-control-static"><?=Yii::$app->user->identity->phone ?></p>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword" class="col-sm-2 control-label">验证码</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="inputPassword" placeholder="请输入短信验证码">
      <br />
      <button type="submit" id="sub"  class='btn btn-sm  btn-primary' >确认</button>
      <button type="submit" id="news"  class='btn btn-sm  btn-success' >发送短信</button><b> &nbsp; <span id="tt"></span></b>
  </div>
  </div>
</div>
<?php
$js = <<<JS
    $('#inputPassword').val('');
    var time = 60;
    $('#news').on('click',function(){
        if(time < 60){
            layer.msg('请在'+(60-time)+'秒后再点击');
            return false;
        }
        $.post('?r=site/sendcode',function(data){
            layer.alert(data.message);
            if( data.status == 1){
                time = 0;
            }
        },'json')
    })
    setInterval(function(){
        if(time < 60) {
            time++
            $('#tt').text(60-time)
        }else if(time == 60){
            $('#tt').text('')
        }
    },1000)
    $('#sub').on('click',function(e){
        var code = $('#inputPassword').val();
        if( code == '' ) {
            layer.alert('验证码不能为空!');
            return false;
        }
        $.post('?r=site/validate-safe',{safeCode:code},function( data ){
            layer.alert(data.message);
            if( data.status == 1){
                location.href = data.url
            }
        },'json')
    })
JS;
$this->registerJs($js);
?>
