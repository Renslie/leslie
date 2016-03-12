<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
 ?>
<div class="wrapper wrapper-content">
	<div class="row animated fadeInRight">
	 <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> &nbsp; 新人使用信息</h2>
     </div>
		   <?= $this->render('_form', [
        		'model' => $model,
    		]) ?>
	</div>
</div>

<?php
$js = <<<JS
	$('#w0').on('beforeSubmit',function(){
		ajaxSubmitForm($(this))
		return false;
	})
JS;
$this->registerJs($js);
?>
