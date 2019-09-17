<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\lib;

use core\core;
use core\lib\view;

class controller extends core {

    protected $request = array();

    public function __construct() {
        parent::__construct();
        $this->ass('_GET', $_GET);
    }

    // 合并get,post,request请求数据
    public function requestData() {
        
    }

    // 转义过滤
    public function transFerred() {
        
    }

    /**
     * y用于原生或者自己开发模板引擎
     * @param type $name
     * @param type $value
     */
    public function ass($name, $value = '') {
        view::assign($name, $value);
    }

    /**
     * y用于原生或者自己开发模板引擎
     * @param type $name
     * @param type $value
     */
    public function view($file = '') {
        view::dispaly($file, $this);
    }

    /**
     * 引用Twig模板引擎
     * @param string $file
     */
    public function display($file = '') {
        parent::display($file = '');
    }

    /**
     * 引用Twig 模板引擎
     * @param type $name
     * @param type $value
     */
    public function assign($name, $value = '') {
        parent::assign($name, $value);
    }

}
