<?php
require "../private/dbcfg.php";

$email = $_POST['email'];
$username = $_POST['username'];
$password_encrypted = md5($_POST['password']);


$link = @mysqli_connect(HOST, USER, PASS, DBNAME) or die("提示：数据库连接失败！");
//mysqli_select_db($link, DBNAME);
mysqli_set_charset($link, 'utf8');

$sql = "INSERT INTO users (username, email, password_md5) VALUES ('".$username."','".$email."','".$password_encrypted."');";

$result = mysqli_query($link, $sql);

session_start();

$_SESSION['login'] = true;
?>