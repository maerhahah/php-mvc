<?php

namespace app\model;

use core\lib\model as coreModel;
use core\lib\Handers;
use PDO;

class model extends coreModel {

    public $tablePrefix = '';                             // 表前缀
    public $page = 1;                                     // 默认分页
    public $num = 15;                                     // 默认分页数目
    public $isEmpty = true;
    public $SESSION = [];
    public $powerUser;
    public $userid = '';
    public $level = '';
    public $powers = '';
    public $user = [];        // 当前用户
    protected $salt = 'ZKWH';                                /* [密码加密签名key] */
    /* [数据表]                                               [描述] */
    protected $tableServer = 'server';                      /* [无服务器表] */
    protected $tableIPC = 'ipc';                            /* [客户端机器表] */
    protected $tableTask = 'task';                          /* [任务表] */
    protected $tableTaskSub = 'task_sub';                   /* [节点任务表] */
    protected $tableTaskNode = 'task_node';                 /* [任务节点表] */
    protected $tableFiles = 'files';                        /* [文件管理表] */
    protected $tableAdmin = 'admin';                        /* [系统人员表] */
    protected $tableLog = 'system_log';                     /* [系统日志表] */
    protected $tableCategory = 'category';                  /* [系统栏目表] */
    protected $tablePermission = 'permission';              /* [系统权限表] */
    protected $tableCilentFile = 'client_file';             /* [客户端文件下载管理表] */
    protected $tableCateActions = 'category_action';        /* [系统栏目动作表] */
    protected $tableRole = 'role';                          /* [角色或者职位表] */
    protected $tableDpartment = 'department';               /* [部门表] */
    protected $tableTools = 'tools';                        /* [工具表] */
    protected $tableToolsClass = 'tools_class';             /* [工具类别表] */
    protected $tableWorkLog = 'work_log';                   /* [任务操作记录表] */
    protected $tableTaskFolw = 'task_flow';                 /* [任务流关系表] */
    protected $tableTarget = 'target';                      /* [目标表] */
    protected $tableTargetFlow = 'target_flow';             /* [目标依赖表] */
    protected $tableKvmOs = 'kvm_os';

    public function __construct() {
        parent::__construct();
        $this->user = (object) $_SESSION['user'];
        $this->userid = $this->user->id;
        $this->level = $this->user->u_level;
        $this->powers = $this->user->powers;
    }

    /**
     * 获取所有工具
     */
    public function getAllTools() {
        $tools = $this->select($this->tableTools, ['tid', 't_name', 't_class_id', 't_did', 'filePath', 'is_os']);
        if ($tools) {
            $rowsArr = [];
            foreach ($tools as $key => $value) {
                $rowsArr[$value['tid']] = $value;
            }
            unset($rows);
            return $rowsArr;
        }
        return [];
    }

    /**
     * 获取所有工具分类
     */
    public function getAllToolClass() {
        $toolClass = $this->select($this->tableToolsClass, ['t_c_id', 't_c_name', 't_c_did']);
        if ($toolClass) {
            $rowsArr = [];
            foreach ($toolClass as $key => $value) {
                $rowsArr[$value['t_c_id']] = $value;
            }
            unset($rows);
            return $rowsArr;
        }
        return [];
    }

    /**
     * 获取当前用户的信息
     * @return type
     */
    public function getMine() {
        return $this->user;
    }

    /**
     * 获取所有人员的角色[生产环境应该做缓存]
     * @return array
     */
    public function getUsers() {
        $sql = "SELECT id,account,did,rid,u_name FROM $this->tableAdmin";
        $rows = $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        if ($rows) {
            $rowsArr = [];
            foreach ($rows as $key => $value) {
                $rowsArr[$value['id']] = $value;
            }
            unset($rows);
            return $rowsArr;
        }
        return [];
    }

    /**
     * 获取部门的名称[生产环境应该做缓存]
     * @return array
     */
    public function getDptMnts() {
        $sql = "SELECT did,d_name FROM $this->tableDpartment";
        $rows = $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        if ($rows) {
            $rowsArr = [];
            foreach ($rows as $key => $value) {
                $rowsArr[$value['did']] = $value;
            }
            unset($rows);
            return $rowsArr;
        }
        return [];
    }

    /**
     * 获取当前用户的下级直属部门和我当前的部门【主要用于界面显示】
     */
    public function getDptMntsForMe() {
        $where = '';

        // 系统开发账号
        if ($this->level == 1) {
            $where = "WHERE p_did='{$this->user->did}'";
        } else {
            $where = "WHERE did='{$this->user->did}' OR p_did='{$this->user->did}'";
        }
        $sql = "SELECT did,d_name FROM $this->tableDpartment $where";
//        echo $sql;
        $rows = $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
//        print_r($rows);
        if ($rows) {
            $rowsArr = [];
            foreach ($rows as $key => $value) {
                $rowsArr[$value['did']] = $value;
            }
            unset($rows);
            return $rowsArr;
        }
        return [];
    }

    /**
     * 获取职位[职位ID，职位昵称]
     * @return array
     */
    public function getRoles() {
        $rows = $this->select($this->tableRole, ['d_did', 'r_name', 'rid']);
        if ($rows) {
            $newArr = [];
            foreach ($rows as $key => $value) {
                $newArr[$value['d_did']][$value['rid']] = $value;
            }
            unset($rows);
            return $newArr;
        }
        return [];
    }

