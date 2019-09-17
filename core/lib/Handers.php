<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\lib;

class Handers {

    /**
     * 获取数组或者对象中指定字段的值
     * @param object|array  $data
     * @param string        $column
     * @param boolean       $isArray    true:array,false:object
     * @param string        $retType    array|object
     * @return array|object
     */
    public static function getColumnFromData($data, $column, $isArray = true, $retType = 'object') {
        if (is_object($data)) {
            $data = (array) $data;
        }

        if (is_array($data)) {
            $newData = [];
            foreach ($data as $key => $value) {
                if ($value[$column]) {
                    $newData[] = $value[$column];
                }
            }
            return $retType == 'object' ? (object) $newData : $newData;
        }
        return [];
    }

    /**
     * 设置数据【array|object】的key
     * @param type $data
     * @param type $key
     * @param boolean $rtnType true是数组false是对象
     * @return type
     */
    public static function getDataByKey($data, $setKey = 'id', $rtnType = true) {
        if (!empty($data)) {
            if (is_object($data)) {
                $data = (array) $data;
            }

            if (is_array($data)) {
                $newData = [];
                foreach ($data as $key => $value) {
                    if (!$value[$setKey]) {
                        $newData['no' . $setKey] = $value;
                    } else {
                        $newData[$value[$setKey]] = $value;
                    }
                }
                return $rtnType ? $newData : (object) $newData;
            }
            return $data;
        }
        return [];
    }

    /**
     * 生成一个相对唯一的数字id【可根据需要添加参数完善】
     * @return string
     */
    public static function getuuid() {
        $dateStr = date('YmdHis');
        $microTime = (double) microtime() * 1000000;
        $mtRand = mt_rand(1, 9999999);
        return $dateStr . $microTime . $mtRand;
    }

    /**
     * 根据生日算年龄
     * @param type $birthday
     * @return int
     */
    public static function calcAge($birthday) {
        $age = 0;
        if (!empty($birthday)) {
            $age = strtotime($birthday);
            if ($age === false) {
                return 0;
            }

            list($y1, $m1, $d1) = explode("-", date("Y-m-d", $age));

            list($y2, $m2, $d2) = explode("-", date("Y-m-d"), time());

            $age = $y2 - $y1;
            if ((int) ($m2 . $d2) < (int) ($m1 . $d1)) {
                $age -= 1;
            }
        }
        return $age;
    }

    /**
     * 验证密码
     *
     * @param string $value
     * @param int $length
     * @return boolean
     */
    public static function Is_password($value, $minLen = 5, $maxLen = 16) {
        $match = '/^[\\~!@#$%^&*()-_=+|{}\[\],.?\/:;\'\"\d\w]{' . $minLen . ',' . $maxLen . '}$/';
        $v = trim($value);
        if (empty($v)) {
            return false;
        } else {
            return preg_match($match, $v);
        }
    }

    /**
     * 验证手机
     *
     * @param string $value
     * @param string $match
     * @return boolean
     */
    public static function Is_mobile($value, $match = '/^[(86)|0]?(13\d{9})|(15\d{9})|(18\d{9})$/') {
        $v = trim($value);
        if (empty($v))
            return false;
        return preg_match($match, $v);
    }

    /**
     * 验证座机
     *
     * @param string $value
     * @param string $match
     * @return boolean
     */
    public static function Is_telephone($value, $match = '/^(0[0-9]{2,3}-)?([2-9][0-9]{6,7})+(-[0-9]{1,4})?$/') {
        $v = trim($value);
        if (empty($v))
            return false;
        return preg_match($match, $v);
    }

    /**
     * 时间格式判断处理方法
     */
    public static function Is_time($timeStr) {
        if (empty($timeStr))
            return false;
        $match = '/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/s';
        return preg_match($match, $timeStr);
    }

    /**
     * 查找img标签处理方法
     * @param unknown $img
     * @return boolean|number
     */
    public static function exist_img($img) {

        if (empty($img))
            return false;
        $match = '/<img(.*)src=(.*)[^>]+>/is';
        return preg_match($match, $img);
    }

    /**
     * 判断数字处理方法
     */
    public static function Is_number($number, $start = 1, $limit = NULL) {
        if (empty($number))
            return false;
        $match = '/^\d{' . $start . ',' . $limit . '}$/is';
        return preg_match($match, $number);
    }

    /**
     * 判断是否为正确邮箱地址
     * 
     * @param string $email
     */
    public static function Is_email($email) {
        return preg_match("/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/", $email);
    }

    /**
     * 判断url处理方法
     */
    public static function Is_Url($url) {
        if (empty($url))
            return false;
        $match = '/www.[a-zA-z0-9]+.[a-zA-z0-9]+/is';
        return preg_match($match, $url);
    }

    /**
     * 生成公共的TOKEN方法
     * @param unknown $data 要加密的数据
     * @return string 返回加密结果
     */
    public static function create_token($data) {

//生成全局加密KEY
        $token_key_1 = mt_rand(10000000, 99999999); //前8位KEY
        $token_key_2 = mt_rand(10000000, 99999999); //后8位KEY
        if (empty($_SESSION['TOKEN_KEY_1'])) {
            $_SESSION['TOKEN_KEY_1'] = $token_key_1;
        }
        if (empty($_SESSION['TOKEN_KEY_2'])) {
            $_SESSION['TOKEN_KEY_2'] = $token_key_2;
        }
        return md5($_SESSION['TOKEN_KEY_1'] . $data . $_SESSION['TOKEN_KEY_2']);
    }

    /**
     * 下载文件处理方法
     * @param unknown $path
     * @param unknown $fileName
     * @param unknown $downName
     * @return boolean
     */
    public static function download($path, $fileName, $downName = '') {

        $path = trim($path);
        $fileName = trim($fileName);

//文件名转码
        $fileName = iconv('utf-8', 'gb2312', $fileName);

//设置路径
        if (substr($path, strlen($path) - 1, strlen($path)) != '/') {

            $file = $_SERVER['DOCUMENT_ROOT'] . $path . '/' . $fileName;
        } else {

            $file = $_SERVER['DOCUMENT_ROOT'] . $path . $fileName;
        }
//die($file);
        file_exists($file) || die('下载文件不存在');

        $file_size = filesize($file);

//读取文件
        $fp = fopen($file, "r");
        $buffer_size = 1024;
        $cur_pos = 0;

        $downName = empty($downName) ? $fileName : $downName;

        header("Content-type: application/octet-stream");
        header("Accept-Ranges: bytes");
        header("Accept-Length: $file_size");
        header("Content-Disposition: attachment; filename=" . $downName);

//刷出缓冲区
        ob_clean();
        flush();

//输出文件
        while (!feof($fp) && $file_size - $cur_pos > $buffer_size) {
            $buffer = fread($fp, $buffer_size);

            echo $buffer;

            $cur_pos += $buffer_size;
        }

        $buffer = fread($fp, $file_size - $cur_pos);

        echo $buffer;

        fclose($fp);

        return true;
    }

    /**
     * 下载文件处理方法
     * @param unknown $path
     * @param unknown $fileName
     * @param unknown $downName
     * @return boolean
     */
    public static function systemDownload($file, $fileName) {

        $file = trim(trim($file), '/');
        $fileName = trim($fileName);
//文件名转码
        $fileName = iconv('utf-8', 'gb2312', $fileName);

//        die($file);
        file_exists($file) || die('下载文件不存在');
        $file_size = filesize($file);

//读取文件
        $fp = fopen($file, "r");
        $buffer_size = 1024;
        $cur_pos = 0;

        header("Content-type: application/octet-stream");
        header("Accept-Ranges: bytes");
        header("Accept-Length: $file_size");
        header("Content-Disposition: attachment; filename=" . $fileName);

//刷出缓冲区
        ob_clean();
        flush();

//输出文件
        while (!feof($fp) && $file_size - $cur_pos > $buffer_size) {
            $buffer = fread($fp, $buffer_size);
            echo $buffer;
            $cur_pos += $buffer_size;
        }

        $buffer = fread($fp, $file_size - $cur_pos);
        echo $buffer;
        fclose($fp);
        return true;
    }

    /**
     * 图片上传处理方法
     * @param unknown $path 上传路径
     * @param unknown $fileName 上传表单名
     * @param string $typeArr 允许上传类型
     * @param array $upConfig 上传图片配置
     * @return string|unknown
     */
    public static function uploadFile($path, $fileName, $typeArr = '', $upConfig = '') {
//上传文件类型列表
        empty($typeArr) && $typeArr = array(
            'image/jpg',
            'image/jpeg',
            'image/png',
            'image/pjpeg',
            'image/gif',
            'image/bmp',
            'image/x-png'
        );
        $path = substr($path, 0, 1) == '/' ? $_SERVER["DOCUMENT_ROOT"] . $path : $_SERVER["DOCUMENT_ROOT"] . '/' . $path; //重组上传路径
//        	die($path);
        empty($upConfig['max_file_size']) && $upConfig['max_file_size'] = 2000000; //上传文件大小限制, 单位BYTE
//$destination_folder = $path; //上传文件路径
        empty($upConfig['watermark']) && $upConfig['watermark'] = 0; //是否附加水印(1为加水印,其他为不加水印);
        empty($upConfig['watertype']) && $upConfig['watertype'] = 1; //水印类型(1为文字,2为图片)
        empty($upConfig['waterposition']) && $upConfig['waterposition'] = 1; //水印位置(1为左下角,2为右下角,3为左上角,4为右上角,5为居中);
//$waterstring="http://www.xplore.cn/";  //水印字符串
//$waterimg="xplore.gif";    //水印图片
//$imgpreview=1;      //是否生成预览图(1为生成,其他为不生成);
        $imgpreviewsize = 1 / 2;    //缩略图比例

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!is_uploaded_file($_FILES[$fileName]['tmp_name'])) {
//是否存在文件
                $msg_data['status'] = 0;
                $msg_data['info'] = '上传文件不存在';
                return $msg_data;
            }

            $file = $_FILES[$fileName];
            if ($upConfig['max_file_size'] < $file["size"]) {
//检查文件大小
                $msg_data['status'] = 0;
                $msg_data['info'] = '上传文件过大';
                return $msg_data;
            }

            if (!in_array($file["type"], $typeArr)) {
//检查文件类型
                $msg_data['status'] = 0;
                $msg_data['info'] = '上传文件类型不符';
                return $msg_data;
            }

            if (!file_exists($path)) {//创建文件路径
                mkdir($path, 0777);
            }

            $filename = $file["tmp_name"];
            $image_size = getimagesize($filename);
            $pinfo = pathinfo($file["name"]);
            $ftype = $pinfo['extension']; //获取后缀
            $destination = $path . time() . '_' . mt_rand(1000000, 9999999) . "." . $ftype;
            if (file_exists($destination)) {
                $msg_data['status'] = 0;
                $msg_data['info'] = '已存在同名文件';
                return $msg_data;
            }
//	die($filename);
            if (!move_uploaded_file($filename, $destination)) {
                $msg_data['status'] = 0;
                $msg_data['info'] = '移动文件失败';
                return $msg_data;
            }

            $pinfo = pathinfo($destination);
            $fname = $pinfo['basename'];
            $msg_data['status'] = 1;
            $msg_data['path'] = str_replace($_SERVER['DOCUMENT_ROOT'], '', $destination);
            $msg_data['size'] = $file['size'];
            $msg_data['width'] = $image_size[0];
            $msg_data['height'] = $image_size[1];

