<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
 ?>
<div class="wrapper wrapper-content">
	<div class="row animated fadeInRight">
	<div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> &nbsp; 激活内容修改</h2>
     </div>
		<?php $form = ActiveForm::begin(['id'=>'editactive-form']); ?>
		<?= $form->field($model, 'content')->label(false)->widget('app\common\widgets\ueditor\Ueditor',[
	        'options'=>[
	            // 'toolbars' => [
	            //     [
	            //         'simpleupload',
	            //     ],
	            // ],
	            'initialFrameWidth' => 850,
	        ],

	    ]) ?>
	    <?= Html::submitButton('保存',['class'=>'btn btn-primary']) ?>
	    <button type="button" onclick="history.go(-1)" class="cancle btn btn-primary">返回</button>
	    <?php ActiveForm::end(); ?>
	</div>
</div>

<?php
$js = <<<JS
	$('#editactive-form').on('beforeSubmit',function(){
		ajaxSubmitForm($(this))
		return false;
	})
JS;
?>
