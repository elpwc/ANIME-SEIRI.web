<?php
require "../private/dbcfg.php";
require "../private/pw_enc.php";
require "./escape.php";

session_start();

//parameters
if(isset($_POST['email'])){
  $email=escape_characters_if_sql_injection($_POST['email']);
}
if(isset($_POST['uid'])){
  $uid=escape_characters_if_sql_injection($_POST['uid']);
}
$way = $_POST["way"];//验证方式 email/uid
$password_encrypted = pw_enc($_POST['password']);
$rempw = $_POST['rempw'];

//returns
/*
structure:
  [
    'result' => '',
    'uid' => ''
  ]

result:
  illegal way name
  not exist
  password incorrect
  success
*/


$link = @mysqli_connect(HOST, USER, PASS, DBNAME) or die("提示：数据库连接失败！");
//mysqli_select_db($link, DBNAME);
mysqli_set_charset($link, 'utf8');

if($way=="email"){//邮箱验证

  $sql = "SELECT id,password_md5 FROM users WHERE email='".$email."';";
  $result = mysqli_query($link, $sql);
  
  $uid_got="-1";
  $password_encrypted_got = "";
  
  
  while ( $row = $result->fetch_array() ) {
    $uid_got = $row[0];
    $password_encrypted_got = $row[1];
    break;
  }
  
  if($uid_got == "-1" || $password_encrypted_got == ""){
    //用户不存在
    echo json_encode([
      'result' => 'not exist',
      'uid' => '-1'
    ]);
  }else{
    //用户存在
    if($password_encrypted_got == $password_encrypted){
      //密码正确
      
      $_SESSION['login'] = true;
      $_SESSION['uid'] = $uid_got;
      $_SESSION['pwmd5'] = $password_encrypted;
      $_SESSION['rempw'] = "no";
      if($rempw == "yes"){
        //记住密码
        $_SESSION['rempw'] = "yes";
      }
      echo json_encode([
        'result' => 'success',
        'uid' => $uid_got
      ]);
  
    }else{
      //密码错误
      echo json_encode([
        'result' => 'password incorrect',
        'uid' => '-1'
      ]);
    }
  }
}else if($way=="uid"){//uid验证

  $sql = "SELECT email,password_md5 FROM users WHERE id='".$uid."';";
  $result = mysqli_query($link, $sql);
  
  $email_got="-1";
  $password_encrypted_got = "";
  
  
  while ( $row = $result->fetch_array() ) {
    $email_got = $row[0];
    $password_encrypted_got = $row[1];
    break;
  }
  
  if($email_got == "-1" || $password_encrypted_got == ""){
    //用户不存在
    echo json_encode([
      'result' => 'not exist',
      'uid' => '-1'
    ]);
  }else{
    //用户存在
    if($password_encrypted_got == $password_encrypted){
      //密码正确
      $_SESSION['login'] = true;
      $_SESSION['uid'] = $uid;
      $_SESSION['pwmd5'] = $password_encrypted;
      $_SESSION['rempw'] = "no";
      if($rempw == "yes"){
        //记住密码
        $_SESSION['rempw'] = "yes";
      }
      echo json_encode([
        'result' => 'success',
        'uid' => $uid
      ]);
  
    }else{
      //密码错误
      echo json_encode([
        'result' => 'password incorrect',
        'uid' => '-1'
      ]);
    }
  }
}else{
  //方式错误
  echo json_encode([
    'result' => 'illegal way name',
    'uid' => '-1'
  ]);
}


?>