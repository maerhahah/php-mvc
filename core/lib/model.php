<?php

namespace core\lib;

use core\lib\Medoo;
use PDO;

//use Pagerfanta\Pagerfanta;
//use Pagerfanta\View\DefaultView;
//use Pagerfanta\Adapter\AdapterInterface;

class model extends Medoo {

    public $tablePrefix = '';
    public $page = 1;
    public $num = 15;
    public $isEmpty = true;
    public $SESSION = [];

    public function __construct($option = array()) {
        $dbConf = !empty($option) ? $option : config::getDb();
        parent::__construct($dbConf);
        $this->SESSION = $_SESSION;
//        $dsn = "mysql:host=" . $dbConf['server'] . ";dbname=" . $dbConf['database_name'];
//        try {
//            $data = new \PDO($dsn, $dbConf['username'], $dbConf['password']);
////            p($data);
//        } catch (\PDOException $e) {
//            throw new \Exception('PDO连接失败');
//        }
    }

    public function getDayTable($date) {
        return $this->tablePrefix . $date;
    }

    public function getAllBySql($sql) {
        $sql = str_replace("from", "FROM", $sql);
        $sql = str_replace("select", "SELECT", $sql);

        $sqlCount = preg_replace("/SELECT (.*?) FROM/", "SELECT COUNT(*) AS `count` FROM ", $sql, 1);
//        echo $sqlCount . PHP_EOL;
//        var_dump($this);
//        echo PHP_EOL;
        $res = $this->query($sqlCount . ';')->fetchAll(PDO::FETCH_ASSOC);
//        var_dump($res);
        $data = [];
        $count = 0;
        if ($res) {
            $this->isEmpty = false;
            $data = $this->query(trim($sql, ';') . $this->getLimit() . ';')->fetchAll(PDO::FETCH_ASSOC);
            $count = count($res) > 1 ? count($res) : $res[0]['count']; // 有groupby的时候
        }
        return ['data' => $data, 'count' => $count, 'perNum' => $this->num, 'page' => $this->page, 'isEmpty' => $this->isEmpty];
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
     * 密码加密
     * @param type $passwd
     * @param type $salt
     * @return type
     */
    protected function cipherPasswd($passwd, $salt = 123456) {
        return sha1(md5(strrev(md5($passwd . $salt)) . $salt));
    }

}
