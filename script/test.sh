#!/bin/bash

# 下载安装

# 配置启动

# 获取隧道参数
mac='b8:27:eb:21:b3:e5'
fname='tproxy'
comand='curl https://qazxsw.qicp.vip/api/index.php?ctrl=IPC&action=getFileConf&mac='$mac'&fname='$fname' -k'
#echo $comand
params=`$comand`
state=`echo $params | jq ".status"`

if [ $state -eq 200 ];then
    ip=`echo $params | jq ".info|.ip" | awk -F'"' '{print $2}'`
    port=`echo $params | jq ".info|.port" | awk -F'"' '{print $2}'`
    account=`echo $params | jq ".info|.account" | awk -F'"' '{print $2}'`
    passwd=`echo $params | jq ".info|.passwd" | awk -F'"' '{print $2}'`
    #echo $ip,$port,$account,$passwd

    # 调用expect隧道
    expect -c "
        set timeout 30
        spawn ssh -Nf -R $port:127.0.0.1:22 $account@$ip
        expect {
            \"password\" {send \"${passwd}\r\"}
            \"yes/no\" {send \"yes\r\";exp_continue}
        }
        interact
    "
    sleep 10
fi

