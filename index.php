<?php

/**
 * 框架入口文件
 * 1定义常量
 * 2加载函数库
 * 3启动框架
 */
#此框架如果提供接口最低PHP版本只能5.6，其他建议使用php7.0以上

@date_default_timezone_set('PRC');
@session_start();

define('ROOT', __DIR__);
define('APP', ROOT . '/app');
define('CORE', ROOT . '/core');
define('CONFIG', ROOT . '/config');
define("SOURCE", ROOT . '/source');
define("VIEW", APP . "/view");
define("MODEL", APP . "/model");
define('CTRL', APP . '/controller');
define('MODULE', 'app/controller');
define('COMMON', CORE . '/common');

include CONFIG . '/constant.php';

define('DEBUG', true);

//echo ROOT;
/**/
include ROOT . '/vendor/autoload.php';

if (DEBUG) {
    ini_set('display_errors', 'on');
    error_reporting(E_ALL ^ E_NOTICE);
    $whoops = new \Whoops\Run();
    $option = new \Whoops\Handler\PrettyPageHandler();
    $errortitle = "赶快去看看框架出错了.....";
    $option->setPageTitle($errortitle);
    $whoops->pushHandler($option);
    $whoops->register();
} else {
    ini_set('display_errors', 'off');
}
include CORE . '/common/function.php';
include CORE . '/core.php';

spl_autoload_register("core\core::load");
(new core\core())->run();
