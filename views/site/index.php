<?php
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
AppAsset::register($this);
 ?>
 <?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <?= Html::csrfMetaTags() ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><meta name="renderer" content="webkit">
    <title>互利系统</title>
    <?php $this->head() ?>
</head>
<?php $this->beginBody() ?>
<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name">HY</h1>
            </div>
            <h3>欢迎使用 互利系统</h3>
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'form-horizontal'],
                'fieldConfig' => [
                    'options' => ['class' => null],
                ],
            ]);?>
                <?= $form->field($model, 'username',[
                    'template'=>"<div class=\"form-group\">{input}</div>{error}"
                ])->textInput(['placeholder'=>"用户名"])->label("用户名")?>
                <?= $form->field($model, 'password',[
                    'template'=>"<div class=\"form-group\">{input}</div>{error}"
                ])->passwordInput(['placeholder'=>"密码"])->label("密码")?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="input-group input-group-lg "></i></span>{input}<div class="input-group-addon" style="padding:0;">{image}</div></div>',
                    'options' => ['class' => 'form-control','placeholder'=>"验证码"]
                ])->label(false) ?>
                <?= Html::submitButton('登录', ['class' => 'btn btn-primary block full-width m-b', 'name' => 'login-button']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</body>
<?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>
