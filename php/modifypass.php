<?php

require '../private/dbcfg.php';
require '../private/pw_enc.php';
require './escape.php';

$email = escape_characters_if_sql_injection($_POST['email']);
$password_encrypted = pw_enc($_POST['password']);


$link = @mysqli_connect(HOST, USER, PASS, DBNAME) or die("提示：数据库连接失败！");
//mysqli_select_db($link, DBNAME);
mysqli_set_charset($link, 'utf8');

$sql = "UPDATE users SET password_md5='".$password_encrypted."' WHERE email='".$email."';";
$result = mysqli_query($link, $sql);

$sql = "SELECT id FROM users WHERE email='".$email."';";
$result = mysqli_query($link, $sql);
$uid = "";

while ($row = $result->fetch_array()) {
    $uid = $row[0];
    break;
}

session_start();

$_SESSION['login'] = true;
$_SESSION['uid'] = $uid;
$_SESSION['pwmd5'] = $password_encrypted;
$_SESSION['rempw'] = "no_but_dont_quit";
