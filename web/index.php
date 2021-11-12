<?php
defined('YII_DEBUG') || define('YII_DEBUG', true);
defined('YII_ENV') || define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

//$config = ;

try {
    (new yii\web\Application(require __DIR__ . '/../config/web.php'))->run();
} catch (yii\base\InvalidConfigException $e) {
    echo $e->getMessage();
}
