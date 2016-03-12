<?php
date_default_timezone_set('PRC');
// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');  //上线改为生产环境 
require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
require(__DIR__.'/app/help.php');
$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();