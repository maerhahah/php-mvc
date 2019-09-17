<?php
$title = '综合作战平台';
include_once VIEW . '/common/header.php';
//print_r($_dptMntArrForMe);
//print_r($_mine);
?>

<body>
    <header class="navbar-wrapper">
        <div class="navbar navbar-fixed-top">
            <div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="#">综合作战平台</a> <a class="logo navbar-logo-m f-l mr-10 visible-xs" href="#">H-ui</a> 
                <span class="logo navbar-slogan f-l mr-10 hidden-xs">v1.0</span> 
                <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
                <nav class="nav navbar-nav">
                </nav>
                <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
                    <ul class="cl">
                        <!--<li>超级管理员</li>-->
                        <li class="dropDown dropDown_hover">
                            <a href="#" class="dropDown_A"><?php echo $_mine->u_name; ?>&nbsp;[<?php echo $_dptMntArrForMe[$_mine->did]['d_name']; ?>] <i class="Hui-iconfont">&#xe6d5;</i></a>
                            <ul class="dropDown-menu menu radius box-shadow">
                                <!--                                <li><a href="javascript:;" onClick="myselfinfo()">个人信息</a></li>
                                                                <li><a href="#">切换账户</a></li>-->
                                <li><a href="javasript:return false" id="loginOut">退出</a></li>
                            </ul>
                        </li>
                        <li id="Hui-msg"> <a href="#" title="消息"><span class="badge badge-danger">1</span><i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a> </li>
                        <li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
                            <ul class="dropDown-menu menu radius box-shadow">
                                <li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
                                <li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
                                <li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
                                <li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
                                <li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
                                <li><a href="javascript:;" data-val="orange" title="橙色">橙色</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <aside class="Hui-aside">
        <div class="menu_dropdown bk_2">
            <?php
//            echo 'ss';
//            print_r($ctgArr);
            if ($ctgArr) {
                $i = 0;
                foreach ($ctgArr as $key => $value) {
                    if ($value['c_pid'] == 0) {
                        if ($i != 0) {
                            echo '</ul></dd></dl><dl id="menu-' . $key . '"><dt><i class="Hui-iconfont">' . $value['icon'] . '</i> ' . $value['c_name'] . '<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt><dd><ul>';
                        } else {
                            echo '<dl id="menu-' . $key . '"><dt><i class="Hui-iconfont">' . $value['icon'] . '</i>  ' . $value['c_name'] . '<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt><dd><ul>';
                        }
                    } else {
                        echo '<li><a data-href="?' . $value['c_url'] . '&categoryid=' . $value['id'] . '" data-title=" ' . $value['c_name'] . '" href="javascript:void(0)"> ' . $value['c_name'] . '</a></li>';
                    }
                    $i++;
                }
                echo '</ul></dd></dl>';
            }
            ?>
        </div>
    </aside>
    <div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
    <section class="Hui-article-box">
        <div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
            <div class="Hui-tabNav-wp">
                <ul id="min_title_list" class="acrossTab cl">
                    <li class="active">
                        <span title="我的桌面" data-href="front/welcome.php">我的桌面</span>
                        <em></em></li>
                </ul>
            </div>
            <div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
        </div>
        <div id="iframe_box" class="Hui-article">
            <div class="show_iframe">
                <div style="display:none" class="loading"></div>
                <iframe scrolling="yes" frameborder="0" src="?action=welcome"></iframe>
            </div>
        </div>
    </section>

    <div class="contextMenu" id="Huiadminmenu">
        <ul>
            <li id="closethis">关闭当前 </li>
            <li id="closeall">关闭全部 </li>
        </ul>
    </div>
    <!--<link rel="import" href="front/_footer.html" />-->

    <!--_footer 作为公共模版分离出去-->
    <?php include_once VIEW . '/common/footer_js.php'; ?>
    <!--/_footer 作为公共模版分离出去-->
    <!--请在下方写此页面业务相关的脚本-->
<!--    <script type="text/javascript" src="front/lib/jquery.contextmenu/jquery.contextmenu.r2.js"></script>
    <script type="text/javascript" src="front/js/ip.js"></script>-->
    <script type="text/javascript">
        $(function () {
            /*$("#min_title_list li").contextMenu('Huiadminmenu', {
             bindings: {
             'closethis': function(t) {
             console.log(t);
             if(t.find("i")){
             t.find("i").trigger("click");
             }		
             },
             'closeall': function(t) {
             alert('Trigger was '+t.id+'\nAction was Email');
             },
             }
             });*/
        });

        // 退出
        $('#loginOut').on('click', function (e) {
            $.post(API + '?ctrl=admin&action=loginOut', {}, function (obj) {
                if (obj.status == 200) {
                    layer.msg(obj.msg, {icon: 1, time: 1000});
                    location.reload();
                } else {
                    layer.msg(obj.msg, {icon: 2, time: 1000});
                }
            })
        });

        /*个人信息*/
        function myselfinfo() {
            layer.open({
                type: 1,
                area: ['300px', '200px'],
                fix: false, //不固定
                maxmin: true,
                shade: 0.4,
                title: '查看信息',
                content: '<div>管理员信息</div>'
            });
        }

        /*资讯-添加*/
        function article_add(title, url) {
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }
        /*图片-添加*/
        function picture_add(title, url) {
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }
        /*产品-添加*/
        function product_add(title, url) {
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        }
        /*用户-添加*/
        function member_add(title, url, w, h) {
            layer_show(title, url, w, h);
        }


    </script> 
</body>
</html>