<?php

namespace core\lib;

class route {

    public $controller;
    public $action;

    public function __construct() {
        $configMap = config::getConfig();
        if ($configMap['route'] === '') {
            $this->controller = !empty($_GET['ctrl']) ? $_GET['ctrl'] : $configMap['controller'];
            $this->action = !empty($_GET['action']) ? $_GET['action'] : $configMap['action'];
        } else {
            if ($configMap['route'] == 'aaaaa') {
                $this->route1();
            }
            if ($configMap['route'] == 'bbbb') {
                $this->route2();
            }
        }
        $this->checkLogin();
    }

    public function route1() {
        
    }

    public function route2() {
        
    }

    /**
     * 检测登录状态
     */
    private function checkLogin() {
//        // 重复登录改变路由 
//        if ($this->checkSession('user') && 'user' == strtolower($this->controller) && 'login' == strtolower($this->action)) {
//            $this->controller = 'index';
//            $this->action = 'index';
//        }
//        // 没有登录也改变路由
//        if (!$this->checkSession('user')) {
//            $this->controller = 'user';
//            $this->action = 'login';
//        }
    }

    /**
     * 检测session
     * @param type $flag
     * @return boolean
     */
    private function checkSession($flag = '') {
        if ($flag) {
            if (isset($_SESSION[$flag]) && !empty($_SESSION[$flag])) {
                return true;
            }
            return false;
        }
        return !empty($_SESSION) ? true : false;
    }

}
