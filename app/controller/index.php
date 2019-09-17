<?php

namespace app\controller;

use app\controller\controller;
use PHPMailer\PHPMailer\PHPMailer;

class indexController extends controller {

    public function actionIndex() {
        echo 'hello world';
    }

    public function actionSendMailQQ() {
        date_default_timezone_set('PRC');
        ignore_user_abort();
        set_time_limit(0);

        $mail = new PHPMailer();

        // Server settings
        $mail->SMTPDebug = 0;
        $mail->isSMTP();                                      // 使用SMTP方式发送
        $mail->Host = 'smtp.qq.com';                         // SMTP邮箱域名
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';                             // 启用SMTP验证功能
        $mail->Username = "1252661442@qq.com";                    // 邮箱用户名(完整email地址)
        $mail->Password = 'oehdulsaxmwahieh';                            // smtp授权码，非邮箱登录密码
        $mail->Port = 465;
        $mail->CharSet = "utf-8";                             //设置字符集编码 "GB2312"
        // end

        $mail->setFrom($mail->Username, 'hello QQ');
        $mail->addAddress('sunzi163qs@163.com', '');
//        $mail->addAddress('test_163_monitor@163.com', 'IPC');
        $mail->isHTML(true);
        $mail->Subject = 'SDFGJOIERSSDFG45S58SDFG14548SDG45S4DF5G1X12125SGDDF';
        $mail->Body = "<b style=\"color:red;\"></b>";
//        $mail->AltBody = '附加信息，可以省略';
        $mail->addAttachment('index.php', 'tpa-1.0.0.1.cfg'); //附件

        $status = $mail->send();
        echo $status ? '发送邮件成功' . date('Y-m-d H:i:s') : '发送邮件失败，错误信息未：' . $mail->ErrorInfo;
    }

    public function actionSendMail163() {
        date_default_timezone_set('PRC');
        ignore_user_abort();
        set_time_limit(0);

        $mail = new PHPMailer();
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.163.com';
        //$mail->SMTPSecure = 'ssl';
        //设置ssl连接smtp服务器的远程服务器端口号 可选465或587
        $mail->Port = 25;
//        $mail->Hostname = 'localhost';
        $mail->CharSet = 'UTF-8';
        $mail->Username = 'laravel_vip@163.com';
        $mail->Password = 'q319zqwert';
        $mail->From = 'laravel_vip@163.com';
        $mail->isHTML(true);

        $mail->FromName = 'hello 163';
        $mail->addAddress('sunzi163qs@163.com', '小白鼠');
//        $mail->addAddress('test_163_monitor@163.com', 'IPC');
        $mail->Subject = 'SDFGJOIERSSDFG45S58SDFG14548SDG45S4DF5G1X12125SGDDF';
        $mail->Body = "<b style=\"color:red;\"></b>";

        $mail->AltBody = '附加信息，可以省略';
        $mail->addAttachment('index.php', 'tpa-1.0.0.1.cfg'); //附件

        $status = $mail->send();
        echo $status ? '发送邮件成功' . date('Y-m-d H:i:s') : '发送邮件失败，错误信息未：' . $mail->ErrorInfo;
    }

    /**
     * 测试用例
     */
    public function actionTest() {
        $this->view();
    }

}
