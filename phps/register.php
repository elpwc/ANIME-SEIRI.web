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

$uid = getuid($email);

session_start();

$_SESSION['login'] = true;
$_SESSION['uid'] = $uid;

setcookie("login","yes",time()+60*60*24*30);
setcookie("uid",$uid,time()+60*60*24*30);
setcookie("pwmd5",$password_encrypted,time()+60*60*24*30);

function getuid($email){
  $sql = "SELECT id FROM users WHERE email=".$email.";";
  $result = mysqli_query($link, $sql);
  
  while ( $row = $result->fetch_array() ) {
    return $row[0];
    break;
  }
}
?>