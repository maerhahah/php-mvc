<?php

namespace core\lib;

class api {

    public static function jsonAjax($data = '') {
        header('Access-Control-Allow-Origin:*');
        header("Content-Type:application/json;charset=UTF-8");

        if (empty($data)) {
            $datas = [
                'status' => 400,
                'msg' => 'have no data',
            ];
        } else {
            $datas = [
                'status' => 200,
                'data' => $data
            ];
        }
        exit(json_encode($datas));
    }

    public static function json($datas = '') {
        header('Access-Control-Allow-Origin:*');
        header("Content-Type:application/json;charset=UTF-8");
        exit(json_encode($datas));
    }

    public static function jsonAjaxMsg($msg = 'error', $status = 400) {
        header('Access-Control-Allow-Origin:*');
        header("Content-Type:application/json;charset=UTF-8");

        if (empty($data)) {
            $datas = [
                'status' => $status,
                'msg' => $msg,
            ];
        }
        exit(json_encode($datas));
    }

}
