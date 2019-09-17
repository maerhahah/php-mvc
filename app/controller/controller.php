<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controller;

use core\lib\controller as coreController;
use app\model\model;
use core\lib\Handers;

/**
 * Description of controller
 *
 * @author thinkpad
 */
class controller extends coreController {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function jsonInfo($data) {
        header('Access-Control-Allow-Origin:*');
        header("Content-Type:application/json;charset=UTF-8");
        $arr = [
            'status' => 400,
            'msg' => '没有相关数据信息'
        ];
        if ($data) {
            $arr = [
                'info' => $data,
                'status' => 200,
                'msg' => 'ok'
            ];
        }
        die(json_encode($arr));
    }

    public function jsonList($data) {
        header('Access-Control-Allow-Origin:*');
        header("Content-Type:application/json;charset=UTF-8");
        die(json_encode($data));
    }

    /**
     * 操作结果返回
     * @param type $ret
     */
    public function jsonRetMsg($ret) {
        header('Access-Control-Allow-Origin:*');
        header("Content-Type:application/json;charset=UTF-8");
        if (is_array($ret)) {
            $rets['msg'] = $ret['msg'] ? $ret['msg'] : $ret['status'] == 200 ? '操作成功' : '操作失败';
            $rets['status'] = $ret['status'] ? $ret['status'] : 400;
            $ret = $rets;
        } elseif (is_bool($ret)) {
            if ($ret) {
                $ret = ['status' => 200, 'msg' => '操作成功'];
            } else {
                $ret = ['status' => 400, 'msg' => '操作失败'];
            }
        } elseif (is_integer($ret)) {
            if ($ret < 1) {
                $ret = ['status' => 400, 'msg' => '操作失败', 'num' => $ret];
            } else {
                $ret = ['status' => 200, 'msg' => '操作成功', 'num' => $ret];
            }
        } elseif (is_string($ret)) {
            $ret = ['status' => 400, 'msg' => $ret];
        } else {
            $ret = ['status' => 400, 'errInfo' => $ret];
        }
        echo json_encode($ret);
        die();
    }

    public function upload($path, $fileName = 'file') {
        set_time_limit(100);
        if (!$_FILES[$fileName]) {
            die('参数错误');
        }
        //获取文件的大小  
//        $file_size = $_FILES[$fileName]['size'];
        //判断是否上传成功（是否使用post方式上传）  
        if (is_uploaded_file($_FILES[$fileName]['tmp_name'])) {

            $filename = date('YmdHis') . mt_rand(100, 999) . "_" . $_FILES[$fileName]['name'];
            $destination = str_replace(';', '', $path . '/' . $filename);

            if (!move_uploaded_file($_FILES[$fileName]['tmp_name'], $destination)) {
                return false;
            }
            return ['path' => $destination, 'fileName' => str_replace(';', '', $_FILES[$fileName]['name'])];
        }
        return false;
    }

}