    /**
     * 获取本部门的工具分类[name]
     */
    public function getToolsClass() {
        $rows = $this->select($this->tableToolsClass, ['t_c_id', 't_c_name'], ['t_c_did' => $this->user->did]);
        if ($rows) {
            $newArr = [];
            foreach ($rows as $key => $value) {
                $newArr[$value['t_c_id']] = $value;
            }
            unset($rows);
            return $newArr;
        }
        return [];
    }

    /**
     * 获取本部门的工具列表
     */
    public function getCrtDptmntTools() {
        $rows = $this->select($this->tableTools, ['tid', 't_name', 't_class_id'], ['t_did' => $this->user->did]);
        if ($rows) {
            $newArr = [];
            foreach ($rows as $key => $value) {
                $newArr[$value['t_class_id']][] = $value;
            }
            unset($rows);
            return $newArr;
        }
        return [];
    }

    /**
     * 获取actions权限
     */
    public function getActionsAll() {
//        echo $this->level;
        $where = [];
        if ($this->level > 1) {
            $ids = $this->get($this->tablePermission, ['actions'], ['a_id' => $this->userid]);
            if ($ids) {
                $where = ['id' => explode(',', $ids['actions'])];
            } else {
                return [];
            }
        }

        $ret = $this->select($this->tableCateActions, ['a_url'], $where);
//        print_r($ret);
        if ($ret) {
            $arr = [];
            foreach ($ret as $k => $v) {
                $arr[] = $v['a_url'];
            }
            return array_values($arr);
        }
        return [];
    }

    public function getActions() {
        if ($this->level > 1) {
            if (Handers::isAjax() && Handers::isPost()) {
                $ctrlAction = '';
                if ($_GET['ctrl']) {
                    $ctrlAction = 'ctrl=' . $_GET['ctrl'];
                }
                if ($_GET['action']) {
                    $ctrlAction = $ctrlAction ? $ctrlAction . '&amp;action=' . $_GET['action'] : 'action=' . $_GET['action'];
                }
                $ctrlAction = htmlspecialchars($ctrlAction);
                $ret = $this->get($this->tableCateActions, ['id'], ['a_url' => $ctrlAction]);
                if ($ret) {
                    $ret1 = $this->get($this->tablePermission, ['actions'], ['a_id' => $this->userid]);
                    if ($ret1['actions']) {
//                        echo $ret['id'] . PHP_EOL . $ret1['actions'];
                        if (in_array($ret['id'], explode(',', $ret1['actions']))) {
                            return true;
                        }
                    }
                    return false;
                }

                return true;
            }
        }
        return true;
    }

    /**
     * 日志记录
     */
    public function writeLog($msg, $type = '操作日志') {
        $logArr = [
            'ip' => $_SERVER['REMOTE_ADDR'],
            'port' => $_SERVER['REMOTE_PORT'],
            'create_at' => date('Y-m-d H:i:s'),
            'log_desc' => $msg,
            'log_type' => $type,
        ];
        //die($this->debug()->insert($this->tableLog, $logArr));
        return $this->insert($this->tableLog, $logArr)->rowCount();
    }

    /**
     * 递归排序w
     * @param type $html
     * @param type $parid
     * @param type $channels
     * @param type $dep
     */
    public function deepIng(&$html, $parid, $channels, $deep) {
        $num = count($channels);
        for ($i = 0; $i < $num; $i++) {
            if ($channels[$i]['c_pid'] == $parid) {
                $tempArr = $channels[$i];
                $tempArr['deep'] = $deep;
                $html[] = $tempArr; //array('id' => $channels[$i]['id'], 'c_name' => $channels[$i]['c_name'], 'deep' => $deep);
                $this->deepIng($html, $channels[$i]['id'], $channels, $deep + 1);
            }
        }
    }

    public function getLimit($num = 0) {
        if (intval($num)) {
            $this->num = intval($num);
        }
        $this->page = max(intval($_GET['page']), 1);
        $offset = ($this->page - 1) * $this->num;
        return "  LIMIT $offset, " . $this->num;
    }

    public function getLimitArr() {
        $this->page = max(intval($_GET['page']), 1);
        $offset = ($this->page - 1) * $this->num;
        return [$offset, $this->num];
    }

    /**
     * 获取access_token
     */
    public function getAccessToken() {
        if ($_SESSION['access_token']) {
            return $_SESSION['access_token'];
        }
        $ret = file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . APPID . "&secret=" . APPSECRET);
        $ret = json_decode($ret);
        if ($ret->access_token) {
            $_SESSION['access_token'] = $ret->access_token;
            return $ret->access_token;
        }
        return '';
    }

    /**
     * 接口调用方法
     * @param type $url
     * @param type $data
     * @return type
     */
    public function HttpCurl($url, $data = null) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)) {
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output, true);
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

            $pinfo = pathinfo($_FILES[$fileName]["name"]);
            $ftype = $pinfo['extension']; //获取后缀
            $filename = date('YmdHis') . '_' . mt_rand(1000000, 9999999) . "." . $ftype;
            $destination = ROOT . $path . '/' . $filename;

            if (!move_uploaded_file($_FILES[$fileName]['tmp_name'], $destination)) {
                return false;
            }
            return ['path' => $destination, 'filename' => $filename];
        }
        return false;
    }

}
