<?php
 
require "../private/emailcfg.php";

//生成6位随机验证码
//没有使用
function codestr()
{
    $arr=array_merge(range('a', 'b'), range('A', 'B'), range('0', '9'));
    shuffle($arr);
    $arr=array_flip($arr);
    $arr=array_rand($arr, 6);
    $res='';
    foreach ($arr as $v) {
        $res.=$v;
    }
    return $res;
}

//[*邮件发送逻辑处理过程*系统核心配置文件*]
 
$email = $_POST['email'];
$verify_code = $_POST['verify'];
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
require '../plugin/PHPMailer-6.5.1/src/Exception.php';
require '../plugin/PHPMailer-6.5.1/src/PHPMailer.php';
require '../plugin/PHPMailer-6.5.1/src/SMTP.php';
 
$mail = new PHPMailer(true);       // Passing `true` enables exceptions
try {
    //服务器配置
    $mail->CharSet ="UTF-8";                     //设定邮件编码
    $mail->SMTPDebug = 0;                        // 调试模式输出
    $mail->isSMTP();                             // 使用SMTP
    $mail->Host = HOST;            // SMTP服务器
    $mail->SMTPAuth = true;                      // 允许 SMTP 认证
    $mail->Username = USER;              // SMTP 用户名  即邮箱的用户名
    $mail->Password = PASS;        // SMTP 密码  部分邮箱是授权码(例如163邮箱)
    $mail->SMTPSecure = SECURE;                    // 允许 TLS 或者ssl协议
    $mail->Port = PORT;                            // 服务器端口 25 或者465 具体要看邮箱服务器支持
 
    $mail->setFrom(MAIL, 'uni');  //发件人（以QQ邮箱为例）
     
    $mail->addAddress($email, $email);  // 收件人（$Email可以为变量传值，也可为固定值）
    //$mail->addAddress('ellen@example.com');  // 可添加多个收件人
    $mail->addReplyTo(MAIL, 'uni'); //回复的时候回复给哪个邮箱 建议和发件人一致
    //$mail->addCC('cc@example.com');                    //抄送
    //$mail->addBCC('bcc@example.com');                    //密送
 
    //发送附件
    // $mail->addAttachment('../xy.zip');         // 添加附件
    // $mail->addAttachment('../thumb-1.jpg', 'new.jpg');    // 发送附件并且重命名
     
    $yanzhen = codestr();  //此处为调用随机验证码函数（按照自己实际函数名改写）
 
    //Content
    $mail->isHTML(true);                                  // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
    $mail->Subject = 'ANIME SEIRI身份验证码';
    $mail->Body    = '<h3>验证码事：<span>'.$verify_code.'</span></h3><p>有效期：5分钟</p>' . date('Y-m-d H:i:s');
    $mail->AltBody = '验证码事：'.$verify_code . date('Y-m-d H:i:s');//备用显示
 
    $mail->send();
    echo '验证邮件发送成功，请注意查收！';
} catch (Exception $e) {
    echo '邮件发送失败: ', $mail->ErrorInfo;
}
