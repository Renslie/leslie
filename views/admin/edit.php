<?php 
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
 ?>
<?php $form = ActiveForm::begin();?>
<div class="form-group">
	<?= $form->field($model,'password')->passwordInput(); ?>
</div>
<div class="form-group">
	<?= $form->field($model,'newPassword')->passwordInput(); ?>
</div>
<div class="form-group">
	<?= $form->field($model,'verifyNewPassword')->passwordInput(); ?>
</div>
<?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
<?php $form = ActiveForm::end();?>