            if ($upConfig['watermark'] == 1) {
                $iinfo = getimagesize($destination, $iinfo);
                $nimage = imagecreatetruecolor($image_size[0], $image_size[1]);
                $white = imagecolorallocate($nimage, 255, 255, 255);
                $black = imagecolorallocate($nimage, 0, 0, 0);
                $red = imagecolorallocate($nimage, 255, 0, 0);
                imagefill($nimage, 0, 0, $white);
                switch ($iinfo[2]) {
                    case 1:
                        $simage = imagecreatefromgif($destination);
                        break;
                    case 2:
                        $simage = imagecreatefromjpeg($destination);
                        break;
                    case 3:
                        $simage = imagecreatefrompng($destination);
                        break;
                    case 6:
                        $simage = imagecreatefromwbmp($destination);
                        break;
                    default:
                        die("不支持的文件类型");
                        exit;
                }

                imagecopy($nimage, $simage, 0, 0, 0, 0, $image_size[0], $image_size[1]);
                imagefilledrectangle($nimage, 1, $image_size[1] - 15, 80, $image_size[1], $white);

                switch ($upConfig['watertype']) {
                    case 1:   //加水印字符串
                        imagestring($nimage, 2, 3, $image_size[1] - 15, $upConfig['waterString'], $black);
                        break;
                    case 2:   //加水印图片
                        $simage1 = imagecreatefrompng($upConfig['waterImage']);
                        imagecopy($nimage, $simage1, 0, 0, 0, 0, 85, 15);
                        imagedestroy($simage1);
                        break;
                }

                switch ($iinfo[2]) {
                    case 1:
//imagegif($nimage, $destination);
                        imagejpeg($nimage, $destination);
                        break;
                    case 2:
                        imagejpeg($nimage, $destination);
                        break;
                    case 3:
                        imagepng($nimage, $destination);
                        break;
                    case 6:
                        imagewbmp($nimage, $destination);
//imagejpeg($nimage, $destination);
                        break;
                }

//覆盖原上传文件
                imagedestroy($nimage);
                imagedestroy($simage);
            }
            return $msg_data;
        }
    }

    /**
     * 数据分页处理方法
     */
    public static function Page($total, $listData = 8) {
        $totalRows = $total; //获取总数据条数
        $listRows = 5;
        $totalPage = ceil($totalRows / $listData); //获取总分页数
        $totalColl = ceil($totalPage / $listRows); //获取分页栏总页数
        $currentPage = !empty($_GET['start']) ? intval($_GET['start']) : 1; //获取当前页
        $nowCoolPage = ceil($currentPage / $listRows); //获取当前分页栏数
        $parameter = !empty($_GET) ? $_GET : array(); //获取参数
        $parameter['start'] = '__PAGE__';
        $url = $_SERVER['REDIRECT_URL'] . "?" . http_build_query($parameter); //获取当前url
//上下翻页字符串
        $upRow = $currentPage - 1;
        $downRow = $currentPage + 1;
//$pageShow = $totalRows."条记录/共".$totalPage."页 ";
        if ($nowCoolPage == 1) {
            $pageShow .= '';
        } else {
            $preRow = $currentPage - $listData;
            $pageShow .= "<a href='" . str_replace('__PAGE__', 1, $url) . "' >首页</a>";
            /*     $pageShow .= "<a href='".str_replace('__PAGE__',$preRow,$url)."' >上一列</a>"; */
        }

        $pageShow .= $upRow > 0 ? "<a href='" . str_replace('__PAGE__', $upRow, $url) . "'>上一页</a>" : "";

// 1 2 3 4 5  
//add by baoxianjian 22:46 2015/4/2 分页点到5时，就从5到9
        $i_start = 1;
        $i_end = $listRows;
        if (ceil(($currentPage + 1) / $listRows) > $nowCoolPage) {
            $nowCoolPage++;
            $i_start = 0;
            $i_end = $listRows - 1;
        }

        for ($i = $i_start; $i <= $i_end; $i++) {
            $page = ($nowCoolPage - 1) * $listRows + $i;
            if ($currentPage != $page) {
                if ($page <= $totalPage) {
                    $pageShow .= "<a href='" . str_replace('__PAGE__', $page, $url) . "'>" . $page . "</a>";
                } else {
//    die($page);
                    break;
                }
            } else {
                $pageShow .= "<span>" . $page . "</span>";
            }
        }

        $pageShow .= $downRow <= $totalPage ? "<a href='" . str_replace('__PAGE__', $downRow, $url) . "'>下一页</a>" : "";

        if ($nowCoolPage < $totalColl && $nowCoolPage >= 1) {
            /* $pageShow .= "<a href='".str_replace('__PAGE__',$currentPage+$listRows,$url)."'>下一列</a>"; */
            $pageShow .= "<a href='" . str_replace('__PAGE__', $totalPage, $url) . "'>尾页</a>";
        }

        return $pageShow;
    }

    /**
     * 错误转跳模板
     * @param unknown $msg
     * @param string $TplUrl
     * @param string $wait
     */
    public static function error($msg, $jumpUrl = '', $title = '错误提示', $wait = '', $TplUrl = '', $close = '') {
        $jumpUrl !== '' && $config['jumpUrl'] = $jumpUrl;
        $TplUrl !== '' && $config['TplUrl'] = $TplUrl;
        $wait !== '' && $config['waitSecond'] = intval($wait);
        $title !== '' && $config['title'] = $title;
        $close !== '' && $config['closeWin'] = true;
        $self = new self();
        $self->dispatchJump($msg, 0, $config);
        die;
    }

    /**
     * 成功转跳模板
     * @param unknown $msg
     * @param string $title
     * @param string $wait
     * @param string $TplUrl
     * @param string $close
     */
    public static function success($msg, $jumpUrl = '', $title = '成功提示', $wait = '', $TplUrl = '', $close = '') {
        $TplUrl !== '' && $config['TplUrl'] = $TplUrl;
        $jumpUrl !== '' && $config['jumpUrl'] = $jumpUrl;
        $wait !== '' && $config['waitSecond'] = intval($wait);
        $title !== '' && $config['title'] = $title;
        $close !== '' && $config['closeWin'] = true;
        $self = new self();
        $self->dispatchJump($msg, 1, $config);
    }

    /**
     * 转跳提示模板
     * @param unknown $msg
     * @param unknown $status
     * @param unknown $config
     */
    private function dispatchJump($msg, $status, $config) {
        $sTpl = new STpl();
        isset($config['title']) || $config['title'] = '提示信息';
        isset($config['TplUrl']) || $config['TplUrl'] = "common/dispatchJump/dispatch_jump.html"; //检查模板是否存在
        isset($config['closeWin']) && $config['jumpUrl'] = 'javascript:window.opener=null;window.close();'; //是否关闭窗口
        $config['status'] = $status; //设置状态
        if ($status) {//成功
            $config['msg'] = $msg; //成功信息	
            isset($config['waitSecond']) || $config['waitSecond'] = '1'; //成功操作后默认停留1秒
            // 默认操作成功自动返回操作前页面
            isset($config['jumpUrl']) || $config['jumpUrl'] = $_SERVER["HTTP_REFERER"];
        } else {//错误
            $config['msg'] = $msg; //错误信息
            isset($config['waitSecond']) || $config['waitSecond'] = '5'; //失败操作后默认停留5秒
            // 默认操作成功自动返回操作前页面
            isset($config['jumpUrl']) || $config['jumpUrl'] = "javascript:history.back(-1);";
        }
        echo $sTpl->render($config['TplUrl'], $config);
        die;
    }

    /**
     * 判断异步请求处理方法
     */
    public static function isAjax() {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            if ('xmlhttprequest' == strtolower($_SERVER['HTTP_X_REQUESTED_WITH']))
                return true;
        }
        //如果参数传递的参数中有ajax
