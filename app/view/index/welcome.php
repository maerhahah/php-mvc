<?php
$title = '欢迎使用综合作战平台';
include_once VIEW . '/common/header.php';
?>
<body>
    <div class="page-container">
        <p class="f-20 text-success">欢迎使用综合作战平台<span class="f-14"></span></p>
        <p>登录次数：<?php echo `cat ../api/loginNum.log`; ?> </p>
        <p>本次登录IP：<?php echo $_SERVER['REMOTE_ADDR']; ?>  上次登录时间：<?php echo `cat ../api/lastLogin.log`; ?></p>
        <table class="table table-border table-bordered table-bg">
            <table class="table table-border table-bordered table-bg mt-20">
                <thead>
                    <tr>
                        <th colspan="2" scope="col">服务器信息</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th width="30%">服务器计算机名</th>
                        <td><span id="lbServerName"><?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME']; ?></span></td>
                    </tr>
                    <tr>
                        <td>服务器IP地址</td>
                        <td><?php
                            echo `curl -s http://ddns.oray.com/checkip | awk -F: '{print $2}' | sed 's/<\/body><\/html>/ /g' |sed 's/[ ][ ]*//'`;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>服务器域名</td>
                        <td><?php echo $_SERVER['SERVER_NAME']; ?></td>
                    </tr>
                    <tr>
                        <td>服务器端口 </td>
                        <td><?php echo $_SERVER['SERVER_PORT']; ?></td>
                    </tr>
                    <tr>
                        <td>服务器版本 </td>
                        <td><?php echo $_SERVER['SERVER_SOFTWARE']; ?></td>
                    </tr>
                    <tr>
                        <td>本文件所在文件夹 </td>
                        <td><?php echo $_SERVER['CONTEXT_DOCUMENT_ROOT']; ?></td>
                    </tr>
                    <tr>
                        <td>服务器操作系统 </td>
                        <td><?php echo `uname`; ?></td>
                    </tr>
                    <tr>
                        <td>服务器当前时间 </td>
                        <td><?php echo date("Y-m-d H:i:s"); ?></td>
                    </tr>
                    <tr>
                        <td>服务器IE版本 </td>
                        <td><?php echo $_SERVER['HTTP_USER_AGENT']; ?></td>
                    </tr>
                    <tr>
                        <td>CPU 总数 </td>
                        <td><?php echo `lscpu | grep 'CPU(s):' | grep -v NUMA | awk -F: '{ print $2 }' | sed 's/ //g'`; ?></td>
                    </tr>
                    <tr>
                        <td>CPU 类型 </td>
                        <td><?php echo trim(`lscpu | grep 'Model name:' | awk -F:' ' '{ print $2 }' | sed 's/[ ][ ]*/ /g'`); ?></td>
                    </tr>
                    <tr>
                        <td>内存大小 </td>
                        <td><?php echo `cat /proc/meminfo | grep MemTotal | awk -F:' ' '{print $2}' | sed 's/[ ][ ]*//g'`; ?></td>
                    </tr>
                    <tr>
                        <td>剩余内存</td>
                        <td><?php echo `cat /proc/meminfo | grep MemFree | awk -F:' ' '{print $2}' | sed 's/[ ][ ]*//g'`; ?></td>
                    </tr>
<!--                        <tr>
                        <td>Asp.net所占内存 </td>
                        <td>51.46M</td>
                    </tr>-->
                    <tr>
                        <td>当前Session数量 </td>
                        <td><?php echo $_SERVER['HTTP_UPGRADE_INSECURE_REQUESTS']; ?></td>
                    </tr>
                    <tr>
                        <td>当前SessionID </td>
                        <td><?php echo $_SERVER['SSL_SESSION_ID']; ?></td>
                    </tr>
                    <tr>
                        <td>当前系统用户名 </td>
                        <td><?php echo $_SERVER['SSL_SERVER_S_DN_CN']; ?></td>
                    </tr>
                </tbody>
            </table>
    </div>
    <footer class="footer mt-20">
        <div class="container">
            <p>
                <!--感谢jQuery、layer、laypage、Validform、UEditor、My97DatePicker、iconfont、Datatables、WebUploaded、icheck、highcharts、bootstrap-Switch<br>-->
                Copyright &copy;2005-2035 BEI JING ZHONG KE WANG HANG .admin v1.0 All Rights Reserved.<br>
                <!--本后台系统由-->
                <!--<a href="http://www.h-ui.net/" target="_blank" title="H-ui前端框架">H-ui前端框架</a>提供前端技术支持-->
            </p>
        </div>
    </footer>
    <!--<link rel="import" href="_footer.html" />-->
    <!--此乃百度统计代码，请自行删除-->
    <script>

    </script>
    <!--/此乃百度统计代码，请自行删除-->
</body>
</html>