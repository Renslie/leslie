<?php
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Json;
?>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i>管理员管理</h2>
            </div>
            <div class="box-create"><a href="#" class="btn btn-primary langse" data-toggle="modal" data-target="#myDialog" data-data="add"><i class="glyphicon glyphicon-plus-sign"></i><span>添加管理员</span></a></div>
        </div>
    </div>
</div>
<table class="table  table-bordered" style="background:#fff;margin-top:20px;">
	<!-- <tr>
		<td colspan="3"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#myDialog" data-data='add'>新增用户</button></td>
	</tr> -->
	<tr>
		<td>用户名</td>
		<td>手机号码</td>
		<td>操作</td>
	</tr>
	<?php  foreach($provider->models as $user){ ?>
	<tr class="tr<?=$user->admin_id?>">
		<td class="center"><?=$user->username?></td>
		<td class="center"><?=$user->phone ?></td>
		<td class="center">
            <a class="btn btn-info" href="#" data-toggle="modal" data-target="#myDialog" data-data='<?= Json::encode($user)?>'>
                <i class="glyphicon glyphicon-edit icon-white"></i>
                编辑管理员
            </a>
            <a class="btn btn-danger" href="javascript:void(0);" onclick="del(<?=$user->admin_id?>)"  >
                <i class="glyphicon glyphicon-trash icon-white"></i>
                删除
            </a>
        </td>
	</tr>
<?php } ?>
</table>
<?=
LinkPager::widget([
	'pagination' => $provider->pagination,
	'options' => ['class' => 'pagination pull-left', 'style' => 'margin:0px']
	]);
	?>
	<div class="modal fade" id="myDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="msg">新增用户</h4>
					</div>
					<?php
					$form = ActiveForm::begin([
						'id' => 'edit-form',
						'action' => Url::toRoute('admin/edit')
						]);
						?>
						<div class="modal-body">
							<div class="form-group">
								<?= $form->field($model, 'admin_id')->hiddenInput()->label(false) ?>
								<?= $form->field($model,'username',['inputOptions'=>['readonly'=>'readonly']]) ?>
							</div>
							<div class="form-group">
								<?= $form->field($model,'password')->passwordInput() ?>
							</div>
							<div class="form-group">
								<?= $form->field($model,'phone') ?>
							</div>
							<div class="form-group" >
								<label for="message-text" class="control-label">角色选择:</label>
							</div>
							<div class="form-group">
								<?= $form->field($model, 'roles')->checkboxList($list)->label(false); ?>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
							<?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
						</div>
						<?php ActiveForm::end(); ?>
					</div>
				</div>
			</div>
		</div>
<?php
	$js =<<<JS
	$('#myDialog').on('show.bs.modal', function (event) {
		var botton = $(event.relatedTarget),
		    data   = botton.attr('data-data'),
			window = $(this);
		$('#edit-form')[0].reset();
		if(data == 'add'){
			$('#admin-admin_id').val('');
			$("#admin-username").removeAttr("readonly");
			$('.modal-title').text("添加用户");
		}else{
			data = JSON.parse(data);
			$('.modal-title').text("编辑用户");
			$('#admin-admin_id').val(data.admin_id);
			$('#admin-username').val(data.username);
			$('#admin-phone').val(data.phone);
			$('#admin-password').val(data.password);
			for(var role in data.roles){
                $("#edit-form input[value='"+role+"']").prop("checked",true);
            }
		}
		$("#edit-form").on('beforeSubmit',function(e){
            ajaxSubmitForm($(this),function(data){
                location.reload();
                //$('#myDialog').modal('hide');
            });
            return false;
        });
	});
	window.del = function ( id ){
		layer.confirm('你确定要删除此管理员？', function(){
			$.post('?r=admin/del',{id:id}, function(data){
				if(data.status == 1){alert(1)
					$('.tr'+id).remove();
				}
				layer.alert(data.message);
			})
		})
	}
JS;
$this->registerJs($js);
?>