//        if (!empty($_POST['ajax']) || !empty($_GET['ajax']))
//            return true;
        return false;
    }

    /**
     * 判断post提交
     * @return boolean
     */
    public static function isPost() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return false;
        }
        return true;
    }

    /**
     * 判断get提交
     */
    public static function isGet() {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            return false;
        }
        return true;
    }

    /**
     * 格式化打印数组处理方法
     * @param unknown $arr
     */
    public static function P($arr) {
        echo "<pre>";
        print_r($arr);
    }

    /**
     * 读取配置数组文件处理方法
     * @param unknown $name
     */
    public static function C($name) {
        require $_SERVER["DOCUMENT_ROOT"] . '/config_array.php';
        return $config_array_php_file[$name];
    }

    /**
     * 过滤解释数组方法
     */
    public static function html_arr($arr) {
        foreach ($arr as $k => $v) {
            if (!is_array($v)) {
                $arr[$k] = htmlspecialchars($v, ENT_QUOTES);
                $arr[$k] = trim($arr[$k]);
            } else {
                $arr[$k] = self::html_arr($v);
            }
        }
        return $arr;
    }

    /**
     * encode http请求过滤，防注入、XSS等安全处理
     * @param $string 可以为字符或者数组
     * @return $string 可以为字符或者数组
     */
    public static function httpFilter($string) {
        $string = str_replace(array('sleep('), array('_sleep(_'), $string);
        if (is_array($string)) {
            foreach ($string as $key => $val) {
                $string[$key] = self::httpFilter($val);
            }
        } else {
            $string = trim($string);
            $string = htmlspecialchars($string);
            $string = self::straddslashes($string);
        }
        return $string;
    }

    private static function straddslashes($string) {
        if (!get_magic_quotes_gpc()) {
            return addslashes($string);
        } else {
            return $string;
        }
    }

    /**
     * decode http请求过滤，防注入、XSS等安全处理 返解码，最好不要使用
     * 使用编辑器那么后面会自己写ubb规则来处理
     */
    public static function deHttpFilter($string) {
        if (is_array($string)) {
            foreach ($string as $key => $val) {
                $string[$key] = self::deHttpFilter($val);
            }
        } else {
            $string = htmlspecialchars_decode($string);
            $string = stripslashes($string);
        }
        return $string;
    }

    /**
     * ubbl转html xheditor UBB使用
     * @param unknown_type $sUBB
     * @return string|mixed
     */
    public static function ubb2html($sUBB) {
        $sHtml = $sUBB;

        global $emotPath, $cnum, $arrcode, $bUbb2htmlFunctionInit;
        $cnum = 0;
        $arrcode = array();
//表情目录 @todo 最后需要修改目录
        $emotPath = IMAGE_URL . '/i/plugin/xheditor/xheditor_emot/'; //表情根路径

        if (!$bUbb2htmlFunctionInit) {

            function saveCodeArea($match) {
                global $cnum, $arrcode;
                $cnum++;
                $arrcode[$cnum] = $match[0];
                return "[\tubbcodeplace_" . $cnum . "\t]";
            }

        }
        $sHtml = preg_replace_callback('/\[code\s*(?:=\s*((?:(?!")[\s\S])+?)(?:"[\s\S]*?)?)?\]([\s\S]*?)\[\/code\]/i', 'saveCodeArea', $sHtml);

        $sHtml = preg_replace("/&/", '&amp;', $sHtml);
        $sHtml = preg_replace("/</", '&lt;', $sHtml);
        $sHtml = preg_replace("/>/", '&gt;', $sHtml);
        $sHtml = preg_replace("/\r?\n/", '<br />', $sHtml);

        $sHtml = preg_replace("/\[(\/?)(b|u|i|s|sup|sub)\]/i", '<$1$2>', $sHtml);
        $sHtml = preg_replace('/\[color\s*=\s*([^\]"]+?)(?:"[^\]]*?)?\s*\]/i', '<span style="color:$1;">', $sHtml);
        if (!$bUbb2htmlFunctionInit) {

            function getSizeName($match) {
                $arrSize = array('10px', '13px', '16px', '18px', '24px', '32px', '48px');
                if (preg_match("/^\d+$/", $match[1]))
                    $match[1] = $arrSize[$match[1] - 1];
                return '<span style="font-size:' . $match[1] . ';">';
            }

        }
        $sHtml = preg_replace_callback('/\[size\s*=\s*([^\]"]+?)(?:"[^\]]*?)?\s*\]/i', 'getSizeName', $sHtml);
        $sHtml = preg_replace('/\[font\s*=\s*([^\]"]+?)(?:"[^\]]*?)?\s*\]/i', '<span style="font-family:$1;">', $sHtml);
        $sHtml = preg_replace('/\[back\s*=\s*([^\]"]+?)(?:"[^\]]*?)?\s*\]/i', '<span style="background-color:$1;">', $sHtml);
        $sHtml = preg_replace("/\[\/(color|size|font|back)\]/i", '</span>', $sHtml);

        for ($i = 0; $i < 3; $i++)
            $sHtml = preg_replace('/\[align\s*=\s*([^\]"]+?)(?:"[^\]]*?)?\s*\](((?!\[align(?:\s+[^\]]+)?\])[\s\S])*?)\[\/align\]/', '<p align="$1">$2</p>', $sHtml);
        $sHtml = preg_replace('/\[img\]\s*(((?!")[\s\S])+?)(?:"[\s\S]*?)?\s*\[\/img\]/i', '<img src="$1" alt="" />', $sHtml);
        if (!$bUbb2htmlFunctionInit) {

            function getImg($match) {
                $alt = $match[1];
                $p1 = $match[2];
                $p2 = $match[3];
                $p3 = $match[4];
                $src = $match[5];
                $a = $p3 ? $p3 : (!is_numeric($p1) ? $p1 : '');
                return '<img src="' . $src . '" alt="' . $alt . '"' . (is_numeric($p1) ? ' width="' . $p1 . '"' : '') . (is_numeric($p2) ? ' height="' . $p2 . '"' : '') . ($a ? ' align="' . $a . '"' : '') . ' />';
            }

        }
        $sHtml = preg_replace_callback('/\[img\s*=([^,\]]*)(?:\s*,\s*(\d*%?)\s*,\s*(\d*%?)\s*)?(?:,?\s*(\w+))?\s*\]\s*(((?!")[\s\S])+?)(?:"[\s\S]*)?\s*\[\/img\]/i', 'getImg', $sHtml);
        if (!$bUbb2htmlFunctionInit) {

            function getEmot($match) {
                global $emotPath;
                $arr = explode(',', $match[1]);
                if (!isset($arr[1])) {
                    $arr[1] = $arr[0];
                    $arr[0] = 'default';
                }
                $path = $emotPath . $arr[0] . '/' . $arr[1] . '.gif';
                return '<img src="' . $path . '" alt="' . $arr[1] . '" />';
            }

        }
        $sHtml = preg_replace_callback('/\[emot\s*=\s*([^\]"]+?)(?:"[^\]]*?)?\s*\/\]/i', 'getEmot', $sHtml);
        $sHtml = preg_replace('/\[url\]\s*(((?!")[\s\S])*?)(?:"[\s\S]*?)?\s*\[\/url\]/i', '<a href="$1" target="_blank">$1</a>', $sHtml);
        $sHtml = preg_replace('/\[url\s*=\s*([^\]"]+?)(?:"[^\]]*?)?\s*\]\s*([\s\S]*?)\s*\[\/url\]/i', '<a href="$1" target="_blank">$2</a>', $sHtml);
        $sHtml = preg_replace('/\[email\]\s*(((?!")[\s\S])+?)(?:"[\s\S]*?)?\s*\[\/email\]/i', '<a href="mailto:$1">$1</a>', $sHtml);
        $sHtml = preg_replace('/\[email\s*=\s*([^\]"]+?)(?:"[^\]]*?)?\s*\]\s*([\s\S]+?)\s*\[\/email\]/i', '<a href="mailto:$1">$2</a>', $sHtml);
        $sHtml = preg_replace("/\[quote\]/i", '<blockquote>', $sHtml);
        $sHtml = preg_replace("/\[\/quote\]/i", '</blockquote>', $sHtml);
        if (!$bUbb2htmlFunctionInit) {

            function getFlash($match) {
                $w = $match[1];
                $h = $match[2];
                $url = $match[3];
                if (!$w)
                    $w = 480;
                if (!$h)
                    $h = 400;
                return '<embed type="application/x-shockwave-flash" src="' . $url . '" wmode="opaque" quality="high" bgcolor="#ffffff" menu="false" play="true" loop="true" width="' . $w . '" height="' . $h . '" />';
            }

        }
        $sHtml = preg_replace_callback('/\[flash\s*(?:=\s*(\d+)\s*,\s*(\d+)\s*)?\]\s*(((?!")[\s\S])+?)(?:"[\s\S]*?)?\s*\[\/flash\]/i', 'getFlash', $sHtml);
        if (!$bUbb2htmlFunctionInit) {

            function getMedia($match) {
                $w = $match[1];
                $h = $match[2];
                $play = $match[3];
                $url = $match[4];
                if (!$w)
                    $w = 480;
                if (!$h)
                    $h = 400;
                return '<embed type="application/x-mplayer2" src="' . $url . '" enablecontextmenu="false" autostart="' . ($play == '1' ? 'true' : 'false') . '" width="' . $w . '" height="' . $h . '" />';
            }

        }
        $sHtml = preg_replace_callback('/\[media\s*(?:=\s*(\d+)\s*,\s*(\d+)\s*(?:,\s*(\d+)\s*)?)?\]\s*(((?!")[\s\S])+?)(?:"[\s\S]*?)?\s*\[\/media\]/i', 'getMedia', $sHtml);
        if (!$bUbb2htmlFunctionInit) {

            function getTable($match) {
                return '<table' . (isset($match[1]) ? ' width="' . $match[1] . '"' : '') . (isset($match[2]) ? ' bgcolor="' . $match[2] . '"' : '') . '>';
            }

        }
        $sHtml = preg_replace_callback('/\[table\s*(?:=(\d{1,4}%?)\s*(?:,\s*([^\]"]+)(?:"[^\]]*?)?)?)?\s*\]/i', 'getTable', $sHtml);
        if (!$bUbb2htmlFunctionInit) {

            function getTR($match) {
                return '<tr' . (isset($match[1]) ? ' bgcolor="' . $match[1] . '"' : '') . '>';
            }

        }
        $sHtml = preg_replace_callback('/\[tr\s*(?:=(\s*[^\]"]+))?(?:"[^\]]*?)?\s*\]/i', 'getTR', $sHtml);
        if (!$bUbb2htmlFunctionInit) {

            function getTD($match) {
                $col = isset($match[1]) ? $match[1] : 0;
                $row = isset($match[2]) ? $match[2] : 0;
                $w = isset($match[3]) ? $match[3] : null;
                return '<td' . ($col > 1 ? ' colspan="' . $col . '"' : '') . ($row > 1 ? ' rowspan="' . $row . '"' : '') . ($w ? ' width="' . $w . '"' : '') . '>';
            }

        }
        $sHtml = preg_replace_callback("/\[td\s*(?:=\s*(\d{1,2})\s*,\s*(\d{1,2})\s*(?:,\s*(\d{1,4}%?))?)?\s*\]/i", 'getTD', $sHtml);
        $sHtml = preg_replace("/\[\/(table|tr|td)\]/i", '</$1>', $sHtml);
        $sHtml = preg_replace("/\[\*\]((?:(?!\[\*\]|\[\/list\]|\[list\s*(?:=[^\]]+)?\])[\s\S])+)/i", '<li>$1</li>', $sHtml);
        if (!$bUbb2htmlFunctionInit) {

            function getUL($match) {
                $str = '<ul';
                if (isset($match[1]))
                    $str .= ' type="' . $match[1] . '"';
                return $str . '>';
            }

        }
        $sHtml = preg_replace_callback('/\[list\s*(?:=\s*([^\]"]+))?(?:"[^\]]*?)?\s*\]/i', 'getUL', $sHtml);
        $sHtml = preg_replace("/\[\/list\]/i", '</ul>', $sHtml);
        $sHtml = preg_replace("/\[hr\/\]/i", '<hr />', $sHtml);

        for ($i = 1; $i <= $cnum; $i++)
            $sHtml = str_replace("[\tubbcodeplace_" . $i . "\t]", $arrcode[$i], $sHtml);

        if (!$bUbb2htmlFunctionInit) {

            function fixText($match) {
                $text = $match[2];
                $text = preg_replace("/\t/", '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $text);
                $text = preg_replace("/ /", '&nbsp;', $text);
                return $match[1] . $text;
            }

        }
        $sHtml = preg_replace_callback('/(^|<\/?\w+(?:\s+[^>]*?)?>)([^<$]+)/i', 'fixText', $sHtml);

        $bUbb2htmlFunctionInit = true;

        return $sHtml;
    }

//生成二维码
    public static function getQrImg($chl, $widhtHeight = '120', $EC_level = 'L', $margin = '1') {
        $chl = urlencode($chl);
        $qr = 'http://chart.apis.google.com/chart?chs=' . $widhtHeight . 'x' . $widhtHeight . '&cht=qr&chld=' . $EC_level . '|' . $margin . '&chl=' . $chl;
        return $qr;
    }

    /**
     * 全站统一 字符长度计算方法  中文占2个 英文数字占1个
     * 数据库中char(10)的话是可以存的汉字与英文个数是一样的，都存10个，暂时网站暂使用这种方法测量字符串长度
     */
    public static function cp_strlen($str) {
        return (strlen($str) + mb_strlen($str, 'UTF8')) / 2;
    }

    /**
     * get substr support chinese
     * 此函数是中文占用3个字符长度
     * return $str
     */
    public static function getSubStr($str, $start, $length, $postfix = '...', $encoding = 'UTF-8') {
        $tlength = mb_strlen($str);
        $str = mb_strcut($str, $start, $length, $encoding);
        if ($tlength > $length) {
            $str = $str . $postfix;
        }
        return $str;
    }

    /**
     * get substr support chinese
     * 此函数是中文占用2个字符长度
     * return $str
     */
    public static function getSubStr2($addr, $length, $suffix = '...') {
        $len = strlen($addr);
        if ($len > $length) {
            for ($idx = 0; $idx < $length;
            ) {
                if (ord($addr[$idx]) > 0x7f) {
                    $length++;
                    $idx += 3;
                } else {
                    $idx++;
                }
            }
            return substr($addr, 0, $idx) . $suffix;
        } else {
            return $addr;
        }
    }

    /**
     * 获取当前在线IP地址
     * @param $format
     * @return $format = 0 返回IP地址：127.0.0.1
     * 		    $format = 1 返回IP长整形：2130706433
     */
    public static function getIp($format = 0) {
        global $_SGLOBAL;
        if (empty($_SGLOBAL['onlineip'])) {
            if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
                $onlineip = getenv('HTTP_CLIENT_IP');
            } elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
                $onlineip = getenv('HTTP_X_FORWARDED_FOR');
            } elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
                $onlineip = getenv('REMOTE_ADDR');
            } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
                $onlineip = $_SERVER['REMOTE_ADDR'];
            }
            preg_match("/[\d\.]{7,15}/", $onlineip, $onlineipmatches);
            $_SGLOBAL['onlineip'] = $onlineipmatches[0] ? $onlineipmatches[0] : 'unknown';
        }
        if (!$format) {
            $ip = $_SGLOBAL['onlineip'];
        } else {
            $ip = sprintf('%u', ip2long($_SGLOBAL['onlineip']));
        }
        return $ip;
    }

    /**
     * 格式化大小函数
     * @param $size 为文件大小
     * @return 文件大小加单位
     */
    public static function formatsize($size) {
        $prec = 3;
        $size = round(abs($size));
        $units = array(0 => " B ", 1 => " KB", 2 => " MB", 3 => " GB", 4 => " TB");
        if ($size == 0)
            return str_repeat(" ", $prec) . "0$units[0]";
        $unit = min(4, floor(log($size) / log(2) / 10));
        $size = $size * pow(2, -10 * $unit);
        $digi = $prec - 1 - floor(log($size) / log(10));
        $size = round($size * pow(10, $digi)) * pow(10, -$digi);
        return $size . $units[$unit];
    }

    /**
     * 验证目录名是否有效 (只允许输入数字和字母)
     * @param $dirname 目录名
     * @return true or false
     */
    public static function isdir($dirname) {
        $patn = '/^[a-zA-Z]+[a-zA-Z0-9]+$/';
        return preg_match($patn, $dirname);
    }

    /**
     * 创建目录
     * @param $path 目录路径 如：e:/work/yii/test
     * @return true or false
     */
    public static function makePath($path) {
        return is_dir($path) or ( self::makePath(dirname($path)) and mkdir($path, 0755));
    }

    /**
     * 删除目录
     * @param $path 目录路径 如：e:/work/yii/test
     * @return true or false
     */
    public static function rmDir($path) {
        return @rmdir($path);
    }

    /**
     * 获取文件内容
     * @param $filename 目录路径 如：e:/work/yii/test.html
     * @return 字符串->文件内容
     */
    public static function sreadfile($filename) {
        $content = '';
        if (function_exists('file_get_contents')) {
            @$content = file_get_contents($filename);
        } else {
            if (@$fp = fopen($filename, 'r')) {
                @$content = fread($fp, filesize($filename));
                @fclose($fp);
            }
        }
        return $content;
    }

    /**
     * 写入文件内容
     * @param $filename 目录路径 如：e:/work/yii/test.html
     * @param $writetext 写入文件内容
     * @param $openmod 打开文件类型 默认为'w'表示写入
     * @return true or false
     */
    public static function swritefile($filename, $writetext, $openmod = 'w') {
        if (@$fp = fopen($filename, $openmod)) {
            flock($fp, 2);
            fwrite($fp, $writetext);
            fclose($fp);
            return true;
        } else {
//runlog('error', "File: $filename write error.");
            return false;
        }
    }

    /**
     * 产生随机数
     * @param $length 产生随机数长度
     * @param $type 返回字符串类型
     * @param $hash  是否由前缀，默认为空. 如:$hash = 'zz-'  结果zz-823klis
     * @return 随机字符串 $type = 0：数字+字母
      $type = 1：数字
      $type = 2：字符
     */
    public static function random($length, $type = 0, $hash = '') {

        if ($type == 0) {
            $chars = '23456789abcdefghijkmnpqrstuvwxyz';
        } else if ($type == 1) {
            $chars = '0123456789';
        } else if ($type == 2) {
            $chars = 'abcdefghijklmnopqrstuvwxyz';
        }
//因为要用下标，32位肯定是0到31
        $max = strlen($chars) - 1;

//microtime是返回当前时间截和微秒数，mt_srand是随机数
        mt_srand((double) microtime() * 1000000);
//循环连接生成随机码
        for ($i = 0; $i < $length; $i ++) {
            $hash .= $chars [mt_rand(0, $max)];
        }
        return $hash;
    }

    /*
     * 取数组中的一列 返回 数组 或 逗号分隔的字符串
     */

    public static function getColumn($a = array(), $column = 'id', $isInt = 0, $retStr = true) {
        $ret = array();
        @list($column, $anc) = preg_split('/[\s\-]/', $column, 2, PREG_SPLIT_NO_EMPTY);
        if ($a && is_array($a)) {
            foreach ($a AS $one) {
                if (@$one[$column]) {
                    $ret[] = ($isInt ? (int) @$one[$column] : @$one[$column]) . ($anc ? '-' . @$one[$anc] : '');
                }
            }
        }
        if ($retStr) {
            $ret = trim(@implode(',', $ret), ',');
        }
        return $ret;
    }

    /**
     * object转为array
     */
    public static function objToArray($stdclassobject) {
        $_array = is_object($stdclassobject) ? get_object_vars($stdclassobject) : $stdclassobject;
        if (empty($_array))
            return array();
        foreach ($_array as $key => $value) {
            $value = (is_array($value) || is_object($value)) ? self::objToArray($value) : $value;
            $array[$key] = $value;
        }
        return $array;
    }

    /**
     * 获取时间差
     * @param $begin_time 开始时间
     * @param $end_time 结束时间
     * @return 数组
     */
    public static function timediff($begin_time, $end_time) {
        if ($begin_time > $end_time) {
            return false; //time is wrong
        } else {
            $timediff = $end_time - $begin_time;
            $days = intval($timediff / 86400);
            $remain = $timediff % 86400;
            $hours = intval($remain / 3600);
            $remain = $remain % 3600;
            $mins = intval($remain / 60);
            $secs = $remain % 60;
            $res = array("day" => $days, "hour" => $hours, "mins" => $mins, "sec" => $secs);
            return $res;
        }
    }

    /**
     * 格式化数字，以标准MONEY格式输出
     * @param $num 整型数字
     * @return 888,888,88
     */
    public static function formatnumber($num) {
        return number_format($num, 2, ".", ",");
    }

    /**
     * 检测时间的正确性
     * @param $date 时间格式如:2010-04-05
     * @return true or false
     */
    public static function chkdate($date) {
        if ((strpos($date, '-'))) {
            $d = explode("-", $date);
            if (checkdate($d[1], $d[2], $d[0])) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * cookie设置
     * @param $var 设置的cookie名
     * @param $value 设置的cookie值
     * @param $life 设置的过期时间：为整型，单位秒 如60表示60秒后过期
     * @param $path 设置的cookie作用路径
     * @param $domain 设置的cookie作用域名
     */
    public static function ssetcookie($array, $life = 0, $path = '/', $domain = COOKIE_DOMAIN) {
//global $_SERVER;
        $_cookName_ary = array_keys($array);
        for ($i = 0; $i < count($array); $i++) {
            setcookie($_cookName_ary[$i], $array[$_cookName_ary[$i]], $life ? (time() + $life) : 0, $path, $domain, $_SERVER['SERVER_PORT'] == 443 ? 1 : 0);
        }
    }

    /**
     * 密码是否够强
     * @param string $pass
     * @return bool 是or否
     */
    public static function isStrongPass($pass) {
        $RegExp = '/^[a-zA-z0-9\_\W]{6,16}$/'; //由大小写字母跟数字下划线组成并且长度在6-16字符直接
        return preg_match($RegExp, $pass) ? true : false;
    }

    /**
     * 返回建议用户名
     * @param string username
     * @return array 建议的用户名
     */
    public static function getRandomUsername($username, $count = 5) {
        if (mb_strlen($username, 'utf-8') > 10) {
            $username = self::utf8Substr($username, 0, rand(8, 10), '');
        }
        $wordsFile = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'filedata' . DIRECTORY_SEPARATOR . 'namedict.txt';
        $contentArr = file($wordsFile);
//总行数
        $totleLines = count($contentArr);
        for ($i = 0; $i < $count; $i++) {
//随机行数
            srand((double) microtime() * 1000000);
            $current = mt_rand(0, $totleLines - 1);
            $returnName[] = $username . '_' . str_replace("\r\n", '', $contentArr[$current]);
        }
        return $returnName;
    }

//过滤XSS攻击
    static function reMoveXss($val) {
// remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed
// this prevents some character re-spacing such as <java\0script>
// note that you have to handle splits with \n, \r, and \t later since they *are* allowed in some inputs
        $val = preg_replace('/([\x00-\x08|\x0b-\x0c|\x0e-\x19])/', '', $val);

// straight replacements, the user should never need these since they're normal characters
// this prevents like <IMG SRC=@avascript:alert('XSS')>
        $search = 'abcdefghijklmnopqrstuvwxyz';
        $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $search .= '1234567890!@#$%^&*()';
        $search .= '~`";:?+/={}[]-_|\'\\';
        for ($i = 0; $i < strlen($search); $i++) {
// ;? matches the ;, which is optional
// 0{0,7} matches any padded zeros, which are optional and go up to 8 chars
// @ @ search for the hex values
            $val = preg_replace('/(&#[xX]0{0,8}' . dechex(ord($search[$i])) . ';?)/i', $search[$i], $val); // with a ;
// @ @ 0{0,7} matches '0' zero to seven times
            $val = preg_replace('/(&#0{0,8}' . ord($search[$i]) . ';?)/', $search[$i], $val); // with a ;
        }

// now the only remaining whitespace attacks are \t, \n, and \r
        $ra1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', '<script', 'object', 'iframe', 'frame', 'frameset', 'ilayer'/* , 'layer' */, 'bgsound', 'base');
        $ra2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
        $ra = array_merge($ra1, $ra2);

        $found = true; // keep replacing as long as the previous round replaced something
        while ($found == true) {
            $val_before = $val;
            for ($i = 0; $i < sizeof($ra); $i++) {
                $pattern = '/';
                for ($j = 0; $j < strlen($ra[$i]); $j++) {
                    if ($j > 0) {
                        $pattern .= '(';
                        $pattern .= '(&#[xX]0{0,8}([9ab]);)';
                        $pattern .= '|';
                        $pattern .= '|(&#0{0,8}([9|10|13]);)';
                        $pattern .= ')*';
                    }
                    $pattern .= $ra[$i][$j];
                }
                $pattern .= '/i';
                $replacement = substr($ra[$i], 0, 2) . '<x>' . substr($ra[$i], 2); // add in <> to nerf the tag
                $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags
                if ($val_before == $val) {
// no replacements were made, so exit the loop
                    $found = false;
                }
            }
        }
        return $val;
    }

//根据IP判断城市
    public static function ip2city($ip = "") {
        !$ip && $ip = SUtil::getIp();
        $ipdatafile = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'filedata' . DIRECTORY_SEPARATOR . 'qqwry.dat';
        if (!$fd = @fopen($ipdatafile, 'rb')) {
            return false;
        }

        $ip = explode('.', $ip);
        $ipNum = $ip[0] * 16777216 + $ip[1] * 65536 + $ip[2] * 256 + $ip[3];

        if (!($DataBegin = fread($fd, 4)) || !($DataEnd = fread($fd, 4)))
            return false;
        @$ipbegin = implode('', unpack('L', $DataBegin));
        if ($ipbegin < 0)
            $ipbegin += pow(2, 32);
        @$ipend = implode('', unpack('L', $DataEnd));
        if ($ipend < 0)
            $ipend += pow(2, 32);
        $ipAllNum = ($ipend - $ipbegin) / 7 + 1;

        $BeginNum = $ip2num = $ip1num = 0;
        $ipAddr1 = $ipAddr2 = '';
        $EndNum = $ipAllNum;

        while ($ip1num > $ipNum || $ip2num < $ipNum) {
            $Middle = intval(($EndNum + $BeginNum) / 2);

            fseek($fd, $ipbegin + 7 * $Middle);
            $ipData1 = fread($fd, 4);
            if (strlen($ipData1) < 4) {
                fclose($fd);
                return false;
            }
            $ip1num = implode('', unpack('L', $ipData1));
            if ($ip1num < 0)
                $ip1num += pow(2, 32);

            if ($ip1num > $ipNum) {
                $EndNum = $Middle;
                continue;
            }

            $DataSeek = fread($fd, 3);
            if (strlen($DataSeek) < 3) {
                fclose($fd);
                return false;
            }
            $DataSeek = implode('', unpack('L', $DataSeek . chr(0)));
            fseek($fd, $DataSeek);
            $ipData2 = fread($fd, 4);
            if (strlen($ipData2) < 4) {
                fclose($fd);
                return false;
            }
            $ip2num = implode('', unpack('L', $ipData2));
            if ($ip2num < 0)
                $ip2num += pow(2, 32);

            if ($ip2num < $ipNum) {
                if ($Middle == $BeginNum) {
                    fclose($fd);
                    return false;
                }
                $BeginNum = $Middle;
            }
        }
        $ipFlag = fread($fd, 1);
        if ($ipFlag == chr(1)) {
            $ipSeek = fread($fd, 3);
            if (strlen($ipSeek) < 3) {
                fclose($fd);
                return false;
            }
            $ipSeek = implode('', unpack('L', $ipSeek . chr(0)));
            fseek($fd, $ipSeek);
            $ipFlag = fread($fd, 1);
        }
        if ($ipFlag == chr(2)) {
            $AddrSeek = fread($fd, 3);
            if (strlen($AddrSeek) < 3) {
                fclose($fd);
                return false;
            }
            $ipFlag = fread($fd, 1);
            if ($ipFlag == chr(2)) {
                $AddrSeek2 = fread($fd, 3);
                if (strlen($AddrSeek2) < 3) {
                    fclose($fd);
                    return false;
                }
                $AddrSeek2 = implode('', unpack('L', $AddrSeek2 . chr(0)));
                fseek($fd, $AddrSeek2);
            } else {
                fseek($fd, -1, SEEK_CUR);
            }

            while (($char = fread($fd, 1)) != chr(0))
                $ipAddr2 .= $char;

            $AddrSeek = implode('', unpack('L', $AddrSeek . chr(0)));
            fseek($fd, $AddrSeek);

            while (($char = fread($fd, 1)) != chr(0)) {
                $ipAddr1 .= $char;
            }
        } else {
            fseek($fd, -1, SEEK_CUR);
            while (($char = fread($fd, 1)) != chr(0)) {
                $ipAddr1 .= $char;
            }
            $ipFlag = fread($fd, 1);
            if ($ipFlag == chr(2)) {
                $AddrSeek2 = fread($fd, 3);
                if (strlen($AddrSeek2) < 3) {
                    fclose($fd);
                    return false;
                }
                $AddrSeek2 = implode('', unpack('L', $AddrSeek2 . chr(0)));
                fseek($fd, $AddrSeek2);
            } else {
                fseek($fd, -1, SEEK_CUR);
            }
            while (($char = fread($fd, 1)) != chr(0))
                $ipAddr2 .= $char;
        }
        fclose($fd);

        if (preg_match('/http/i', $ipAddr2)) {
            $ipAddr2 = '';
        }
        if (preg_match('/http/i', $ipAddr1)) {
            $ipaddr = false;
        }
        $ipAddr1 = iconv('gbk', 'utf-8', $ipAddr1);
        $ipAddr2 = iconv('gbk', 'utf-8', $ipAddr2);
//对此地址进行处理
        $return = array();
        preg_match_all('/(.*?省)?(.*?市)?(.*?区)?/', trim($ipAddr1), $arr);
        preg_match_all('/\((.*?)\).*/', trim($ipAddr2), $arr1);
        $type = preg_replace('/\(.*?\)/', '', trim($ipAddr2));
        $return = array('province' => preg_replace('/省|市/', '', $arr[1][0]),
            'city' => preg_replace('/省|市/', '', $arr[2][0]),
            'district' => preg_replace('/省|市/', '', $arr[3][0]),
            'isp' => $type);
        if ($arr1[1][0] && !$return['district']) {
            $return['district'] = $arr1[1][0];
        }
        if (!$return['province']) {
            $return['province'] = $return['city'];
        }

        $return['province'] = $return['province'] ? $return['province'] : '重庆';
        $return['city'] = $return['city'] ? $return['city'] : '重庆';
        return $return;
    }

    /**
     * 上传头像存放的路径
     */
    public static function getAvatarFilepath($uid, $size = '80x80', $retArr = 0) {
        $pn = 'avatar';
        $uid = abs(intval($uid));
        $uid = sprintf("%09d", $uid);
        $dir1 = substr($uid, 0, 3);
        $dir2 = substr($uid, 3, 2);
        $dir3 = substr($uid, 5, 2);
        if ($retArr) {
            return array($pn . '/' . $dir1 . '/' . $dir2 . '/' . $dir3 . '/', substr($uid, -2) . '.jpg');
        } else {
            return $pn . '/' . $dir1 . '/' . $dir2 . '/' . $dir3 . '/' . $size . substr($uid, -2) . '.jpg';
        }
    }

//curl GET URL内容
    public static function curlGet($url) {
        $ch = curl_init();
// 2. 设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, 0);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
// 3. 执行并获取HTML文档内容
        $output = curl_exec($ch);
        if ($output === false)
            $curlErr = curl_error($ch);
// 4. 释放curl句柄
        curl_close($ch);
        if ($curlErr)
            die($curlErr);
        return $output;
    }

    /**
     * curl模拟POST
     * @param unknown $url URL
     * @param unknown $var 数组
     * @param number $timeout
     * @return string
     */
    public static function curlPost($url, $var, $timeout = 120) {
        $curl = curl_init();
        $referer = '';
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);

        curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
        curl_setopt($curl, CURLOPT_NOSIGNAL, 1);
//curl_setopt($curl, CURLOPT_HTTPHEADER, $theHeaders);
        if (!empty($referer)) {
            curl_setopt($curl, CURLOPT_REFERER, $referer);
        }
//curl_setopt($curl, CURLOPT_COOKIEJAR, 'cookies.txt');
//curl_setopt($curl, CURLOPT_COOKIEFILE, 'cookies.txt');
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $var);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $data['str'] = curl_exec($curl);
        $data['status'] = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $data['errno'] = curl_error($curl);

        curl_close($curl);

        return $data;
    }

