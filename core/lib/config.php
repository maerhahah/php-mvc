<?php

namespace core\lib;

class config {

    public static function getDb($dbtype = 'mysql', $db = 'pdo', $file = 'db.php') {
        $path = CONFIG . '/' . $file;
        if (is_file($path)) {
            $dataConf = include $path;
            if (isset($dataConf[$dbtype])) {
                if (isset($dataConf[$dbtype][$db])) {
                    return $dataConf[$dbtype][$db];
                } else {
                    throw new \Exception('找不到配置项：' . $db);
                }
            } else {
                throw new \Exception('找不到配置项：' . $dbtype);
            }
        } else {
            throw new \Exception('找不到配置文件：' . $file);
        }
    }

    public static function getConfig($name = '', $file = 'conf.php') {
        $path = CONFIG . '/' . $file;
        if (is_file($path)) {
            $dataConf = include $path;
            if ($name == '') {
                return $dataConf;
            } else {
                if (!isset($dataConf[$name]) && $name != '') {
                    return $dataConf[$name];
                } else {
                    throw new \Exception('找不到配置项：' . $dbtype);
                }
            }
        } else {
            throw new \Exception('找不到配置文件：' . $file);
        }
    }

}
