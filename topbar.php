<!DOCTYPE html>
<?php
header('Secure');
session_start();
if(isset($_SESSION['rempw']) && $_SESSION['rempw']=="yes"){

  //TODO: 登陆后第一次跳转setcookie失效 加个延时试试？




  setcookie("login","yes",time()+60*60*24*30);
  setcookie("uid",$_SESSION['uid'],time()+60*60*24*30);
  setcookie("pwmd5",$_SESSION['pwmd5'],time()+60*60*24*30);
  echo($_COOKIE['login'].$_COOKIE['uid'].$_COOKIE['pwmd5']);
}else{
  setcookie("login","",0);
  setcookie("uid","",0);
  setcookie("pwmd5","",0);
}
?>
<html>

<head>
  <title>user</title>
  <meta charset="utf-8" />

  <link rel="stylesheet" href="lib/topbar.css" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <!--script src="./lib/jquery-3.3.1.min.js"></script-->
  <script src="https://cdn.staticfile.org/jquery/3.3.1/jquery.min.js"></script>
  <script src="./lib/topbar.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
    integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF"
    crossorigin="anonymous"></script>
</head>

<body>

  <nav class="navbar navbar-expand-lg fixed-top navbar-light shadow" id='navbar'>
    <div class="container-fluid">
      <!-- Brand/logo -->
      <a class="navbar-brand" href="./index.php">
        <img src="./src/logo.png" alt="" id='logoimg' />
      </a>

      <!-- Links -->
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-5">
          <li class="nav-item active">
            <a class="nav-link" href="#">我的番剧</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">所有番剧</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">当季番剧</a>
          </li>

        </ul>

        <form class="form-inline mr-auto">
          <input class="form-control" type="text" placeholder="动画名">
          <button class="btn btn-success" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
              viewBox="0 0 16 16">
              <path
                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
            </svg>
            搜索
          </button>
        </form>

        <div class="mr-auto">
          <img src="./src/bgi.jpg" height="70" />
        </div>

        <div id='userinfo'>
          <?php

            if(empty($_SESSION["login"])){
              if(empty($_COOKIE["login"])){
                //没有登录
                echo "1";
                not_logined();
              }else{
                //保存了密码 但是是首次打开浏览器
                $_SESSION['login'] = true;
                $_SESSION['uid'] = $_COOKIE['uid'];

                $uid = $_SESSION['uid'];

                //验证登录(顺便刷新Cookie时长捏
                $post_data = array(
                  'id'=> $uid,
                  'password'=> $_COOKIE['pwmd5'],
                  'way'=> 'uid',
                  'rempw'=> 'yes'
                );
                $res = send_post('./phps/login_verify.php' ,$post_data);
                $json_data = json_decode($res);
                //TODO: 救救JSON读取——————————————————————




                if($json_data['result'] == 'success'){
                  //验证成功
                  echo "2";
                  logined();
                }else{
                  //验证失败
                  echo "3";
                  not_logined();
                }

              }
            }else{
              echo "4";
              //一直开着浏览器 只是跳转网页
              logined();
            }

            

            function logined(){
              include "./phps/escape.php";
              $username ="N/A";

              //获取用户名
              require "./private/dbcfg.php";
              $uid = $_SESSION['uid'];
              $link = @mysqli_connect(HOST, USER, PASS, DBNAME) or die("提示：数据库连接失败！");
              //mysqli_select_db($link, DBNAME);
              mysqli_set_charset($link, 'utf8');
              $sql = "SELECT username FROM users WHERE id=".$uid.";";
              $result = mysqli_query($link, $sql);
                
              while ( $row = $result->fetch_array() ) {
                $username = $row[0];
                break;
              }
              //还原转义
              $username = re_escape_characters_if_sql_injection($username);

              echo("<span>".$username."</span>");
          ?>
          <span>阅番指数：n/a</span>
          <button class="btn btn-light" type="button">个人设置</button>
          <button id="user_quit_btn" class="btn btn-light" type="button">注销(for test)</button>
          <?php
            }

            function not_logined(){
          ?>
          <div class="btn-group shadow-sm" role="group">
            <button class="btn btn-primary regbtn" type="button" data-toggle="modal" data-target="#register_modal"
              data-backdrop="static">
              注册
            </button>
            <button class="btn btn-link loginbtn" type="button" data-toggle="modal" data-target="#login_modal"
              data-backdrop="static">
              登录
            </button>
          </div>

          <?php
            }

            function send_post($url, $post_data)
            {
                $postdata = http_build_query($post_data);
                $options = array(
                    'http' => array(
                        'method' => 'POST',
                        'header' => 'Content-type:application/x-www-form-urlencoded',
                        'content' => $postdata,
                        'timeout' => 15 * 60 // 超时时间（单位:s）
                    )
                );
                $context = stream_context_create($options);
                $result = file_get_contents($url, false, $context);
                return $result;
            }
          ?>

        </div>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>


  <!-- Modal -->
  <div class="modal fade" id="register_modal" tabindex="-1" aria-labelledby="register_modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="register_modalLabel">注册</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php
        require "user.php";
        ?>
        </div>
        <!--div class="modal-footer">
      </div-->
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="login_modal" tabindex="-1" aria-labelledby="login_modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="login_modalLabel">登录</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php
        require "login.php";
        ?>
        </div>
        <!--div class="modal-footer">
      </div-->
      </div>
    </div>
  </div>

</body>

</html>