//转换时间差，倒计时用
    public static function convertTime($time) {
        $nowtime = time();
        $diffSec = abs($nowtime - $time);
        if ($diffSec > 0 and $diffSec < 60) {
            $data = $diffSec . "秒钟";
        } elseif ($diffSec >= 60 and $diffSec < 3600) {
            $minutes = (int) ($diffSec / 60);
            $data = $minutes . "分钟";
        } elseif ($diffSec >= 3600 and $diffSec < 86400) {
            $hour = (int) ($diffSec / 3600);
            $minutes = intval(($diffSec % 3600) / 60);
            $data = $hour . "小时" . $minutes . '分钟';
        }
        return $data;
    }

//把一个数组转换为MD5的字符串
    public static function getMd5($array) {
        $str = '';
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $str .= self::getMd5($value);
            } else {
                $str .= $value . '|';
            }
        }
        return md5(trim($str, '|'));
    }

//获取指定大小的图片
    public static function picsize($picuri, $size = '') {
//@todo 默认图片 后期需要修改
        if (!$picuri) {
            return IMAGE_URL . '/r/p/zwtp.gif';
        }
        $picuri = trim($picuri, '/');
        $picurl = $picuri;
        if (preg_match('/^http:\/\/.*?/s', $picurl)) {
            return $picurl;
        }
        if ($size) {
            $urlarr = explode('/', $picuri);
            $filename = $size . array_pop($urlarr);
            array_push($urlarr, $filename);
            $imgpath = implode('/', $urlarr);
            $picurl = $imgpath;
        } else {
            $imgpath = $picuri;
        }
        $cacheName = 'picscache_' . md5($picuri . $size);
        $cacheSys = new SCache('memcache');
        $picurlcache = $cacheSys->get($cacheName);
        if ($picurlcache) {
            return PICTURE_URL . '/' . $picurlcache;
        }
//如果此图片不存在
        $checkurl = 'http://' . IMAGE_SERVER_IP . '/upfiles/checkexist.php?path=' . urlencode($imgpath);
        if (!self::curlGet($checkurl)) {
            $r = self::curlGet('http://' . IMAGE_SERVER_IP . '/upfiles/thumbpic.php?pic=' . urlencode($imgpath));
        }
        $cacheSys->set($cacheName, $picurl);
        $picurl = PICTURE_URL . '/' . $picurl;
        return $picurl;
    }

    /**
     * 计算密码强度
     */
    public static function getPassLevel($password) {
        $partArr = array('/[0-9]/', '/[a-z]/', '/[A-Z]/', '/[\W_]/');
        $score = 0;

//根据长度加分
        $score += strlen($password);
//根据类型加分
        foreach ($partArr as $part) {
            if (preg_match($part, $password))
                $score += 5; //某类型存在加分
            $regexCount = preg_match_all($part, $password, $out); //某类型存在，并且存在个数大于2加2份，个数大于5加7份
            if ($regexCount >= 5) {
                $score += 7;
            } elseif ($regexCount >= 2) {
                $score += 2;
            }
        }
//重复检测
        $repeatChar = '';
        $repeatCount = 0;
        for ($i = 0; $i < strlen($password); $i++) {
            if ($password{$i} == $repeatChar)
                $repeatCount++;
            else
                $repeatChar = $password{$i};
        }
        $score -= $repeatCount * 2;
//等级输出
        $level = 0;
        if ($score <= 10) { //弱
            $level = 1;
        } elseif ($score <= 25) { //一般
            $level = 2;
        } elseif ($score <= 37) { //很好
            $level = 3;
        } elseif ($score <= 50) { //极佳
            $level = 4;
        } else {
            $level = 4;
        }
//如果是密码为123456
        if (in_array($password, array('123456', 'abcdef'))) {
            $level = 1;
        }
        return $level;
    }

    /**
     * 得到新订单号
     * @return  string
     */
    public static function getOrderSn() {
        /* 选择一个随机的方案 */
        mt_srand((double) microtime() * 1000000);
        return date('ymdHis') . str_pad(mt_rand(1, 9000) + mt_rand(0, 999), 4, '0', STR_PAD_LEFT);
    }

    /**
     * 返回当前页面的URL
     */
    public static function curPageUrl() {
        $pageURL = 'http';
        if ($_SERVER["HTTPS"] == "on") {
            $pageURL .= "s";
        }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["HTTP_HOST"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        }

        return $pageURL;
    }

    /**
     * 得到账号安全等级
     * @param type $score
     */
    public static function getSafeLevel($score) {
        $return = array();
        if ($score < 24) {
            $return['color'] = 'red';
            $return['text'] = '很弱';
        } elseif ($score >= 24 && $score < 44) {
            $return['color'] = 'red';
            $return['text'] = '弱';
        } elseif ($score >= 44 && $score < 70) {
            $return['color'] = 'orange';
            $return['text'] = '中';
        } elseif ($score >= 70 && $score < 80) {
            $return['color'] = 'orange';
            $return['text'] = '好';
        } elseif ($score >= 80 && $score < 90) {
            $return['color'] = 'green';
            $return['text'] = '很好';
        } else {
            $return['color'] = 'green';
            $return['text'] = '极佳';
        }
        return $return;
    }

    /**
     *
     * 检查资金KEY是否正确
     * @param float $user_id
     * @param string $money_key
     * @return boolean
     */
    public static function validateMoneyKey($user_money, $frozen_capital, $sales_money, $money_key, $user_id) {
// 初始化model
        if (self::output_money_key($user_money, $frozen_capital, $sales_money) != $money_key) {
            return false;
        }
        return true;
    }

    /**
     * 生成money key
     *
     * @param float $user_money
     * @param float $frozen_capital
     * @param float $sales_money
     * @return string
     */
    public static function outputMoneyKey($user_money, $frozen_capital, $sales_money) {
        $user_money = sprintf("%01.4f", $user_money);
        $frozen_capital = sprintf("%01.4f", $frozen_capital);
        $sales_money = sprintf("%01.4f", $sales_money);

        return md5($user_money . '|' . $frozen_capital . '|' . $sales_money . '|' . MONEYKEY);
    }

