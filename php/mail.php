<?php
require "../private/emailcfg.php";
require '../plugin/Lib_Smtp.php';

$email = $_POST['email'];
$verify_code = $_POST['verify'];

try {
    $mail = new Lib_Smtp();

    $mail->setServer(HOST, USER, PASS, PORT, true);
    $mail->setFrom(MAIL);
    $mail->setReceiver($email);
    $mail->addAttachment("");
    $mail->setMail(
        "ANIME SEIRI身份验证码",
        '<h3>验证码事：<span>'.$verify_code.'</span></h3><p>有效期：5分钟</p>' . date('Y-m-d H:i:s')
    );
    echo $mail->send();
} catch (Exception $e) {
    echo 'failed';
}
