<?php

$dataConf = include '/usr/local/nginx/html/zzpt/config/db.php';

$mysqlConf = $dataConf['mysql']['pdo'];

$dbms = 'mysql';     //数据库类型
$host = $mysqlConf['server']; //数据库主机名
$dbName = $mysqlConf['database_name'];    //使用的数据库
$user = $mysqlConf['username'];      //数据库连接用户名
$pass = $mysqlConf['password'];          //对应的密码
$dsn = "$dbms:host=$host;dbname=$dbName";

try {
    $dbh = new PDO($dsn, $user, $pass); //初始化一个PDO对象

    $dbms = "SELECT * FROM tools  WHERE kvm_name <> ''";
    $rows = $dbh->query($dbms)->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as $key => $value) {
        $kvmName = $value['kvm_name'];

        $row = `sudo virsh list --all | grep shut | grep '{$kvmName}'`;
        sleep(1);

        if (empty($row)) {
            continue;
        }
	sleep(120);	

        $autostart = `sudo ls /etc/libvirt/qemu/autostart/{$kvmName}.xml `;
        if (!$autostart) {
            sleep(1);
            `sudo virsh autostart {$kvmName}`;
        }

        `sudo virsh start {$kvmName}`;
        sleep(1);

        $num = `sudo virsh snapshot-list {$kvmName} | grep running | wc -l`;
        sleep(1);

        if ($num < 1) {
            `sudo virsh snapshot-create {$kvmName}`;
        }
        sleep(1);
    }

    $dbh = null;
} catch (PDOException $e) {
    die("Error!: " . $e->getMessage() . "<br/>");
}
//默认这个不是长连接，如果需要数据库长连接，需要最后加一个参数：array(PDO::ATTR_PERSISTENT => true) 变成这样：
//$db = new PDO($dsn, $user, $pass, array(PDO::ATTR_PERSISTENT => true));