//得到当前域名前缀
    public static function getDomainPre() {
        $host = $_SERVER['HTTP_HOST'];
        $domain = '.' . DOMAIN;
        $pre = trim(str_replace($domain, '', $host));
        return $pre;
    }

    /**
     * 加密解密函数
     * @param unknown_type $string 加密解密字符串
     * @param unknown_type $operation ENCODE DECODE
     * @param unknown_type $key 别外key
     * @param unknown_type $expiry 过期时间
     * @return string
     */
    function authCode($string, $operation = 'DECODE', $key = '', $expiry = 0) {

        $ckey_length = 4; // 随机密钥长度 取值 0-32;
// 加入随机密钥，可以令密文无任何规律，即便是原文和密钥完全相同，加密结果也会每次不同，增大破解难度。
// 取值越大，密文变动规律越大，密文变化 = 16 的 $ckey_length 次方
// 当此值为 0 时，则不产生随机密钥

        $key = md5($key ? $key : SYSUSERKEY);
        $keya = md5(substr($key, 0, 16));
        $keyb = md5(substr($key, 16, 16));
        $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';

        $cryptkey = $keya . md5($keya . $keyc);
        $key_length = strlen($cryptkey);

        $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
        $string_length = strlen($string);

        $result = '';
        $box = range(0, 255);

        $rndkey = array();
        for ($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($cryptkey[$i % $key_length]);
        }

        for ($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }

        for ($a = $j = $i = 0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }

        if ($operation == 'DECODE') {
            if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
                return substr($result, 26);
            } else {
                return '';
            }
        } else {
            return $keyc . str_replace('=', '', base64_encode($result));
        }
    }

    /**
     * 科学计算法多值的计算
     * 加bcadd($a, $b, 2)（留2位小数）
     * 减bcsub($a, $b, 2)
     * 乘bcmul($a, $b, 2)
     * 除bcdiv($a, $b, 2)
     * 取余bcmod($a, $b)
     * @param array $num_arr 数字数组
     * @param string $method +-*\/%
     * @param number $scale 保留几位小数
     */
    public static function calculate($num_arr, $method = '+', $scale = 2) {
        if (!is_array($num_arr) || empty($num_arr)) {
            return 0;
        }
        $func = '';
        switch ($method) {
            case '+':
                $func = 'bcadd';
                break;
            case '-':
                $func = 'bcsub';
                break;
            case '*':
                $func = 'bcmul';
                break;
            case '/':
                $func = 'bcdiv';
                break;
            case '%':
                $func = 'bcmod';
                $scale = -1;
                break;
            default:
                return false;
        }
        $i = 0;
        $reNum = 0;
        foreach ($num_arr as $v) {
            if ($i == 0) {
                $reNum = $v;
            } else {
                if ($scale == -1) {//取余
                    $reNum = $func($reNum, $v);
                } else {
                    $reNum = $func($reNum, $v, $scale);
                }
            }
            $i++;
        }
        return $reNum;
    }

    /**
     * 将输入的以某个字符分隔的多个字符串头尾加上单引号
     * @author dengjingma
     * @param string $input
     * @param string $delimit 分隔符，默认为','
     * @return string
     */
    public static function numsToString($input, $delimit = ',') {
        $tmp = is_array($input) ? $input : explode($delimit, $input);
        $res = array();
        foreach ($tmp as $value) {
            $res[] = "'" . $value . "'";
        }
        return implode($delimit, $res);
    }

    /**
     *  数字金额转换成中文大写金额的函数
     *  String Int  $num  要转换的小写数字或小写字符串
     *  return 大写字母
     *  小数位为两位
     * */
    public static function numTomoneyzh($num) {
        $num = Sutil::price_cut($num);
        $c1 = "零壹贰叁肆伍陆柒捌玖";
        $c2 = "分角元拾佰仟万拾佰仟亿";
        $num = round($num, 2);
        $num = $num * 100;
        if (strlen($num) > 10) {
            return "数据太长，请手动设置!";
        }
        $i = 0;
        $c = "";
        while (1) {
            if ($i == 0) {
                $n = substr($num, strlen($num) - 1, 1);
            } else {
                $n = $num % 10;
            }
            $p1 = substr($c1, 3 * $n, 3);
            $p2 = substr($c2, 3 * $i, 3);
            if ($n != '0' || ($n == '0' && ($p2 == '亿' || $p2 == '万' || $p2 == '元'))) {
                $c = $p1 . $p2 . $c;
            } else {
                $c = $p1 . $c;
            }
            $i = $i + 1;
            $num = $num / 10;
            $num = (int) $num;
            if ($num == 0) {
                break;
            }
        }
        $j = 0;
        $slen = strlen($c);
        while ($j < $slen) {
            $m = substr($c, $j, 6);
            if ($m == '零元' || $m == '零万' || $m == '零亿' || $m == '零零') {
                $left = substr($c, 0, $j);
                $right = substr($c, $j + 3);
                $c = $left . $right;
                $j = $j - 3;
                $slen = $slen - 3;
            }
            $j = $j + 3;
        }

        if (substr($c, strlen($c) - 3, 3) == '零') {
            $c = substr($c, 0, strlen($c) - 3);
        }
        if (empty($c)) {
            return "零元整";
        } else {
            return $c . "整";
        }
    }

    /**
     * 验证邮箱
     * Enter description here ...
     * @param unknown_type $email
     */
    public static function validEmail($email) {
        if (strlen($email) > 32 || strlen($email) < 4)
            return false;
        return @eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email);
    }

    /**
     * 验证手机号码
     * Enter description here ...
     * @param unknown_type $phone
     */
    public static function validPhone($phone) {
        if (strlen($phone) != 11)
            return false;
        return @eregi("^(13[0-9]{1}|15[0-9]{1}|18[0-9]{1}|14[0-9]{1})[0-9]{8}$", $phone);
    }

    /**
     * IsQQ函数:检测参数的值是否符合QQ号码的格式
     * 返回值:是正确的QQ号码返回QQ号码,不是返回false
     */
    public static function validQQ($Argv) {
        $RegExp = '/^[1-9][0-9]{5,16}$/';
        return preg_match($RegExp, $Argv) ? $Argv : false;
    }

    /**
     *  验证是否为url
     *
     * @param string $str  url地址
     * @param boolean $exp_results   是否返回结果
     */
    public static function validUrl($str, $exp_results = false) {
        $RegExp = '/^(?:http\:\/\/)?[\w\.]+?\.(?:com|cn|mobi|net|org|so|co|gov|tel|tv|biz|cc|hk|name|info|asia|me|in).+$/';
        if (!preg_match($RegExp, $str, $m)) {
            return false;
        }

        if ($exp_results == true) {
            return $m;
        }

        return true;
    }

    /**
     * isUsername函数:检测是否符合用户名格式
     * $Argv是要检测的用户名参数
     * $RegExp是要进行检测的正则语句
     * 返回值:符合用户名格式返回用户名,不是返回false
     */
    public static function validUsername($Argv) {
        if (self::cp_strlen($Argv) > 16 || self::cp_strlen($Argv) < 4)
            return false;
//$RegExp = '/^(?:\w|[\x00-\xff])+$/'; //可包含 中文，字母，数字，下划线
        $RegExp = '/^(?:\w|[\x{4e00}-\x{9fa5}])+$/u';
        $stara = mb_substr($Argv, 0, 1, 'utf-8');
        $sRegExp = '/^\d|[a-zA-Z]*$/'; //判断首字符是否为字母
        return preg_match($RegExp, $Argv) && preg_match($sRegExp, $stara) ? true : false;
    }

    /**
     * 过淲敏感词汇
     *
     * @param unknown_type $word
     * @return 1,存在 0,不存在
     */
    function isFilterWords($word) {
        $filterwords = file(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'filedata' . DIRECTORY_SEPARATOR . 'filterwords.txt');
        foreach ($filterwords as $k => $v) {
            $filterwords[$k] = trim($v);
        }
        $str = implode('|', $filterwords);
        if (preg_match("/$str/", $word, $match) == 1) {//\n是匹配过滤字符后面的回车字符的
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * 替换敏感词汇
     *
     * @param unknown_type $word
     * @return string
     */
    public static function filterWords($word) {
        $filterwords = file(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'filedata' . DIRECTORY_SEPARATOR . 'filterwords.txt');
        foreach ($filterwords as $k => $v) {
            $filterwords[$k] = trim($v);
        }
        $str = @implode('|', $filterwords);
        $content = preg_replace("/$str/i", '***', $word);
        return $content;
    }

    /**
     * 获取邮箱URL
     * @param <type> $email
     * @return string
     */
    public static function getMailUrl($email) {
        if (self::validEmail($email)) {
            $urlarr = array(
                'qq.com' => 'http://mail.qq.com',
                'vip.qq.com' => 'http://mail.qq.com',
                'foxmail.com' => 'http://mail.foxmail.com',
                'vip.163.com' => 'http://mail.vip.163.com',
                '163.com' => 'http://mail.163.com',
                '188.com' => 'http://mail.188.com',
                '126.com' => 'http://mail.126.com',
                'yeah.net' => 'http://mail.yeah.net',
                'tom.com' => 'http://mail.tom.com',
                'gmail.com' => 'http://mail.google.com',
                'gmail.com' => 'http://www.gmail.com',
                'sina.com.cn' => 'http://mail.sina.com.cn',
                'sina.com' => 'http://mail.sina.com.cn',
                'sina.cn' => 'http://mail.sina.com.cn',
                'vip.sina.com' => 'http://vip.sina.com',
                'yahoo.com.cn' => 'http://mail.cn.yahoo.com',
                'yahoo.cn' => 'http://mail.cn.yahoo.com',
                'yahoo.com' => 'http://mail.yahoo.com',
                'sohu.com' => 'http://mail.sohu.com',
                'chinaren.com' => 'http://mail.chinaren.com',
                'hotmail.com' => 'http://mail.hotmail.com',
                'msn.com' => 'http://mail.hotmail.com',
                'live.com' => 'http://mail.hotmail.com',
                'live.cn' => 'http://mail.hotmail.com',
                '21cn.com' => 'http://mail.21cn.com',
                '263.net' => 'http://mail.263.net',
                'sogou.com' => 'http://mail.sogou.cn',
                'hexun.com' => 'http://mail.hexun.com',
                'wo.com.cn' => 'http://mail.wo.com.cn',
                '189.cn' => 'http://mail.189.cn',
                '139.com' => 'http://mail.10086.cn'
            );
            foreach ($urlarr as $key => $value) {
                if (strpos($email, $key)) {
                    $url = $value;
                    break;
                } else {
                    $url = '';
                }
            }
        } else {
            $url = '';
        }
        return $url;
    }

    public static function log($logFile, $data) {
        error_log("[" . date("Y-m-d H:i:s") . "]$data\r\n", 3, $logFile);
    }

    /**
     * 对查询结果集进行排序
     * @access public
     * @param array $list 查询结果
     * @param string $field 排序的字段名
     * @param array $sortby 排序类型
     * asc正向排序 desc逆向排序 nat自然排序
     * @return array
     */
    public static function listSort($list, $field, $sortby = 'asc') {
        if (is_array($list)) {
            $refer = $resultSet = array();
            foreach ($list as $i => $data)
                $refer[$i] = &$data[$field];
            switch ($sortby) {
                case 'asc': // 正向排序
                    asort($refer);
                    break;
                case 'desc':// 逆向排序
                    arsort($refer);
                    break;
                case 'nat': // 自然排序
                    natcasesort($refer);
                    break;
            }
            foreach ($refer as $key => $val)
                $resultSet[] = &$list[$key];
            return $resultSet;
        }
        return false;
    }

    /**
     * 安全过滤数据
     * @param string	$str		需要处理的字符
     * @param string	$type		返回的字符类型，支持，string,int,float,datetime,bool,array,html
     * @param maxid		$default	当出现错误或无数据时默认返回值
     * @return 		mixed		当出现错误或无数据时默认返回值
     */
    public static function getStr($str, $type = 'string', $default = '') {
        if (!is_array($str)) {
            $str = trim($str);
        }

        switch ($type) {
            case 'string': //字符处理
                $_str = strip_tags(SUtil::deHttpFilter($str));
                $_str = htmlspecialchars($_str, ENT_QUOTES);
                break;
            case 'int': //获取整形数据

                $_str = is_numeric($str) ? intval($str) : $default | 0;
                break;
            case 'float': //获浮点形数据
                $_str = is_numeric($str) ? floatval($str) : $default | 0;
                break;
            case 'datetime':
                $_str = SUtil::isDate($str) ? $str : $default;
                break;
            case 'bool':
                $_str = strtolower($str) == 'true' ? TRUE : (strtolower($str) == 'false' ? FALSE : $default);
                break;
            case 'array':
                if (is_array($str)) {
                    $_str = $str;
                } else {
                    $_str = preg_split('/[,]/i', $str);
                    foreach ($_str as $key => $value) {
                        if (trim($value) == "")
                            unset($_str[$key]);
                    }
                }
                break;
            case 'html': //获取HTML，防止XSS攻击
                $_str = self::reMoveXss(SUtil::deHttpFilter($str));
                break;

            default: //默认当做字符处理
                $_str = SUtil::HttpFilter(strip_tags(SUtil::deHttpFilter($str)));
        }
        return $_str;
    }

    /**
     * 验证是否是时间格式
     * @param $dirname
     * @return true or false
     */
    public static function isDate($sDate) {
        return preg_match("/^[0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2}( [0-9]{1,2}:[0-9]{1,2}:[0-9]{1,2})?$/", $sDate);
    }

    /**
     * 兼容php5.5的array_column函数
     * @param unknown_type $input
     * @param unknown_type $columnKey
     * @param unknown_type $indexKey
     */
    public static function arrayColumn($input, $columnKey, $indexKey = null) {
        if (!function_exists('array_column')) {
            $columnKeyIsNumber = (is_numeric($columnKey)) ? true : false;
            $indexKeyIsNull = (is_null($indexKey)) ? true : false;
            $indexKeyIsNumber = (is_numeric($indexKey)) ? true : false;
            $result = array();
            foreach ((array) $input as $key => $row) {
                if ($columnKeyIsNumber) {
                    $tmp = array_slice($row, $columnKey, 1);
                    $tmp = (is_array($tmp) && !empty($tmp)) ? current($tmp) : null;
                } else {
                    $tmp = isset($row[$columnKey]) ? $row[$columnKey] : null;
                }
                if (!$indexKeyIsNull) {
                    if ($indexKeyIsNumber) {
                        $key = array_slice($row, $indexKey, 1);
                        $key = (is_array($key) && !empty($key)) ? current($key) : null;
                        $key = is_null($key) ? 0 : $key;
                    } else {
                        $key = isset($row[$indexKey]) ? $row[$indexKey] : 0;
                    }
                }
                $result[$key] = $tmp;
            }
            return $result;
        } else {
            return array_column($input, $columnKey, $indexKey);
        }
    }

//加密函数，可用cp_decode()函数解密，$data：待加密的字符串或数组；$key：密钥；$expire 过期时间
    public static function cp_encode($data, $key = '', $expire = 0) {
        $string = serialize($data);
        $ckey_length = 4;
        $key = md5($key);
        $keya = md5(substr($key, 0, 16));
        $keyb = md5(substr($key, 16, 16));
        $keyc = substr(md5(microtime()), -$ckey_length);

        $cryptkey = $keya . md5($keya . $keyc);
        $key_length = strlen($cryptkey);

        $string = sprintf('%010d', $expire ? $expire + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
        $string_length = strlen($string);
        $result = '';
        $box = range(0, 255);

        $rndkey = array();
        for ($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($cryptkey[$i % $key_length]);
        }

        for ($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }

        for ($a = $j = $i = 0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }
        return $keyc . str_replace('=', '', base64_encode($result));
    }

//cp_encode之后的解密函数，$string待解密的字符串，$key，密钥
    public static function cp_decode($string, $key = '') {
        $ckey_length = 4;
        $key = md5($key);
        $keya = md5(substr($key, 0, 16));
        $keyb = md5(substr($key, 16, 16));
        $keyc = substr($string, 0, $ckey_length);

        $cryptkey = $keya . md5($keya . $keyc);
        $key_length = strlen($cryptkey);

        $string = base64_decode(substr($string, $ckey_length));
        $string_length = strlen($string);

        $result = '';
        $box = range(0, 255);

        $rndkey = array();
        for ($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($cryptkey[$i % $key_length]);
        }

        for ($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }

        for ($a = $j = $i = 0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }
        if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
            return unserialize(substr($result, 26));
        } else {
            return '';
        }
    }

    /**
     * 格式化时间
     * add by baoxianjian 19:17 2015/3/21
     * @param int $time
     * @param int $style 1:日期部分 2:时间部分 3日期+时间
     * @return string
     */
    public static function formatTime($time, $style = 1) {
        if (!$time)
            return '-';
        switch ($style) {
            case 1: $f = 'Y-m-d';
                break;
            case 2: $f = 'H:i:s';
                break;
            case 3: $f = 'Y-m-d H:i:s';
                break;
            default: $f = 'Y-m-d';
                break;
        }
        return date($f, $time);
    }

    /**
     * 当前时间在一个范围内吗？
     * add by baoxianjian 10:20 2015/4/16
     * @param int $time1 开始
     * @param int $time2  结束
     * @param mixed $style 输出样式：1数字 2文字
     * @return mixed
     */
    public static function nowInTimeRange($time1, $time2, $style = 1) {
        $hints = array(0 => '等待', 1 => '正常', 2 => '过期');
        if (NOW < $time1) {
            $i = 0;
        } else if (NOW > $time2) {
            $i = 2;
        } else {
            $i = 1;
        }
        switch ($style) {
            case 1: return $i;
            case 2: return $hints[$i];
            default: return $i;
        }
    }

    /**
     * 判断数字是否在一个范围
     * 
     * @param int $num
     * @param int $start
     * @param int $end
     */
    public static function numberInRange($num, $start, $end) {
        $num = intval($num);
        $start = intval($start);
        $end = intval($end);
        if ($num >= $start && $num <= $end) {
            return true;
        }
        return false;
    }

//api输出
    public static function apiOut($data, $pagin, $get) {
        !empty($data) ? $json = array('state' => true, 'data' => $data, 'pagin' => $pagin) : $json = array('state' => false, 'msg' => '没有数据');
        if ($get['jsoncallback']) {
            echo $get['jsoncallback'] . '(' . json_encode($json) . ')';
            exit;
        } else {
            echo json_encode($json);
            exit;
        }
    }

//api输出
    public static function getJson($data, $get = array()) {
        if ($get['jsoncallback']) {
            echo $get['jsoncallback'] . '(' . json_encode($data) . ')';
            exit;
        } else {
            echo json_encode($data);
            exit;
        }
    }

//获取来自搜索引擎入站时的关键词
    public static function get_keyword($url, $kw_start) {
        $start = stripos($url, $kw_start);
        $url = substr($url, $start + strlen($kw_start));
        $start = stripos($url, '&');
        if ($start > 0) {
            $start = stripos($url, '&');
            $s_s_keyword = substr($url, 0, $start);
        } else {
            $s_s_keyword = '';
        }
        return $s_s_keyword;
    }

    public static function getOrigin($referer) {
        $url = isset($referer) ? $referer : ''; //获取入站url。
        $search_1 = "google.com"; //q= utf8
        $search_2 = "baidu.com"; //wd= gbk
        $search_3 = "yahoo.cn"; //q= utf8
        $search_4 = "sogou.com"; //query= gbk
        $search_5 = "soso.com"; //w= gbk
        $search_6 = "bing.com"; //q= utf8
        $search_7 = "youdao.com"; //q= utf8
        $search_8 = "haosou.com"; //q= utf8
        $google = preg_match("/\b{$search_1}\b/", $url); //记录匹配情况，用于入站判断。
        $baidu = preg_match("/\b{$search_2}\b/", $url);
        $yahoo = preg_match("/\b{$search_3}\b/", $url);
        $sogou = preg_match("/\b{$search_4}\b/", $url);
        $soso = preg_match("/\b{$search_5}\b/", $url);
        $bing = preg_match("/\b{$search_6}\b/", $url);
        $youdao = preg_match("/\b{$search_7}\b/", $url);
        $haosou = preg_match("/\b{$search_8}\b/", $url);
        $s_s_keyword = "";
        $bul = $referer;
//获取没参数域名
        preg_match('@^(?:http://|https://)?([^/]+)@i', $bul, $matches);
        $burl = $matches[1];
//匹配域名设置
        $curl = "www.3156.test";
        if ($burl != $curl) {
            if ($google) {
//来自google
                $s_s_keyword = self::get_keyword($url, 'q='); //关键词前的字符为"q="。
                $s_s_keyword = urldecode($s_s_keyword);
                $urlname = "谷歌";
                $_SESSION["urlname"] = $urlname;
                $_SESSION["domain"] = 'google.com';
                $_SESSION["s_s_keyword"] = $s_s_keyword;
            } else if ($baidu) {
//来自百度
                $s_s_keyword = self::get_keyword($url, 'wd='); //关键词前的字符为"wd="
                $s_s_keyword = urldecode($s_s_keyword);
                $s_s_keyword = iconv("GBK", "UTF-8", $s_s_keyword); //引擎为gbk
                $urlname = "百度";
                $_SESSION["urlname"] = $urlname;
                $_SESSION["domain"] = 'baidu.com';
                $_SESSION["s_s_keyword"] = $s_s_keyword;
            } else if ($yahoo) {
//来自雅虎
                $s_s_keyword = self::get_keyword($url, 'q='); //关键词前的字符为"q="。
                $s_s_keyword = urldecode($s_s_keyword);
//$s_s_keyword=iconv("GBK","UTF-8",$s_s_keyword);//引擎为gbk
                $urlname = "雅虎";
                $_SESSION["urlname"] = $urlname;
                $_SESSION["domain"] = 'yahoo.com';
                $_SESSION["s_s_keyword"] = $s_s_keyword;
            } else if ($sogou) {
//来自搜狗
                $s_s_keyword = self::get_keyword($url, 'query='); //关键词前的字符为"query="。
                $s_s_keyword = urldecode($s_s_keyword);
                $s_s_keyword = iconv("GBK", "UTF-8", $s_s_keyword); //引擎为gbk
                $urlname = "搜狗";
                $_SESSION["urlname"] = $urlname;
                $_SESSION["domain"] = 'sogou.com';
                $_SESSION["s_s_keyword"] = $s_s_keyword;
            } else if ($soso) {
//来自搜搜
                $s_s_keyword = self::get_keyword($url, 'w='); //关键词前的字符为"w="。
                $s_s_keyword = urldecode($s_s_keyword);
                $s_s_keyword = iconv("GBK", "UTF-8", $s_s_keyword); //引擎为gbk
                $urlname = "搜搜";
                $_SESSION["urlname"] = $urlname;
                $_SESSION["domain"] = 'soso.com';
                $_SESSION["s_s_keyword"] = $s_s_keyword;
            } else if ($bing) {
//来自必应
                $s_s_keyword = self::get_keyword($url, 'q='); //关键词前的字符为"q="。
                $s_s_keyword = urldecode($s_s_keyword);
                $urlname = "必应";
                $_SESSION["urlname"] = $urlname;
                $_SESSION["domain"] = 'bing.com';
                $_SESSION["s_s_keyword"] = $s_s_keyword;
            } else if ($youdao) {
//来自有道
                $s_s_keyword = self::get_keyword($url, 'q='); //关键词前的字符为"q="。
                $s_s_keyword = urldecode($s_s_keyword);
                $urlname = "有道";
                $_SESSION["urlname"] = $urlname;
                $_SESSION["domain"] = 'youdao.com';
                $_SESSION["s_s_keyword"] = $s_s_keyword;
            } else if ($haosou) {
//来自好搜
                $s_s_keyword = self::get_keyword($url, 'q='); //关键词前的字符为"q="。
                $s_s_keyword = urldecode($s_s_keyword);
                $s_s_keyword = iconv("GBK", "UTF-8", $s_s_keyword); //引擎为gbk
                $urlname = "好搜";
                $_SESSION["urlname"] = $urlname;
                $_SESSION["domain"] = 'haosou.com';
                $_SESSION["s_s_keyword"] = $s_s_keyword;
            } else {
                $urlname = $burl;
                $s_s_keyword = "";
                $_SESSION["urlname"] = $urlname;
                $_SESSION["s_s_keyword"] = $s_s_keyword;
            }
            $s_urlname = $urlname;
            $s_urlkey = $s_s_keyword;
            $domain = $_SESSION["domain"];
        } else {
            $s_urlname = $_SESSION["urlname"];
            $s_urlkey = $_SESSION["s_s_keyword"];
            $domain = $_SESSION["domain"];
        }
        echo $s_s_keyword;
        SUtil::ssetcookie(array('origin_urlname' => $s_urlname, 'origin_urlkeys' => $s_urlkey, 'origin_url' => $url, 'domain' => $domain), 0, '/');
    }

    public static function ContentsPages($contents, $page = 1, $ptext = '#page#') {
        $arr = explode($ptext, $contents);
        $total = count($arr);
        $nowpage = $page;
        return array('contents' => $arr[$nowpage - 1], 'total' => $total);
    }

    /**
     * 获取session
     * @param string $name 名称
     * @return boolean|type  获取成果则返回对应的值 否则返回false
     */
    public static function getSession($name) {
        if (!session_id()) {
            return false;
        }
        $time = intval($_SESSION[$name . '_time']);
        if (time() > $time) {
            return false;
        }
        return $_SESSION[$name];
    }

    /**
     * 创建一个session
     * @param string $name 名称
     * @param type $value 值
     * @param int $time 过期时间 单位为秒
     * @return boolean 创建成果 则返回true
     */
    public static function setSession($name, $value, $time = 3600) {
        if (!$name) {
            return false;
        }
        if (!session_id()) {
            return false;
        }
        if ($value === null) {
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_time']);
        } else {
            $_SESSION[$name] = $value;
            $_SESSION[$name . '_time'] = time() + $time;
        }
        return true;
    }

    /**
     * 加密字符串函数
     * @param string $str 要加密的字符串
     * @param string $has  安全密匙
     * @return string 返回加密后的字符串
     */
    public static function baseEncode($str, $has = '') {
        $str .= $has;
        $str = base64_encode($str);
        for ($i = 0; $i < strlen($str); $i++) {
            $j = $i + 1;
            if ($j % 2 == 0) {
                $m = $str{$i - 1};
                $str{$i - 1} = $str{$i};
                $str{$i} = $m;
            }
        }
        return base64_encode($str);
    }

    /**
     * 解密baseEncode加密的函数
     * @param string $str 要解密的字符串
     * @param string $has  安全密匙
     * @return string 返回解密后的字符串
     */
    public static function baseDecode($str, $has = '') {

        $str = base64_decode($str);
        for ($i = 0; $i < strlen($str); $i++) {
            $j = $i + 1;
            if ($j % 2 == 0) {
                $m = $str{$i - 1};
                $str{$i - 1} = $str{$i};
                $str{$i} = $m;
            }
        }
        $str = base64_decode($str);
        $str_has = substr($str, strlen($str) - strlen($has), strlen($has));
        if ($str_has != $has) {
            return '';
        }
        $str = substr($str, 0, strlen($str) - strlen($has));
        return $str;
    }

    /**
     * ubb转换为html
     * @param type $str
     * @return type
     */
    public static function ubbToHtml($str) {
        $str = self::preg_rep('/\[br\]/i', '<br />', $str);
        $str = self::preg_rep("/\[p\]([\s\S]*?)\[\/p\]/i", "<p>$1</p>", $str);
        $str = self::preg_rep('/\[b\]([\s\S]*?)\[\/b\]/i', '<b>$1</b>', $str);
        $str = self::preg_rep('/\[i\]([\s\S]*?)\[\/i\]/i', '<i>$1</i>', $str);
        $str = self::preg_rep('/\[u\]([\s\S]*?)\[\/u\]/i', '<u>$1</u>', $str);
        $str = self::preg_rep('/\[ol\]([\s\S]*?)\[\/ol\]/i', '<ol>$1</ol>', $str);
        $str = self::preg_rep('/\[ul\]([\s\S]*?)\[\/ul\]/i', '<ul>$1</ul>', $str);
        $str = self::preg_rep('/\[li\]([\s\S]*?)\[\/li\]/i', '<li>$1</li>', $str);
        $str = self::preg_rep('/\[code\]([\s\S]*?)\[\/code\]/i', '<div class="ubb_code" style="BORDER: #dcdcdc 1px dotted; PADDING: 5px; LINE-HEIGHT: 150%; FONT-STYLE: italic">$1</div>', $str);
        $str = self::preg_rep('/\[quote\]([\s\S]*?)\[\/quote\]/i', '<div class="ubb_quote" style="BORDER: #dcdcdc 1px dotted; PADDING: 5px; LINE-HEIGHT: 150%">$1</div>', $str);
        $str = self::preg_rep('/\[color=(.*?)\]([\s\S]*?)\[\/color\]/i', '<font style="color: $1">$2</font>', $str);
        $str = self::preg_rep('/\[hilitecolor=(.*?)\]([\s\S]*?)\[\/hilitecolor\]/i', '<font style="background-color: $1">$2</font>', $str);
        $str = self::preg_rep('/\[align=(.*?)\]([\s\S]*?)\[\/align\]/i', '<p align="$1">$2</p>', $str);
        $str = self::preg_rep('/\[url=(.*?)\]([\s\S]*?)\[\/url\]/i', '<a href="$1">$2</a>', $str);
        $str = self::preg_rep('/\[img\]([\s\S]*?)\[\/img\]/i', '<img src="$1" />', $str);
        return $str;
    }

    public static function preg_rep($reg, $reg_f, $str) {
        $str1 = preg_replace($reg, $reg_f, $str);
        if ($str1) {
            return $str1;
        }
        return $str;
    }

    /**
     * 隐藏手机部分号码
     * @param char $phone 手机号码，支持-分割
     * @param int $count 隐藏数量
     * @param int $start 开始位置
     * @return char  返回隐藏后的手机号码
     */
    public static function hidePhone($phone, $count = 4, $start = null) {
        if (strlen($phone) < $count + intval($start)) {
            return $phone;
        }
//如果没有设置开始位置，那么则隐藏后面的号码
        if ($start === null) {
            return preg_replace("/[\d-]{" . $count . "}$/", str_repeat('*', $count), $phone);
        }
        $l_phone = substr($phone, 0, $start);
        $r_phone = substr($phone, $start + $count);
        return $l_phone . str_repeat('*', $count) . $r_phone;
    }

    /**
     * 数组转化为json，解决json_encode存入数据库的中文问题
     * @param array $arr  要转换的数组
     * @param bool $assoc 返回值类型，若为true则返回数组，否则返回json
     * @return array|string 
     */
    public static function jsonsql_encode($arr, $assoc = false) {
        foreach ($arr as $k => $v) {
            if (is_array($v)) {
                $arr[$k] = self::jsonsql_encode($v, true);
            } else {
                $arr[$k] = base64_encode($v);
            }
        }
        if ($assoc) {
            return $arr;
        } else {
            return json_encode($arr);
        }
    }

    /**
     * 将jsonsql_encode方法产生的json转换为数组
     * @param string $json_arr  要转换的json
     * @return array 
     */
    public static function jsonsql_decode($json_arr) {
        if (is_array($json_arr)) {
            $arr = $json_arr;
        } else {
            $arr = json_decode($json_arr, true);
        }
        foreach ($arr as $k => $v) {
            if (is_array($v)) {
                $arr[$k] = self::jsonsql_decode($v);
            } else {
                $arr[$k] = base64_decode($v);
            }
        }
        return $arr;
    }

}
