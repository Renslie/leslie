<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\Models\News */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

     <?=
        $form->field($model, 'cover')->widget('app\common\widgets\file_upload\FileUpload',[
            'config'=>[
                "imageMaxSize" => 1048000,  //默认上传1M 图片
            ]
        ]);
     ?>

    <?= $form->field($model, 'content')->widget('app\common\widgets\ueditor\Ueditor',[
        'options'=>[
            // 'toolbars' => [
            //     [
            //         'simpleupload',
            //     ],
            // ],
            'initialFrameWidth' => 850,
        ],

    ]) ?>

    <?= $form->field($model, 'type')->dropDownList(['1'=>'新闻','2'=>'帮助']) ?>

   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '确认修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
