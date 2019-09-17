<?php

/**
 * 如果需要自己编写模板引擎，可在此处编写
 */

namespace core\lib;

class view {

    public static $assignMap = array();

    public static function assign($name, $value = '') {
        self::$assignMap[$name] = $value;
    }

    /**
     * 原生自己写，就一个extract和一个include而已
     * @param type $file
     * @param type $obj
     * @throws \Exception
     */
    public static function dispaly($file = '', $obj) {
        $file = !empty($file) ? $file : $obj->action . '.php';
        $pathfile = VIEW . "/" . $obj->controller . '/' . $file;
        $pathfile2 = VIEW . "/" . $file;
        if (is_file($pathfile)) {
            extract(self::$assignMap);
            include $pathfile;
        } else if (is_file($pathfile2)) {
            extract(self::$assignMap);
            include $pathfile2;
        } else {
            throw new \Exception('找不到模板文件：' . $pathfile);
        }
        exit();
    }

}
