<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/bootstrap.min.css?v=3.4.0',
        'font-awesome/css/font-awesome.css?v=4.3.0',
        'css/plugins/morris/morris-0.4.3.min.css',
        'js/plugins/gritter/jquery.gritter.css',
        'css/animate.css',
        'css/style.css?v=2.2.0',
        'css/bootstrap-treeview.css',
    ];
    public $js = [
        'js/layer.js',
        'js/extend/layer.ext.js',
        'js/bootstrap.min.js?v=3.4.0',
        'js/plugins/metisMenu/jquery.metisMenu.js',
        'js/plugins/slimscroll/jquery.slimscroll.min.js',
        'js/hplus.js?v=2.2.0',
        'js/plugins/pace/pace.min.js',
        'js/plugins/jeditable/jquery.jeditable.js',
        'js/bootstrap-treeview.js',
	    'js/jquery-session.js',
        'app/common.js',

        'js/tan.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    /**
     * @desc   定义加载CSS 样式
     * @author RZLIAO
     * AppAsset::addCss($this,'/css/xxx.css')
     * @date   2016-1-14
     */
    public static function addCss($view, $cssFile) {
        $view->registerCssFile('@web'.$cssFile, [AppAsset::className(), 'depends' => 'app\assets\AppAsset']);
    }

    /**
     * @desc   定义加载 JS 样式
     * @author RZLIAO
     * AppAsset::addJs($this,'/js/xxx.js')
     * @date   2016-1-14
     */
    public static function addJs($view, $jsFile) {
        $view->registerJsFile('@web'.$jsFile, [AppAsset::className(), 'depends' => 'app\assets\AppAsset']);
    }
}
