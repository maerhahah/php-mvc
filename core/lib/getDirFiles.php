<?php

namespace core\lib;

use core\core;

class getDirFiles extends core {

    public static $dir = '';
    public static $filearr = array();
    public static $dirarr = array();
    public static $stampdir = '';
    public static $offset = 0;
    public static $page = 1;
    public static $num = 15;

    /* 	public function __construct($dir=''){
      if($dir){
      self::$dir = $dir;
      }
      }
     */

    public static function setOffset($page = 1) {
        self::$page = $page ? $page : 1;
        self::$offset = (self::$page - 1) * self::$num;
    }

    public static function setDir($dir = '') {
        if ($dir) {
            self::$dir = $dir;
        }
    }

    public static function listFiles($dir) {
        $handle = opendir($dir);
        if ($handle) {
            while (false !== ($file = readdir($handle))) {
                if ($file != '.' && $file != '..') {
                    if (is_dir($dir . '/' . $file)) {
                        self::listFiles($dir . '/' . $file);
                    } else {
                        self::$filearr[] = $dir . '/' . $file;
                    }
                }
            }
        }
        closedir($handle);
    }

    public static function getFiles() {
        self::listFiles(self::$dir);
        return self::$filearr;
    }

    public static function getDir() {
        
    }

    public static function getContents($file = '') {
        $contents = array();

        // 小文件获取 
        if ($file) {
            return is_file($file) ? file_get_contents($file) : false;
        } else {
            $i = 1;
            $j = 0;
            foreach (self::$filearr as $k => $v) {
                if ($j == self::$num) {
                    break;
                }
                /**/
                $file = fopen($v, "r");
                while (!feof($file)) {
                    $text = fgets($file);
                    if ($text == '')
                        continue;
                    if ($i > self::$offset) {
                        //echo $j.'-->'.trim(trim($text),',').'<br/>';
                        $contents[] = trim(trim($text), ',');
                        /**/ $j++;
                    }
                    if ($j == self::$num) {
                        break;
                    }

                    $i++;
                    /**/
                }
                fclose($file);
            }
        }
        return $contents;
    }

    // 统计行数
    public static function count_line($file) {
        $fp = fopen($file, "r");
        $i = 0;
        while (!feof($fp)) {
            //每次读取2M
            if ($data = fread($fp, 1024 * 1024 * 2)) {
                //计算读取到的行数
                $num = substr_count($data, "\n");
                $i += $num;
            }
        }
        fclose($fp);
        //return $i;
        echo $i;
    }

}

/*
getDirFiles::setDir('/var/www/html/data');
getDirfiles::setOffset(intval($_GET['page']));
getDirFiles::getFiles();
print_r(getDirFiles::getContents());

/*
$arr[2303].'<br/>';

echo file_get_contents($arr[2303]);a
