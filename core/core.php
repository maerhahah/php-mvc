<?php

namespace core;

use core\lib\route;
use core\lib\Handers;

class core {

    public static $classMap = array();
    public $controller;
    public $action;
    public $assignMap = array();

    public function __construct() {
        $route = new route();
        $this->controller = $route->controller;
        $this->action = $route->action;
    }

    public function run() {
        $controller = $this->controller;
        $action = ucwords($this->action);
        $contrlfile = CTRL . '/' . $controller . '.php';
        $class = str_replace('/', '\\', MODULE) . '\\' . $controller . 'Controller';
        $action = 'action' . $this->action;
        if (is_file($contrlfile)) {
            $this->Filter();
            include $contrlfile;
            $ctrlobj = new $class();
            $ctrlobj->$action();
        } else {
            throw new \Exception('找不到控制器:' . $controller);
        }
    }

    public static function load($class) {
        $class = str_replace('\\', '/', $class);
        if (isset(self::$classMap[$class])) {
            return true;
        } else {
            $file = ROOT . '/' . $class . '.php';
            if (is_file($file)) {
                self::$classMap[$class] = $class;
                include $file;
            } else {
                return false;
            }
        }
    }

    public function display($file = '') {
        $file = !empty($file) ? $file : $this->action . '.html';
        $pathfile = VIEW . "/" . $this->controller . '/' . $file;
        if (is_file($pathfile)) {
            include ROOT . '/vendor/twig/lib/Twig/Autoloader.php';
            \Twig_Autoloader::register();
            $loader = new \Twig_Loader_Filesystem(VIEW . "/" . $this->controller);
            $twig = new \Twig_Environment($loader, array(
                'cache' => SOURCE . "/template_c/" . $this->controller
            ));
            $template = $twig->load($file);
            echo $template->render($this->assignMap);
        } else {
            throw new \Exception('找不到模板文件：' . $pathfile);
        }
    }

    public function assign($name, $value = '') {
        $this->assignMap[$name] = $value;
    }

    //SQL注入防御、XSS跨站攻击过滤
    public function Filter() {

        $_POST = Handers::httpFilter($_POST);
        $_GET = Handers::httpFilter($_GET);
        $_REQUEST = Handers::httpFilter($_REQUEST);
        $_COOKIE = Handers::httpFilter($_COOKIE);
    }

}
