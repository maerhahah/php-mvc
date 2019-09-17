<?php

// 数据库配置
$data = array(
    'mysql' => array(
        'pdo' => array(
            'database_type' => 'mysql',
            'database_name' => 'admin',
            'server' => '127.0.0.1',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
        ),
        'mysqldb1' => array(
            'host' => '127.0.0.1',
            'user' => 'root',
            'passwd' => 'root',
            'dbname' => '',
        ),
        'mysqldb2' => array(
        ),
    ),
    'orcale' => array(
        'default' => array(
        ),
        'orcale1' => array(
        ),
    ),
    'sqlserver' => array(
        'default' => array(
        ),
        'sqlserver1' => array(
        ),
    ),
);

return $data;
